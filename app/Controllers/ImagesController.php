<?php

namespace App\Controllers;

use Hermawan\DataTables\DataTable;
use CodeIgniter\API\ResponseTrait;
use App\Models\ImageModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

class ImagesController extends BaseController
{
    use ResponseTrait;

    protected $pageName = "Gambar Saya";

    public function index()
    {
        return view('pages/my_images', [
            "title" => $this->pageName
        ]);
    }

    public function getData() {
        helper("dataTables");

        if($this->request->isAJAX()){
            $model = new ImageModel();
            $model->select('images.id, file_name, image, file_size, description, deleteRequest, category.title as category, (SELECT COUNT(*) FROM image_downloaded WHERE image_downloaded.image_id = images.id)  as downloaded')
            ->join('category', 'category.id = images.category_id', 'left')
            ->where('images.user_id', user_id());

            return DataTable::of($model)
                    ->add('image', function ($data) {
                        return "<img src='" . base_url('images/' . $data->image) . "' class='img-fluid' alt='Responsive image' style='width: 100px; height: 100px;'>";
                    })
                    ->edit('file_size', function ($data) {
                        return formatBytes($data->file_size);
                    })
                    ->edit('category', function ($data) {
                        return $data->category ?? "-";
                    })
                    ->edit('description', function ($data) {
                        return $data->description ?? "-";
                    })
                    ->add('status', function ($data) {
                        if($data->deleteRequest == 0) {
                            return "<div class='badge badge-success p-2'>Aktif</div>";
                        } else if($data->deleteRequest == 1) {
                            return "<div class='badge badge-danger p-2'>Pengajuan Penghapusan</div>";
                        } else if($data->deleteRequest == 3) {
                            return "<div class='badge badge-warning p-2'>Pengajuan ditolak</div>";
                        }
                    })
                    ->add('action', function($data) {
                        return "
                            <div class='input-group'>
                                <span class='input-group-btn'>
                                    " . actionButton() . "
                                    <div class='dropdown-menu'>
                                        " . linkButton($data->id, "Edit", "fa-edit", 'image', "edit") . "
                                        <div role='separator' class='dropdown-divider'></div>
                                        " . button($data->id, "hapus", "fa-trash", $this->pageName, "delete", "deleteCurrentRow") . "
                                    </div>
                                </span>
                            </div>
                            ";
                    })
                    ->setSearchableColumns(['description', 'file_name'])
                    ->toJson(true);
        } else {
            return $this->failForbidden('You do not have authorization to enter this page', 401);
        }
    }

    public function addPage()
    {
        $modelCategory = new CategoryModel();
        return view('pages/my_images-input', [
            "title" => "Tambah " . $this->pageName,
            "category" => $modelCategory->findAll(),
        ]);
    }

    public function editPage(int $id)
    {
        $model = new ImageModel();
        $modelCategory = new CategoryModel();
        
        return view('pages/my_images-edit', [
            "title" => "Tambah " . $this->pageName,
            "data" => $model->find($id),
            "category" => $modelCategory->findAll(),
        ]);
    }

