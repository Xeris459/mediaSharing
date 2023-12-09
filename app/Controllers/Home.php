<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $perPage = 10;

    public function index(): string
    {
        helper('ImageGallery');

        $modelImage = new \App\Models\ImageModel();
        $modelCategory = new \App\Models\CategoryModel();

        $images = $modelImage
                    ->select('images.*, category.title as category_name, users.username as username')
                    ->join('category', 'category.id = images.category_id')
                    ->join('users', 'users.id = images.user_id')
                    ->limit($this->perPage)
                    ->find();
        $totalImage = $modelImage->countAll();
        $category = $modelCategory->findAll();

        return view('pages/gallery', [
            "title" => "Gallery",
            "images" => $images,
            "totalImage" => $totalImage,
            "category" => $category,
            'imagePerPage' => $this->perPage,
            'searchUrl' => site_url('/search'),
        ]);
    }

    public function loadMore() {
        helper('ImageGallery');
        $page = $this->request->getGet("page");
        $modelImage = new \App\Models\ImageModel();

        $keyword = $this->request->getGet('keyword');
        $category = $this->request->getGet('category') ?? []; // array

        $image = $modelImage->select('images.*, category.title as category_name, users.username as username')
                    ->join('category', 'category.id = images.category_id')
                    ->join('users', 'users.id = images.user_id');

        if(!empty($keyword)) {
            $image->like('file_name', $keyword);
        }
                    
        if(count($category) > 0) {
            $image->whereIn('category.title', $category);
        }
                    
        $images = $image->limit($this->perPage, (int) $page * $this->perPage)->find();

        return response()->setJSON([
            'length' => count($images),
            'showButton' => count($images) == $this->perPage ? true : false,
            'html' => convertToGalleryCard($images)
        ]);
    }

    public function dashboard(): string
    {
        return view('pages/dashboard', [
            "title" => "Dashboard",
        ]);
    }

    public function download($id) {
        $modelImage = new \App\Models\ImageModel();
        $image = $modelImage->find($id);

        $path = ROOTPATH . 'public/images/' . $image->image;
        $name = $image->file_name;

        // save to log download to database
        $modelDownload = new \App\Models\ImageDownloadedModel();
        $modelDownload->insert([
            'user_id' => auth()->user()->id,
            'image_id' => $id
        ]);

        return $this->response->download($path, null)->setFileName($name);
    }

    public function downloadBatch() {
        $modelImage = new \App\Models\ImageModel();
        $ids = explode(',', $this->request->getGet('ids'));
        $images = $modelImage->whereIn('id', $ids)->get()->getResult();

        $zip = new \ZipArchive();
        $filename = Date('d-m-y_H:S:i') . '.zip';

        if ($zip->open($filename, \ZipArchive::CREATE)!==TRUE) {
            exit("cannot open <$filename>\n");
        }

        foreach ($images as $key => $image) {
            $path = ROOTPATH . 'public/images/' . $image->image;
            $name = $image->file_name;
            $zip->addFile($path, $name);
        }

        $zip->close();

        // save to log download to database
        $modelDownload = new \App\Models\ImageDownloadedModel();
        foreach ($ids as $value) {
            $modelDownload->insert([
                'user_id' => auth()->user()->id,
                'image_id' => $value
            ]);
        }

        return $this->response->download($filename, null)->setFileName($filename);
    }

    public function search(){
        helper('ImageGallery');

        $modelImage = new \App\Models\ImageModel();
        $modelCategory = new \App\Models\CategoryModel();

        $keyword = $this->request->getGet('keyword');
        $category = $this->request->getGet('category') ?? []; // array

        $images = $modelImage
                    ->select('images.*, category.title as category_name, users.username as username')
                    ->join('category', 'category.id = images.category_id')
                    ->join('users', 'users.id = images.user_id');

                    if(!empty($category)) $images->whereIn('category.title', $category);
                    
                    $images = $images->like('file_name', $keyword)
                    ->orLike('description', $keyword)
                    ->orLike('category.title', $keyword)
                    ->limit($this->perPage)
                    ->find();

        $totalImage = $modelImage->join('category', 'category.id = images.category_id')
                                ->join('users', 'users.id = images.user_id')
                                ->like('file_name', $keyword)
                                ->orLike('description', $keyword)
                                ->orLike('category.title', $keyword);
                                if(!empty($category)) $totalImage->whereIn('category.title', $category);
                                $totalImage = $totalImage->countAllResults();

        $category = $modelCategory->findAll();
                    // dd($category);
        return view('pages/gallery', [
            "title" => "Gallery",
            "images" => $images,
            "totalImage" => $totalImage,
            "category" => $category,
            'imagePerPage' => $this->perPage,
            'searchUrl' => site_url('/search'),
        ]);
    }
}
