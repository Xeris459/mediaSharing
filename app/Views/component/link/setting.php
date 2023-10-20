<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Setting Preview</h6>
    </div>
    <div class="card-body">
        <form id="setting" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Background</label>
                                <input type="file" class="form-control-file" name="background" id="background"
                                    placeholder="" aria-describedby="fileHelpId">
                            </div>
                        </div>
                        <?php
                        if(empty($uSetting->background)) {
                            $image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP4AAADGCAMAAADFYc2jAAAAMFBMVEX09PTMzMzt7e3T09PQ0NDh4eHb29vx8fHJycnn5+fNzc3Y2NjV1dXo6Ojw8PDe3t4Ogsu9AAACF0lEQVR4nO3b23KDIBRAUQEvCBr//2+ruUnEpgEfLCd7TV86CTPZ0RoCtqoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMD/MU5tpmk8+7Ufpo21KpO1Rp/9+o+51LnttzegvpxdcIifG1x+vlP+7IIjuiXdmUxLft2d3XCAXk7gPnd0s1w1Sv7r13OAzQ7Q5JNfrpd8PQ2D7xMuZaLy23kaM//Un0/lJOUPz8nfx/2C8qd16utSRsvI74LJr20SRsvIH8PvPUPCaBn5fZhf7z3VxLN7mfluL98oG/XLydfq/clvlmvCtl9OfhVe+uLvQOb2iI9HC8kPzv743DePN8ZHo4Xkrx/8LlrAMeuZ4bejpeRXvVt+sT6a9Af1r8dfVP6y5jv18dpdWP96/IXl79rUK7t+LnxBfrwSvPbLz99bB3/2i8/f3wV49IvMD9Y7ftsDufdLzK/XWd/vO0C3foH5S/K9/93+1/Up4vLvqx7XuLe7fyLzn2s+dnxfLzJ/XfFy9o+dX4H5XcJmt7z8lHp5+d12cv9V+UnHXlx+6k0uwvKbxPubyCeffPLLFeSn9QvLH33b+s+1XleS8rNHk18u8pVtukzF39R6ud7NXedxyjlX9C3NVZv9vwz3D8Dp7IJDuvpQvzVFH/z59PfKZlNt4fUz3eTqS77sAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgzw/DShuYb6JumwAAAABJRU5ErkJggg==';
                        } else {
                            $image = base_url() . '/media/upload/' . $uSetting->background;
                        }
                        ?>
                        <div class="col-6">
                            <div class="form-group text-center">
                                <img src="<?= $image ?>" width="255" height="255" id="backgroundImage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Text Color</label>
                        <input type="color" class="form-control" name="color" id="color"
                            value="<?= $uSetting?->textcolor ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="template">Template</label>
                        <select class="form-control" name="template" id="template">
                            <option value="1" <?= ($uSetting?->template == '1') ? 'selected' : '' ?>>default</option>
                            <option value="2" <?= ($uSetting?->template == '2') ? 'selected' : '' ?>>center</option>
                        </select>
                    </div>
                </div>
            </div>


            <button type="submit" name="" id="" class="btn btn-primary btn-lg btn-block">Save</button>

        </form>
    </div>
</div>

<?=  $this->section('script') ?>
<script>
$('#setting').on('submit', function(e) {
    e.preventDefault();
    formData = new FormData(this);
    const id = $('#id').val()
    // const data = $('#form').serializeArray()

    Swal.fire({
        title: 'are you sure want to save this setting?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Save this setting`,
        cancelButtonText: "don't save it"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: location.origin + '/api/admin/links/setting/<?= $id ?>',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(response) {
                    $('input[name="csrf_test_name"]').val(response.csrf_hash)

                    if (response.background) $('#backgroundImage').attr('src', `${location.origin}/media/upload/${response
                        .background}`)

                    Swal.fire({
                        icon: 'success',
                        title: '<?= $page ?> saved successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
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
</script>
<?= $this->endSection() ?>