    public function store() {
        try {
            $validation = \Config\Services::validation();

            $rules = [
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori tidak boleh kosong',
                    ],
                ],
                'image_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Gambar tidak boleh kosong',
                    ],
                ],
            ];
    
            if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
                return response()->setStatusCode(500)->setJSON([
                    "status" => false,
                    "message" => $validation->getErrors(),
                ]);
            }

            $imageUpload = new ImageModel();
            $categoryModel = new CategoryModel();

            $id = json_decode($this->request->getPost('image_id'));
            
            if(!empty($this->request->getPost('category'))){
                $categoryId = $categoryModel->where('title', $this->request->getPost('category'))->find();

                if($categoryId) {
                    $categoryId = $categoryId[0]->id;
                } else {
                    $categoryId = $categoryModel->insert([
                        "title" => $this->request->getPost('category'),
                        "user_id" => user_id(),
                    ]);
                }
            } else {
                $categoryId = null;
            }

            foreach ($id as $value) {
                $data = [
                    "category_id" => $categoryId,
                    "description" => $this->request->getPost('description'),
                ];
    
                if($id) {
                    $imageUpload->update($value, $data);
                }
            }

            return response()->setStatusCode(200)->setJSON([
                "status" => true,
                "message" => "Berhasil menyimpan data",
            ]);
        } catch (\Throwable $th) {
            return response()->setStatusCode(500)->setJSON([
                "status" => false,
                "message" => $th->getMessage(),
            ]);
        }
    }

    public function update() {
        try {
            $validation = \Config\Services::validation();
            $file = $this->request->getFile('image');

            $rules = [
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori tidak boleh kosong',
                    ],
                ],
                'id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'id gambar tidak boleh kosong',
                    ],
                ],
            ];

            if($file->isValid()){
                $rules['image'] = [
                    "rules" => "uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,20000]",
                    "errors" => [
                        "uploaded" => "Gambar tidak boleh kosong",
                        "mime_in" => "Gambar harus berupa jpg, jpeg, atau png",
                        "max_size" => "Gambar maksimal 20MB",
                    ],
                ];
            }

    
            if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $imageUpload = new ImageModel();
            $categoryModel = new CategoryModel();

            $id = $this->request->getPost('id');
            $old_image = $imageUpload->find($id);
            
            if(!empty($this->request->getPost('category'))){
                $categoryId = $categoryModel->where('title', $this->request->getPost('category'))->find();

                if($categoryId) {
                    $categoryId = $categoryId[0]->id;
                } else {
                    $categoryId = $categoryModel->insert([
                        "title" => $this->request->getPost('category'),
                        "user_id" => user_id(),
                    ]);
                }
            } else {
                $categoryId = null;
            }

            $data = [
                "category_id" => $categoryId,
                "description" => $this->request->getPost('description'),
            ];

            if($file->isValid()) {
                $imageName = $file->getName();
                $randomName = $file->getRandomName();

                $file->move('images', $randomName);

                $data['file_name'] = $imageName;
                $data['image'] = $randomName;
                $data['file_size'] = $file->getSize();

                // delete local file
                if(file_exists('images/' . $old_image->image)){
                    unlink('images/' . $old_image->image);
                }
            }

            $imageUpload->update($id, $data);

            return redirect()->to(site_url('image'))->with('success', 'Gambar berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->to(site_url('image'))->with('errors', [$th->getMessage()]);
        }
    }

    public function dropzoneStore()
    {
        $image = $this->request->getFile('file');

        $imageName = $image->getName();
        $randomName = $image->getRandomName();

        $image->move('images', $randomName);

		$imageUpload = new ImageModel();
		
		$data = [
			"file_name" => $imageName,
            "image"     => $randomName,
            "file_size" => $image->getSize(),
            "user_id" => auth()->user()->id,
            "category_id" => null,
            "description" => null,
		];

		$id = $imageUpload->insert($data);

        return json_encode(array(
			"status" => 1,
			"filename" => $imageName,
            "filesize" => $image->getSize(),
            "image_id" => $id,
		));
    }
    
    public function dropzoneRemove()
    {
        $id = $this->request->getPost('id');
        try {
            $imageUpload = new ImageModel();
            $model = $imageUpload->find($id);
    
            $status = $imageUpload->delete($id);
    
            return json_encode(array(
                "status" => $status,
                "image_id" => $id,
            ));
        } catch (\Throwable $th) {
            return response()->setStatusCode(500, $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $imageUpload = new ImageModel();
            $model = $imageUpload->find($id);

            if(auth()->user()->inGroup('superadmin', 'admin')) {
                $status = $imageUpload->delete($id);

                // delete local file
                if(file_exists('images/' . $model->image)){
                    unlink('images/' . $model->image);
                }
            } else {
                $status = $imageUpload->update($id, [
                    "deleteRequest" => 1,
                ]);
            }
    
            return json_encode(array(
                "status" => $status,
                "image_id" => $id,
            ));
        } catch (\Throwable $th) {
            return response()->setStatusCode(500, $th->getMessage());
        }
    }
}
