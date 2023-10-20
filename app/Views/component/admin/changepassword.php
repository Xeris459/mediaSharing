<div class="modal fade" id="passwordID" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Ubah Password User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="passwordform" enctype="multipart/form-data">
                <input type="hidden" name="id" id="userid">
                <?= csrf_field(); ?>

                <!-- ganti password -->
                <div class='modal-body'>
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" name="password" aria-describedby="helpId"
                            placeholder="">
                        <small id="helpId" class="form-text text-muted">password must contain min 8 character</small>
                    </div>

                    <div class="form-group">
                        <label for="">confirm Password </label>
                        <input type="password" class="form-control" name="repassword" aria-describedby="helpId"
                            placeholder="">
                        <small id="helpId" class="form-text text-muted">confirm password must same as the new
                            password</small>
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
function changePassword(elem, id) {
    $('.modal-title').html('Change Password');

    $('#userid').val(id);
    $('input[name="password"]').val('')
    $('input[name="repassword"]').val('')
}


$('#passwordform').on('submit', function(e) {
    e.preventDefault();

    const url = location.origin + '/api/admin/admin/change/' + $('#userid').val()
    const data = $('#passwordform').serializeArray()

    Swal.fire({
        title: `Apakah anda yakin ingin mengganti password dari user ini?`,
        text: "kamu bisa mengubahnya kembali nanti",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `simpan password baru`,
        cancelButtonText: "jangan disimpan"
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
                        title: 'Password user berhasil diubah',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#passwordID').modal('toggle')

                },
                error: function(data) {
                    var text = '';
                    $.map(data.responseJSON.messages, function(val) {
                        text +=
                            `<div class="card"><div class="card-body">${val}</div></div><br>`
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
                    console.log(data)
                    if (data.responseJSON.code == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: data.responseJSON.message || 'server time out',
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
</script>
<?= $this->endSection() ?>