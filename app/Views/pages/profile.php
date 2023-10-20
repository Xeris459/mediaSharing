<?= $this->extend('backend/layout/content'); ?>


<?=  $this->section('content') ?>

<!-- modal -->
<!-- Button trigger modal -->
<button type="button" class="btn tambah btn-primary mb-3" data-toggle="modal" data-target="#modelId">
    Tambah <?= $page ?>
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah <?= $page ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="" id="form" enctype="multipart/form-data">
                <div class='modal-body' id="loading">
                    <div class="lds-dual-ring"></div>
                </div>

                <input type="hidden" name="id" id="id">
                <?= csrf_field(); ?>

                <div class="modal-body" id="isi">

                    <img src="" alt="" sizes="500px" srcset="" id="img" style="max-width: 100%;">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Photo Profile</label>
                                <input required type="file" class="form-control-file" name="file" id="banner"
                                    placeholder="" aria-describedby="fileHelpId">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-dm-12">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-6 col-dm-12">
                            <div class="form-group">
                                <label for="">Job</label>
                                <input type="text" class="form-control" name="job" id="job" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Caption</label>
                                <textarea class="form-control" name="caption" id="caption" rows="10"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- tabel -->
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage <?= $page ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:50px">ID Profile</th>
                        <th style="max-width:150px; width:100px">Profil</th>
                        <th>Name</th>
                        <th>Deskription</th>
                        <th style="width:100px">Job</th>
                        <th style="width:150px">Created</th>
                        <th style="width:50px">Status</th>
                        <th style="width:50px">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$('#loading').hide(0);
//change back
$('.tambah').on('click', () => {
    $('#img').hide(0);
    $('#img_mobile').hide(0);
    $('#loading').hide(0);
    $('#isi').show(0);
    $('.modal-title').html('Tambah <?= ucfirst($page) ?>');
    $('#form').attr('action', '<?= base_url() ?>/admin/profile/save');

    $('#img').attr("src", '');
    $('#status').val('');
    $('#caption').val('');
    $('#job').val('');
    $('#name').val('');
    $('#id').val('');
    $('#banner').prop('required', true);
});

//ajax start

function edit(edit) {
    var id = edit;

    $('#loading').show(0);
    $('#ganti-pass').hide(0);
    $('#isi').hide(0);
    $('.add').hide(0);
    $('.modal-title').html('Edit <?= ucfirst($page) ?>');
    $('#form').attr('action', '<?= base_url() ?>/admin/profile/edit');

    $.ajax({
        type: "GET",
        url: "<?= base_url('/admin/api/profile/read') ?>/" + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                $('#img').attr("src", '<?php echo base_url(); ?>' + '/media/profile/' + data.result.image);
                $('#status').val(data.result.status);
                $('#caption').val(data.result.deskription);
                $('#job').val(data.result.job);
                $('#name').val(data.result.name);
                $('#id').val(data.result.id);
                $('#banner').prop('required', false);
            }
        }
    }).done(function() {
        setTimeout(function() {
            $("#loading").fadeOut(300);
            $('#isi').delay(300).show(1000);
        }, 500);
    });
};

$(document).ready(function() {
    myTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url() ?>/admin/api/profile'
        },
        columns: [{
                data: 'id',
                name: 'ID Profile'
            },
            {
                data: 'image',
                name: 'Profil'
            },
            {
                data: 'name',
                name: 'Name'
            },
            {
                data: 'content',
                name: 'Description'
            },
            {
                data: 'job',
                name: 'Job'
            },
            {
                data: 'created_at',
                name: 'Created_at'
            },
            {
                data: 'status',
                name: 'Status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
        order: [
            [0, "asc"]
        ]
    });

})
</script>
<?= $this->endSection() ?>