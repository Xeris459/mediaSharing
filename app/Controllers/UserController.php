<?php

namespace App\Controllers;

use Hermawan\DataTables\DataTable;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    use ResponseTrait;

    protected $pageName = "Users";

    public function index()
    {
        return view('pages/user', [
            "title" => $this->pageName
        ]);
    }

    public function getData()
    {
        helper("dataTables");

        if($this->request->isAJAX()) {
            $model = new UserModel();
            $model->select('users.id, users.username, auth_identities.secret as email, auth_groups_users.group as role, users.created_at as created')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'left');

            return DataTable::of($model)
                    ->add('action', function ($data) {
                        return "
                            <div class='input-group'>
                                <span class='input-group-btn'>
                                    " . actionButton() . "
                                    <div class='dropdown-menu'>
                                        " . linkButton($data->id, "Edit", "fa-edit", 'users', "edit") . "
                                        <div role='separator' class='dropdown-divider'></div>
                                        " . button($data->id, "hapus", "fa-trash", $this->pageName, "delete", "deleteCurrentRow") . "
                                    </div>
                                </span>
                            </div>
                            ";
                    })
                    ->setSearchableColumns(['users.username', 'auth_identities.secret', 'auth_groups_users.group'])
                    ->toJson(true);
        } else {
            return $this->failForbidden('You do not have authorization to enter this page', 401);
        }
    }

    public function addPage()
    {
        $roleList = service('authorization');
        service('settings');

        $roleList = setting('AuthGroups.groups');

        return view('pages/user-input', [
            "title" => "Tambah " . $this->pageName,
            "role" => $roleList,
        ]);
    }

    public function editPage($id = null)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);
    
        $userData = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->getEmail(),
            'role' => $user->getGroups()[0],
        ];

        $roleList = service('authorization');
        service('settings');

        $roleList = setting('AuthGroups.groups');

        return view('pages/user-edit', [
            "title" => "Edit " . $this->pageName,
            "role" => $roleList,
            "data" => (object) $userData,
        ]);
    }

    public function store() {
        try {
            $validation = \Config\Services::validation();

            $rules = [
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role tidak boleh kosong',
                    ],
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username tidak boleh kosong',
                        'is_unique' => 'Username sudah digunakan',
                    ],
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[auth_identities.secret]',
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
    
            if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $users = auth()->getProvider();

            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'image' => "https://placehold.co/800?text=Photo+Profile&font=roboto",
            ]);
            $users->save($user);
    
            $user = $users->findById($users->getInsertID());
    
            $user->addGroup($this->request->getPost('role'));
            $user->activate();

            return redirect()->to('/users')->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', $th->getMessage());
        }
    }

    public function update() {
        try {
            $validation = \Config\Services::validation();

            $rules = [
                'id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ID User tidak boleh kosong',
                    ],
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role tidak boleh kosong',
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
            
            $user->fill($data);
            $users->save($user);
    
            $user->syncGroups($this->request->getPost('role'));

            return redirect()->to('/users')->with('success', 'User berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $users = auth()->getProvider();
            $status = $users->delete($id, true);
    
            return json_encode(array(
                "status" => $status,
                "user_id" => $id,
            ));
        } catch (\Throwable $th) {
            return response()->setStatusCode(500, $th->getMessage());
        }
    }
}
