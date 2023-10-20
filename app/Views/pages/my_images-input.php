<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">Tambah Gambar Saya</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Gambar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for=""> Banner</label>
                            <form action="<?= base_url('image/dropzone/upload') ?>" method="POST" enctype="multipart/form-data" class="dropzone rounded" id='image-upload'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="" id="form" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <input type="hidden" name="image_id" id="image_id_hidden" value="">

                    <div class="modal-body" id="isi">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select class="custom-select" name="category" id="category">
                                        <option ></option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ;?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    let file_up_names = [];

    $("#category").select2({
        theme: 'bootstrap4',
        tags: true
    });
    
    Dropzone.options.imageUpload = {
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: true,
        maxFilesize: 20000,
        success:function(file){
            file_up_names.push(JSON.parse(file.xhr.response));

            let getListOfId = file_up_names.map(function(item) {
                console . log(item);
                return item.image_id;
            });

            $('#image_id_hidden').val(JSON.stringify(getListOfId))
        },
        removedfile: function(file) {
            const responseServer = JSON.parse(file.xhr.response);
            x = confirm('Do you want to delete?');
            if(!x)  return false;
            for(var i=0;i<file_up_names.length;++i){
                if(file_up_names[i].image_id==responseServer.image_id) {
                    $.post('<?= base_url("images/dropzone/remove") ?>', {id: file_up_names[i].image_id}, function(data,status){
                        // remove image in file_up_names
                        file_up_names.splice(i,1);
                        file.previewElement.remove();

                        let getListOfId = file_up_names.map(function(item) {
                            return item.image_id;
                        });

                        $('#image_id_hidden').val(JSON.stringify(getListOfId))
                    });
                }
            }
        }
    };

    $('#form').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '<?= base_url('image/store') ?>',
            type: 'POST',
            data: formData,
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil disimpan',
                })
            },
            beforeSend: function (data) {
                Swal.fire({
                    title: 'Please Wait !',
                    html: 'Saving data',
                    didOpen: () => {
                        Swal.showLoading()
                    },
                })
            },
            error: function (data) {
                let html = ''
                const key = Object.keys(data.responseJSON.message);

                for (let index = 0; index < key.length; index++) {
                    html += data.responseJSON.message[key[index]] + "<br>"
                    
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: html,
                })
            },
            cache: false,
            contentType: false,
            processData: false
        });
    })

    window.onbeforeunload = function (e) {
        var message = "Are you sure ?";
        var firefox = /Firefox[\/\s](\d+)/.test(navigator.userAgent);
        if (firefox) {
            var dialog = document.createElement("div");
            document.body.appendChild(dialog);
            dialog.id = "dialog";
            dialog.style.visibility = "hidden";
            dialog.innerHTML = message;
            var left = document.body.clientWidth / 2 - dialog.clientWidth / 2;
            dialog.style.left = left + "px";
            dialog.style.visibility = "visible";
            var shadow = document.createElement("div");
            document.body.appendChild(shadow);
            shadow.id = "shadow";
            //tip with setTimeout
            setTimeout(function () {
                document.body.removeChild(document.getElementById("dialog"));
                document.body.removeChild(document.getElementById("shadow"));
            }, 0);
        }
        return message;
    };
</script>
<?= $this->endSection() ;?>