let selected = [];

$('#downloadMultipleButton').click(function() {
    const ids = selected.join(',');
    window.open(window.location.origin + `/downloadMultiple?ids=${ids}&random=${(Math.random() + 1).toString(36).substring(2)}`, '_blank');
});

function shareLinks(el) {
    buttonSelect = $(el);
    const id = buttonSelect.data('id');

    $.ajax({
        type: "POST",
        url: window.location.origin + `/share`,
        data: {images: [id]},
        dataType: "json",
        success: function (response) {
            console.log(response)
            Swal.fire({
                title: 'Success',
                html: `
                    <p>Share link: <a href="${response.link}" target="_blank">${response.link}</a></p>
                `,
                icon: 'success',
                confirmButtonText: 'Copy link to clipboard and close', 
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText(response.link);
                    Swal.fire(
                        'Copied!',
                        'Your link has been copied to clipboard.',
                        'success'
                    )
                }
            })
        },
        beforeSend: function (xhr) {
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            })
        },
        error: function (error) {
            console.log(error)
            // Swal.close();
        }
    });
}

$('#shareMultipleButton').click(function() {
    const ids = selected.join(',');
    
    $.ajax({
        type: "POST",
        url: window.location.origin + `/share`,
        data: {images: selected},
        dataType: "json",
        success: function (response) {
            console.log(response)
            Swal.fire({
                title: 'Success',
                html: `
                    <p>Share link: <a href="${response.link}" target="_blank">${response.link}</a></p>
                `,
                icon: 'success',
                confirmButtonText: 'Copy link to clipboard and close', 
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText(response.link);
                    Swal.fire(
                        'Copied!',
                        'Your link has been copied to clipboard.',
                        'success'
                    )
                }
            })
        },
        beforeSend: function (xhr) {
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            })
        },
        error: function (error) {
            console.log(error)
            // Swal.close();
        }
    });
});

$('.dropdown-toggle').click(function() {
    $(this).dropdown('toggle')
    const thisMenu = $(this);
    const menu = $(this).parent();
    menu.focus();

    menu.on('focusout', function (e) {
        const thisMenu = $(this);
        setTimeout(function() {
            thisMenu.dropdown('hide');
        }, 100);
    });
});

function showModalButton(el) {
    const elem = $(el).parent().parent().parent().parent().parent();
    const filename = elem.find('.image_title').children().text();
    const imageUrl = elem.find('img').attr('src');
    const size = elem.parent().parent().data('size');
    const id = elem.parent().parent().data('id');
    const category = elem.find('small').text();
    const description = elem.find('.image_description').html();
    
    $('#fileName').text(filename);
    $('#fileSize').text(size);
    $('#Category').text(category);
    $('#fileDescription').html(description);
    $('#imageUrl').attr('src', imageUrl);

    const index = selected.indexOf(id);

    let buttonSelect = $('#modalSelected');
    if (index > -1) {
        buttonSelect.find('i').removeClass('fa-plus').addClass('fa-check');
        buttonSelect.addClass('bg-success text-light');
    } else {
        buttonSelect.find('i').removeClass('fa-check').addClass('fa-plus');
        buttonSelect.removeClass('bg-success text-light');
    }
    
    buttonSelect.data('id', id);
    
    $('#myModal').modal('show');
}

function showModal(el) {
    const elem = $(el).parent().parent();
    const filename = elem.find('.image_title').children().text();
    const imageUrl = elem.find('img').attr('src');
    const size = elem.parent().data('size');
    const id = elem.parent().data('id');
    const category = elem.find('small').text();
    const description = elem.find('.image_description').html();
    
    $('#fileName').text(filename);
    $('#fileSize').text(humanFileSize(size));
    $('#Category').text(category);
    $('#fileDescription').html(description);
    $('#imageUrl').attr('src', imageUrl);

    const index = selected.indexOf(id);

    let buttonSelect = $('#modalSelected');
    let shareButton = $('#shareButton');
    if (index > -1) {
        buttonSelect.find('i').removeClass('fa-plus').addClass('fa-check');
        buttonSelect.addClass('bg-success text-light');
    } else {
        buttonSelect.find('i').removeClass('fa-check').addClass('fa-plus');
        buttonSelect.removeClass('bg-success text-light');
    }
    
    buttonSelect.data('id', id);
    shareButton.data('id', id);

    $('#singleDownloadModal').attr('href', window.location.origin + `/download/${id}`);
    $('#myModal').modal('show');
}

