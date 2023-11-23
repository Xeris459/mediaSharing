<?php

namespace App\Controllers;

use Hermawan\DataTables\DataTable;
use CodeIgniter\API\ResponseTrait;
use App\Models\ImageModel;
use App\Controllers\BaseController;

class ApprovementController extends BaseController
{
    use ResponseTrait;

    protected $pageName = "Approvement";

    public function index()
    {
        return view('pages/approvement', [
            "title" => $this->pageName
        ]);
    }

    public function getData() {
        helper("dataTables");

        if($this->request->isAJAX()){
            $model = new ImageModel();
            $model->select('images.id, username, file_name, images.image, file_size, description, deleteRequest, category.title as category')
            ->join('category', 'category.id = images.category_id', 'left')
            ->join('users', 'users.id = images.user_id', 'left')
            ->whereIn('deleteRequest', [1, 3]);

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
                        if($data->deleteRequest == 1) {
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
                                        " . button($data->id, "Approve", "fa-check", $this->pageName, "approve", "approveCurrentRow") . "
                                        " . button($data->id, "Reject", "fa-times", $this->pageName, "reject", "rejectCurrentRow") . "
                                    </div>
                                </span>
                            </div>
                            ";
                    })
                    ->setSearchableColumns(['description', 'file_name', 'category.title', 'users.username'])
                    ->toJson(true);
        } else {
            return $this->failForbidden('You do not have authorization to enter this page', 401);
        }
    }

    public function accept($id = null){
        if($this->request->isAJAX()){
            try {
                $model      = new ImageModel();
                $temp       = $model->select('deleteRequest, image')->find($id);
                $csrf_hash  = csrf_hash();
    
                $model->delete($id);
                
                if(file_exists('images/' . $temp->image)){
                    unlink('images/' . $temp->image);
                }

                $response = [
                    'csrf_hash' => $csrf_hash,
                    'result' => true
                ];
    
                return $this->respond($response);
            } catch (\Throwable $th) {
                return $this->fail('failed to approve image');
            }
        } else {
            return $this->fail('You do not have authorization to enter this page', 401);
        }
    }

    public function reject($id = null){
        if($this->request->isAJAX()){
            try {
                $model      = new ImageModel();
                $model->select('deleteRequest, image')->find($id);
                $csrf_hash  = csrf_hash();
    
                $model->update($id, ['deleteRequest' => 3]);

                $response = [
                    'csrf_hash' => $csrf_hash,
                    'result' => true
                ];
    
                return $this->respond($response);
            } catch (\Throwable $th) {
                return $this->fail('failed to reject image');
            }
        } else {
            return $this->fail('You do not have authorization to enter this page', 401);
        }
    }
}
