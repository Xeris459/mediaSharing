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
                                <label for=""> Thumbnail</label>
                                <input required type="file" class="form-control-file" name="thumbnail" id="thumbnail"
                                    placeholder="" aria-describedby="fileHelpId">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Caption</label>
                                <textarea class="form-control" name="caption" id="caption" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="" disabled>-- select one -- </option>
                                    <option value="publish">publish</option>
                                    <option value="unpublish">unpublish</option>
                                </select>
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


<?=  $this->section('script') ?>
<script>
$('#form').on('submit', function(e) {
    e.preventDefault();
    formData = new FormData(this);
    const id = $('#id').val()
    // const data = $('#form').serializeArray()

    if (id) {
        var url = location.origin + '/api/admin/<?= $page ?>/update/' + id
        var title = `are you sure want to edit this <?= $page ?>?`
        var message = ""
    } else {
        var url = location.origin + '/api/admin/<?= $page ?>/create'
        var title = `are you sure want to save this <?= $page ?>?`
        var message = ""
    }

    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Save this <?= $page ?>`,
        cancelButtonText: "don't save it"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(response) {
                    $('input[name="csrf_test_name"]').val(response.csrf_hash)
                    Swal.fire({
                        icon: 'success',
                        title: '<?= $page ?> saved successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    myTable.draw();
                    $('#modelId').modal('toggle')

                },
                error: function(data) {
                    var text = '';
                    $.map(data.responseJSON.messages, function(val) {
                        text +=
                            `<div class="card"><div class="card-body">${val}</div></div><br>`;
                    });


                    Swal.fire({
                        icon: 'error',
                        title: 'ops..',
                        html: text,
                        showConfirmButton: false,
                        timer: 8000
                    })
                },
                complete: function(data) {
                    if (data.status == 500) {
                        console.log(data)
                        Swal.fire({
                            icon: 'error',
                            title: 'server time out: <br>' + data.responseJSON
                                .message,
                            showConfirmButton: false,
                            timer: 8000
                        })
                    }
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please Wait !',
                        html: 'trying saving data',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading()
                        },
                    });
                }
            });
        }
    })
})

function edit(edit) {
    var id = edit;

    $('#loading').show(0);
    $('.add').hide();
    $('#isi').hide();
    $('.modal-title').html('Edit <?= $page ?>');

    $.ajax({
        type: "GET",
        url: `${location.origin}/api/admin/<?=  strtolower($page) ?>/` + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                $('#img').attr("src", '<?php echo base_url(); ?>' + '/media/banner/' + data.result.image);
                $('#status').val(data.result.status);
                $('#title').val(data.result.title);
                $('#caption').val(data.result.description);
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
</script>
<?= $this->endSection() ?>