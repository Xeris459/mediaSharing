<?php
if(!function_exists('actionButton')) {
    /**
     * membuat button untuk template datatables action
     *
     * @return string
     */
    function actionButton(){
        return "<button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button>";
    }
}

if(!function_exists('button')) {
    /**
     * membuat button untuk template datatables delete
     *
     * @param integer $id
     * id tombol yang akan di gunakan untuk trigger function
     * 
     * @param string $title
     * title dari tombol
     * 
     * @param string $icon
     * icon dari tombol dengan menggunakan fontawoseme 5
     * 
     * @param string $pageName
     * nama page yang muncul di pesan sweatalert
     * 
     * @param string $class nama class yang akan trigger sweatalert atau custom class
     * 
     * __sweatalert class__
     * - delete
     * - edit
     * 
     * @param string|NULL $function pilih deleteCurrentRow atau changePassword
     * 
     * @return string
     */
    function button($id, $title, $icon, $pageName, $class,$function = null){
        $onclick = "";
        if($function) $onclick = "onclick='$function(this, $id)'";

        return "<button class='dropdown-item $class' $onclick data-type='$pageName'><span class='fa $icon'></span> $title</button>";
    }
}

if(!function_exists('triggerModalButton')) {
     /**
     * membuat button untuk template datatables delete
     *
     * @param integer $id
     * id tombol yang akan di gunakan untuk trigger function
     * 
     * @param string $title
     * title dari tombol
     * 
     * @param string $icon
     * icon dari tombol dengan menggunakan fontawoseme 5
     * 
     * @param string $pageName
     * nama page yang muncul di pesan sweatalert
     * 
     * @param string $class nama class yang akan trigger sweatalert atau custom class
     * 
     * __sweatalert class__
     * - delete
     * - edit
     * 
     * @param string $function pilih deleteCurrentRow atau changePassword
     * 
     * @param string|NULL $target Id target modal
     * 
     * @return string
     */
    function triggerModalButton($id, $title, $icon, $pageName, $class, $target, $function = null, $param  = 2){
        $onclick = "";
        if($function) {
            if($param == 2) $onclick = "onclick='$function(this, $id)'";
            else $onclick = "onclick='$function($id)'";
        }

        return "<button class='dropdown-item $class' $onclick data-type='$pageName' data-toggle='modal' data-target='#$target'><span class='fa $icon'></span> $title</button>";
    }
}

if(!function_exists('formatBytes')) {
    function formatBytes($size) {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

        return round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];
    }
}