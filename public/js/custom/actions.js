 let deleteCurrentRow = (elem, id) => {
    const Loc = window.location.pathname.split('/')[1]
    const type  = $(elem).data('type');
    const message = `Are you sure you want to delete this ${type}?`

    Swal.fire({
        title: `${message}`,
        text: "You will not be able to restore it once it has been deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'I know, delete it!', 
        cancelButtonText: "don't delete"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: `${location.origin}/${Loc.toLowerCase()}/${id}`,
                dataType: "JSON",
                success: function (res) {
                        if(res.error == null){
                            Swal.fire({
                                icon: 'success',
                                title: `${type} deleted successfully`,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            
                            myTable.row($(elem).parents("tr")).remove().draw();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: res.messages.error,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
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
    });
}

let changeStatus = (elem, id) => {
    const Loc = window.location.pathname.split('/')[1]
    const type  = $(elem).data('type');
    const message = `Are you sure you want to change this ${type} status?`

    Swal.fire({
        title: `${message}`,
        text: "you can change it later!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `change this ${type} status`, 
        cancelButtonText: "don't change it"
    }).then((result) => {
        $.ajax({
            type: "GET",
            url: `${location.origin}/${Loc.toLowerCase()}/change/${id}`,
            dataType: "JSON",
            success: function (res) {
                if (result.isConfirmed) {
                    if(res.error == null){
                        Swal.fire({
                            icon: 'success',
                            title: `status ${type} changed successfully`,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        
                        myTable.draw();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: res.messages.error,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
        });
    });
}

