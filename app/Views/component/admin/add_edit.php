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
                <!-- default set for edit -->
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="hash" id="hash">
                <?= csrf_field(); ?>

                <!-- end ganti password -->
                <div class="modal-body" id="isi">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Full name</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                            placeholder="">
                    </div>

                    <div class="form-group add">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" aria-describedby="helpId"
                            placeholder="">
                        <small id="helpId" class="form-text text-muted">password must contain min 8 character and max 32
                            character</small>
                    </div>

                    <div class="form-group add">
                        <label for="">Re-Password</label>
                        <input type="password" class="form-control" name="repassword" aria-describedby="helpId"
                            placeholder="">
                        <small id="helpId" class="form-text text-muted">password must contain min 8 character and max 32
                            character</small>
                    </div>
                    <?php if ($page == "Admin") : ?>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control" name="level" id="level">
                            <option value="">-- select one -- </option>
                            <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role->name ?>"><?= $role->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <?php endif ?>

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
var user;

$('#form').on('submit', function(e) {
    e.preventDefault();
    const id = $('#id').val()
    const data = $('#form').serializeArray()

    if (id) {
        var url = location.origin + '/api/admin/<?= $page ?>/update/' + id
        var title = `are you sure want to edit <?= $page ?> ${user} information?`
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
                data: data,
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
    $('#form').attr('action', '<?= base_url() ?>/<?= $page ?>/edit');

    $.ajax({
        type: "GET",
        url: `${location.origin}/api/admin/<?=  strtolower($page) ?>/` + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                $('#pass').hide();
                $('#name').val(data.result.username);
                user = data.result.username;
                $('#email').val(data.result.email);
                $('#level').val(data.result.role);
                $('#id').val(data.result.userid);
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