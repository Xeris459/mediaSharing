<?php
if(!function_exists('convertToGalleryCard')) {
    /**
     * membuat button untuk template datatables action
     *
     * @param array<ImageModel::class> $image
     */
    function convertToGalleryCard($model){
        $html = "";

        foreach ($model as $key => $item) {
            $imageUrl = site_url('images/' . $item->image);
            $downloadUrl = site_url('download/' . $item->id);
            $html .= "
                <div class='col-12 col-xl-3 col-lg-4 col-md-6 col-sm-12 my-2' data-toggle='modal' data-target='.bd-example-modal-sm' data-id='$item->id' data-size='$item->file_size'>
                    <div class='flex shadow border border-light m-1'>
                        <div class='container_image'>
                            <div class='image_icons'>
                                <div class='top_image'>
                                    <div class='image_title'>
                                        <i class='fas fa-image text-danger'></i>
                                        <div class='font-weight-light text-muted'>$item->file_name</div>
                                    </div>
            
                                    <div class='btn-group dropleft'>
                                        <button onclick='openButton(this)' type='button' class='btn btn-sm' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <i class='fas fa-ellipsis-h'></i>
                                        </button>
                                        <div class='dropdown-menu' style='z-index: 9'>
                                            <button onclick='showModalButton(this)' class='dropdown-item d-flex justify-content-between align-items-center'><span>Details</span> <i class='fas fa-eye text-muted'></i> </button>
                                            <div class='dropdown-divider'></div>
                                            <a href='$downloadUrl' target='_blank' class='dropdown-item d-flex justify-content-between align-items-center'><span>Download</span> <i class='fas fa-download text-muted'></i> </a>
                                            <button onclick='addToDownload($item->id, this)' class='dropdown-item d-flex justify-content-between align-items-center'><span>Select</span> <i class='fas fa-plus text-muted'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='image_preview rounded border border-light' onclick='showModal(this)'>
                                <img src='$imageUrl' class='rounded' alt='$item->file_name'>
                            </div>
            
                            <div class='p-1'>
                                <small>$item->category_name</small>
                                <div class='overflow-hidden text-muted w-100 font-weight-light image_description'>
                                    $item->description
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }

        return $html;
    }
}