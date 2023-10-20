$(document).ready(function(){
    $('.checkbox').on('click',function(){
        var limit = $('input[type="checkbox"]:checked').length > 0;
        if(limit){
            $('#del').show();
        } else {
            $('#del').hide();
        }
    })

    $('#del').on('click',function(){
        var segments = window.location.href.split( '/' );
        var uri = segments[5];

        var checkValues = $('input[name=cekdata]:checked').map(function(){
                return $(this).val();
            }).get();

            console.log(checkValues);

            $.ajax({
                url: 'delete',
                type: 'post',
                data: { id: checkValues },
                success:function(data){
                    alert('data deleted successfully');
                    window.location.reload();
                },
                error: function(e){
                    console.log("An error occurred with the system");
                  }   
            });
    });

    $('.status').on('click', function(e){
        e.preventDefault();

        const url   = $(this).attr('href');
        const type  = $(this).data('type');
        const hash  = $(this).data('hash');
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
			if (result.isConfirmed) {
				document.location.href = `${url}?hash=${hash}`;
			}
		});
    });

    $("#modelId").on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
    });

    $('#editor').trumbowyg({
        image:false
    });
 });

