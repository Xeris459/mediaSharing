<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    protected $pageName = "Profile";

    public function index()
    {
        $modelImage = new \App\Models\ImageModel();
        $modelCategory = new \App\Models\CategoryModel();
        $auth = auth()->getProvider()->findById(user_id());

        return view('pages/profile', [
            "title" => $this->pageName,
            'totalImages' => $modelImage->where('user_id', user_id())->countAllResults(),
            'totalCategories' => $modelCategory->where('user_id', user_id())->countAllResults(),
            'auth' => $auth,
        ]);
    }

    public function update() {
        try {
            $validation = \Config\Services::validation();
            $file = $this->request->getFile('image');

            $rules = [
                'id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ID User tidak boleh kosong',
                    ],
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username,id,' . $this->request->getPost('id') . ']',
                    'errors' => [
                        'required' => 'Username tidak boleh kosong',
                        'is_unique' => 'Username sudah digunakan',
                    ],
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[auth_identities.secret,id,' . $this->request->getPost('id') . ']',
                    'errors' => [
                        'required' => 'Email tidak boleh kosong',
                        'valid_email' => 'Email tidak valid',
                        'is_unique' => 'Email sudah digunakan',
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Password tidak boleh kosong',
                        'min_length' => 'Password minimal 8 karakter',
                    ],
                ],
                "confirm_password" => [
                    'rules' => 'required|matches[password]',
                    'errors'=> [
                        'required'=> 'Confirm Password tidak boleh kosong',
                        'matches'=> 'Confirm Password tidak sama dengan Password',
                    ],
                    'label' => 'Confirmation Password'
                ]
            ];

            if(empty($this->request->getPost('password')) && empty($this->request->getPost('confirm_password'))) {
                unset($rules['password']);
                unset($rules['confirm_password']);
            }

            if($file->isValid()){
                $rules['image'] = [
                    "rules" => "uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,20000]",
                    "errors" => [
                        "uploaded" => "Gambar tidak boleh kosong",
                        "mime_in" => "Gambar harus berupa jpg, jpeg, atau png",
                        "max_size" => "Gambar maksimal 20MB",
                    ],
                    'label' => 'Avatar'
                ];
            }
    
            if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $users = auth()->getProvider();
            $id = $this->request->getPost('id');
            $user = $users->findById($id);
            
            $data = [
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
            ];

            if(!empty($this->request->getPost('password')) && !empty($this->request->getPost('confirm_password'))) {
                $data['password'] = $this->request->getPost('password');
            }

            if($file->isValid()) {
                $randomName = $file->getRandomName();

                $file->move('images', $randomName);
                // dd($randomName . '.' . $extension);

                $data['image'] = $randomName;

                // delete local file
                if(strpos($user->image, 'http') !== 0) {
                    if(file_exists('images/' . $user->image)) {
                        unlink('images/' . $user->image);
                    }
                }
            }
            
            $user->fill($data);
            $users->save($user);

            return redirect()->to('/profile')->with('success', 'User berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', $th->getMessage());
        }
    }
}