function addToDownload(id, el) {
    const index = selected.indexOf(id);
    if (index > -1) {
        selected.splice(index, 1);
        $(el).find('i').removeClass('fa-check').addClass('fa-plus');
        $(el).removeClass('bg-success text-light');
        $(el).parent().parent().parent().parent().parent().parent().addClass('border-light')
        $(el).parent().parent().parent().parent().parent().parent().removeClass('border-success')
    } else {
        selected.push(id);
        $(el).find('i').removeClass('fa-plus').addClass('fa-check');
        $(el).addClass('bg-success text-light');
        $(el).parent().parent().parent().parent().parent().parent().removeClass('border-light')
        $(el).parent().parent().parent().parent().parent().parent().addClass('border-success')
    }

    countSelected()
}

function countSelected() {
    if(selected.length == 0) {
        $('#downloadMultipleButton').addClass('disabled');
        $('#shareMultipleButton').hide();
    } else {
        $('#downloadMultipleButton').removeClass('disabled');
        $('#shareMultipleButton').show();
    }

    $('#downloadMultipleButton').html(`(${selected.length}) Download <i class="fa-solid fa-arrow-down"></i>`)
}

function humanFileSize(size) {
    var i = size == 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
    return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
}

function modalAddButton(el) {
    buttonSelect = $(el);
    const id = buttonSelect.data('id');

    const index = selected.indexOf(id);

    if(index > -1) {
        selected.splice(index, 1);
        buttonSelect.find('i').removeClass('fa-check').addClass('fa-plus');
        buttonSelect.removeClass('bg-success text-light');
        $('.container_image').parent().parent().parent().find(`[data-id="${id}"]`).children().removeClass('border-success').addClass('border-light')
        $($('.container_image').parent().parent().parent().find(`[data-id="${id}"]`).find(`.dropdown-menu`).children()[3]).removeClass('bg-success text-light');
    } else {
        selected.push(id);
        buttonSelect.find('i').removeClass('fa-plus').addClass('fa-check');
        buttonSelect.addClass('bg-success text-light');
        $('.container_image').parent().parent().parent().find(`[data-id="${id}"]`).children().removeClass('border-light').addClass('border-success')
        $($('.container_image').parent().parent().parent().find(`[data-id="${id}"]`).find(`.dropdown-menu`).children()[3]).addClass('bg-success text-light');
    }


    countSelected()
}

let page = 1;
let category = [];

function loadMoreImage() {
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.getAll('category[]');
    const searchParam = urlParams.get('keyword') ? urlParams.get('keyword') : '';
    let category = '';

    if(categoryParam) {
        categoryParam.forEach((item) => {
            category += `&category[]=${item}`;
        });
    }
    
    const url = window.location.origin + `/load_more?page=${page}${category}&keyword=${searchParam}`;

    Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        didOpen: () => {
            Swal.showLoading()
        }
    })

    $.ajax({
        url: url,
        type: 'GET',
        success: function(result) {
            console.log(result.length > 0)
            if(result.length > 0) {
            
                $('#canvasGallery').append(result.html);
                
                if(!result.showButton) $('#loadMore').remove();
                
                page++;
                Swal.close();
            } else {
                Swal.close();

                $('#loadMore').remove();
            }
        },
        error: function(error) {
            console.log(error)
            Swal.close();
        }
    });
}

// get query url and set to input search and category select
$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.getAll('category[]');
    const searchParam = urlParams.get('keyword');

    if(categoryParam) {
        $('.category').each(function() {
            const value = $(this).val();
            if(categoryParam.includes(value)) {
                $(this).prop('checked', true);
            }
        });
    }

    if(searchParam) {
        $('#search').val(searchParam);
    }
});

// const openButton = (elem) => {
//     let target = $(elem).parent().find('.dropdown-menu');
//     $(elem).dropdown('toggle');

//     $(target).on('focusout', function (e) {
//         console.log(e)
//         if($(elem).hasClass('show')) {
//             $(elem).dropdown('hide');
//         }
//     })
// }

// const openButtonNavbar = (elem) => {
//     let target = $(elem).parent().find('.dropdown-menu');
//     $(elem).dropdown('toggle')

//     $(target).on('focusout', function (e) {
//         console.log(e)
//         $(elem).dropdown('hide');
//     })
// }

