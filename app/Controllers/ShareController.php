<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ShareController extends BaseController
{
    protected $perPage = 10;
    public function store() {
        helper('text');

        $modelSharingLink = new \App\Models\SharingLinkModel();
        $modelSharingImages = new \App\Models\SharingImagesModel();
        $modelImage = new \App\Models\ImageModel();

        $linkCode = $this->generateLinkCode();

        $images = $this->request->getPost('images');

        $data = [
            'link_code' => $linkCode
        ];

        $modelSharingLink->insert($data);

        $sharingLink = $modelSharingLink->where('link_code', $linkCode)->first();

        foreach ($images as $key => $image) {
            $data = [
                'sharing_link_id' => $sharingLink->id,
                'image_id' => $image
            ];

            $modelSharingImages->insert($data);
        }

        return response()->setStatusCode(200)->setJSON([
            'status' => true,
            'message' => 'Berhasil membuat link sharing',
            'link' => site_url('share/' . $linkCode)
        ]);
    }

    public function show($code) {
        helper('ImageGallery');

        $modelSharingLink = new \App\Models\SharingLinkModel();
        $modelSharingImages = new \App\Models\SharingImagesModel();
        $modelImage = new \App\Models\ImageModel();
        $modelCategory = new \App\Models\CategoryModel();

        $sharingLink = $modelSharingLink->where('link_code', $code)->first();

        if(!$sharingLink) {
            return redirect()->to(site_url('gallery'));
        }

        $sharingImages = $modelSharingImages
        ->select('images.*, category.title as category_name, users.username as username')
        ->join('images', 'images.id = sharing_images.image_id')
        ->join('category', 'category.id = images.category_id')
        ->join('users', 'users.id = images.user_id')
        ->where('sharing_link_id', $sharingLink->id)
        ->findAll();

        $category = $modelCategory->findAll();

        return view('pages/share', [
            'title' => 'Share',
            'images' => $sharingImages,
            'category' => $category,
            'totalImage' => count($sharingImages),
            'imagePerPage' => 10000000,
            'link' => site_url('share/' . $code),
            'searchUrl' => site_url('share/' . $code . '/search'),
        ]);
    }

    public function search($code) {
        helper('ImageGallery');

        $modelSharingLink = new \App\Models\SharingLinkModel();
        $modelSharingImages = new \App\Models\SharingImagesModel();
        $modelImage = new \App\Models\ImageModel();
        $modelCategory = new \App\Models\CategoryModel();

        $keyword = $this->request->getGet('keyword');
        $category = $this->request->getGet('category') ?? []; // array

        $sharingLink = $modelSharingLink->where('link_code', $code)->first();

        if(!$sharingLink) {
            return redirect()->to(site_url('/'));
        }

        $sharingImages = $modelSharingImages
                        ->select('images.*, category.title as category_name, users.username as username')
                        ->join('images', 'images.id = sharing_images.image_id')
                        ->join('category', 'category.id = images.category_id')
                        ->join('users', 'users.id = images.user_id')
                        ->where('sharing_link_id', $sharingLink->id);

        if(!empty($category)) $sharingImages->whereIn('category.title', $category);

        $sharingImages = $sharingImages
                        ->like('file_name', $keyword)
                        // ->orLike('description', $keyword)
                        // ->orLike('category.title', $keyword)
                        ->find();

        $category = $modelCategory->findAll();
                    // dd($sharingImages);
        return view('pages/gallery', [
            "title" => "Gallery",
            "images" => $sharingImages,
            "totalImage" => count($sharingImages),
            "category" => $category,
            'imagePerPage' => 100000000,
            'keyword' => $keyword,
            'searchUrl' => site_url('share/' . $code . '/search'),
        ]);
    }

    private function generateLinkCode() {
        helper('text');

        $modelSharingLink = new \App\Models\SharingLinkModel();

        $linkCode = random_string('alnum', 10);

        // check if link code already exist
        $isLinkCodeExist = $modelSharingLink->where('link_code', $linkCode)->first();

        // if exist, generate new link code
        while($isLinkCodeExist) {
            $linkCode = random_string('alnum', 10);
            $isLinkCodeExist = $modelSharingLink->where('link_code', $linkCode)->first();
        }

        return $linkCode;
    }


}
