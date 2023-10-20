<!-- modal -->
<!-- Button trigger modal -->
<button type="button" class="btn tambah btn-primary mb-3" data-toggle="modal" data-target="#modelId">
    Tambah Link
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Link
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
                <input type="hidden" name="user_id" id="user_id" value="<?= $id ?>">
                <?= csrf_field(); ?>

                <div class="modal-body" id="isi">

                    <img src="" alt="" sizes="500px" srcset="" id="img" style="max-width: 100%;">

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <input type="file" class="form-control-file" name="icon" id="icon"
                                            placeholder="" aria-describedby="fileHelpId">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group text-center">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP4AAADGCAMAAADFYc2jAAAAMFBMVEX09PTMzMzt7e3T09PQ0NDh4eHb29vx8fHJycnn5+fNzc3Y2NjV1dXo6Ojw8PDe3t4Ogsu9AAACF0lEQVR4nO3b23KDIBRAUQEvCBr//2+ruUnEpgEfLCd7TV86CTPZ0RoCtqoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMD/MU5tpmk8+7Ufpo21KpO1Rp/9+o+51LnttzegvpxdcIifG1x+vlP+7IIjuiXdmUxLft2d3XCAXk7gPnd0s1w1Sv7r13OAzQ7Q5JNfrpd8PQ2D7xMuZaLy23kaM//Un0/lJOUPz8nfx/2C8qd16utSRsvI74LJr20SRsvIH8PvPUPCaBn5fZhf7z3VxLN7mfluL98oG/XLydfq/clvlmvCtl9OfhVe+uLvQOb2iI9HC8kPzv743DePN8ZHo4Xkrx/8LlrAMeuZ4bejpeRXvVt+sT6a9Af1r8dfVP6y5jv18dpdWP96/IXl79rUK7t+LnxBfrwSvPbLz99bB3/2i8/f3wV49IvMD9Y7ftsDufdLzK/XWd/vO0C3foH5S/K9/93+1/Up4vLvqx7XuLe7fyLzn2s+dnxfLzJ/XfFy9o+dX4H5XcJmt7z8lHp5+d12cv9V+UnHXlx+6k0uwvKbxPubyCeffPLLFeSn9QvLH33b+s+1XleS8rNHk18u8pVtukzF39R6ud7NXedxyjlX9C3NVZv9vwz3D8Dp7IJDuvpQvzVFH/z59PfKZlNt4fUz3eTqS77sAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgzw/DShuYb6JumwAAAABJRU5ErkJggg=="
                                            width="255" height="255" id="iconImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-dm-12">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                        </div>
                        <div class="col-6 col-dm-12">
                            <div class="form-group">
                                <label for="">Url</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 col-dm-12">
                            <div class="form-group">
                                <label for="">Text Color</label>
                                <input type="color" class="form-control" name="color" id="color">
                            </div>
                        </div>
                        <div class="col-3 col-dm-12">
                            <div class="form-group">
                                <label for="">Background Color</label>
                                <input type="color" class="form-control" name="bgcolor" id="bgcolor" value="#ffffff">
                            </div>
                        </div>
                        <div class="col-6 col-dm-12">
                            <div class="form-group">
                                <label for="">Show</label>
                                <select class="form-control" name="show" id="show">
                                    <option value="1">show</option>
                                    <option value="0">hidden</option>
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
        var url = location.origin + '/api/admin/links/update/' + id
        var title = `are you sure want to edit this link?`
        var message = ""
    } else {
        var url = location.origin + '/api/admin/links/create'
        var title = `are you sure want to save this link?`
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
        url: `${location.origin}/api/admin/links/` + id,
        dataType: "JSON",
        success: function(data) {
            if (data.error == null) {
                console.log(data.result)
                var image;
                if (data.result.image == '') {
                    console.log("test")
                    image =
                        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP4AAADGCAMAAADFYc2jAAAAMFBMVEX09PTMzMzt7e3T09PQ0NDh4eHb29vx8fHJycnn5+fNzc3Y2NjV1dXo6Ojw8PDe3t4Ogsu9AAACF0lEQVR4nO3b23KDIBRAUQEvCBr//2+ruUnEpgEfLCd7TV86CTPZ0RoCtqoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMD/MU5tpmk8+7Ufpo21KpO1Rp/9+o+51LnttzegvpxdcIifG1x+vlP+7IIjuiXdmUxLft2d3XCAXk7gPnd0s1w1Sv7r13OAzQ7Q5JNfrpd8PQ2D7xMuZaLy23kaM//Un0/lJOUPz8nfx/2C8qd16utSRsvI74LJr20SRsvIH8PvPUPCaBn5fZhf7z3VxLN7mfluL98oG/XLydfq/clvlmvCtl9OfhVe+uLvQOb2iI9HC8kPzv743DePN8ZHo4Xkrx/8LlrAMeuZ4bejpeRXvVt+sT6a9Af1r8dfVP6y5jv18dpdWP96/IXl79rUK7t+LnxBfrwSvPbLz99bB3/2i8/f3wV49IvMD9Y7ftsDufdLzK/XWd/vO0C3foH5S/K9/93+1/Up4vLvqx7XuLe7fyLzn2s+dnxfLzJ/XfFy9o+dX4H5XcJmt7z8lHp5+d12cv9V+UnHXlx+6k0uwvKbxPubyCeffPLLFeSn9QvLH33b+s+1XleS8rNHk18u8pVtukzF39R6ud7NXedxyjlX9C3NVZv9vwz3D8Dp7IJDuvpQvzVFH/z59PfKZlNt4fUz3eTqS77sAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgzw/DShuYb6JumwAAAABJRU5ErkJggg=='
                } else {

                    image = data.result.icon
                }

                $('#iconImage').attr("src", '<?php echo base_url(); ?>' + '/media/upload/' + image);
                $('#show').val(data.result.isShow);
                $('#url').val(data.result.url);
                $('#color').val(data.result.textColor);
                $('#bgcolor').val(data.result.bgColor);
                $('#title').val(data.result.title);
                $('#id').val(data.result.id);
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