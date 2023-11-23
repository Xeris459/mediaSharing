<?php

namespace App\Controllers;

use Hermawan\DataTables\DataTable;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

class CategoryController extends BaseController
{
    use ResponseTrait;

    protected $pageName = "Category";

    public function index()
    {
        return view('pages/category', [
            "title" => $this->pageName
        ]);
    }

    public function getData() {
        helper("dataTables");

        if($this->request->isAJAX()){
            $model = new CategoryModel();
            $model->select('category.id, title, category.created_at as created, users.username as creator')
            ->join('users', 'users.id = category.user_id', 'left');

            return DataTable::of($model)
                    ->edit('created', function ($data) {
                        return date('d M Y H:i', strtotime($data->created));
                    })
                    ->add('action', function($data) {
                        return "
                            <div class='input-group'>
                                <span class='input-group-btn'>
                                    " . actionButton() . "
                                    <div class='dropdown-menu'>
                                        " . linkButton($data->id, "Edit", "fa-edit", 'category', "edit") . "
                                        <div role='separator' class='dropdown-divider'></div>
                                        " . button($data->id, "hapus", "fa-trash", $this->pageName, "delete", "deleteCurrentRow") . "
                                    </div>
                                </span>
                            </div>
                            ";
                    })
                    ->setSearchableColumns(['title', 'users.username'])
                    ->toJson(true);
        } else {
            return $this->failForbidden('You do not have authorization to enter this page', 401);
        }
    }

    public function addPage()
    {
        return view('pages/category-input', [
            "title" => "Tambah " . $this->pageName
        ]);
    }

    public function editPage(int $id)
    {
        $model = new CategoryModel();
        
        return view('pages/category-edit', [
            "title" => "Edit " . $this->pageName,
            "data" => $model->find($id),
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
            ];
    
            if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $categoryModel = new CategoryModel();
            $categoryId = $categoryModel->where('title', $this->request->getPost('category'))->find();

            if($categoryId) {
                return redirect()->to(site_url('category'))->with('errors', ['Kategori sudah ada']);
            }

            $categoryModel->insert([
                "title" => $this->request->getPost('category'),
                "user_id" => auth()->user()->id,
            ]);

            return redirect()->to(site_url('category'))->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->to(site_url('category'))->with('errors', [$th->getMessage()]);
        }
    }

    public function update() {
        try {
            $validation = \Config\Services::validation();

            $rules = [
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori tidak boleh kosong',
                    ],
                ],
            ];
    
            if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $categoryModel = new CategoryModel();
            $categoryModel->update($this->request->getPost('id'), [
                "title" => $this->request->getPost('category'),
            ]);

            return redirect()->to(site_url('category'))->with('success', 'Kategori berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->to(site_url('category'))->with('errors', [$th->getMessage()]);
        }
    }

    public function destroy($id) {
        try {
            $imageUpload = new CategoryModel();
            $status = $imageUpload->delete($id);
    
            return json_encode(array(
                "status" => $status,
                "image_id" => $id,
            ));
        } catch (\Throwable $th) {
            return response()->setStatusCode(500, $th->getMessage());
        }
    }
}
