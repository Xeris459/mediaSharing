<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">Users</h1>

<a href="<?= site_url('users/tambah') ?>" class="btn tambah btn-primary mb-3">
    Tambah User
</a>

<!-- tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Register At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ;?>
<script>
$('#loading').hide(0);

//change back
$('.tambah').on('click', () => {
    $('#loading').hide(0);
    $('.add').show();
    $('#isi').show(0);
    $('.modal-title').html('Tambah Admin');

    $('#level').val('');
    $('#name').val('');
    $('#email').val('');
    $('input[name="password"]').val('');
    $('input[name="repassword"]').val('');
    $('#id').val('');
});

//ajax start
var myTable

$(document).ready(function() {
    myTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url() ?>/users/getData'
        },
        columns: [{
                data: 'username',
                name: 'username'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'created',
                name: 'created'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
        order: [
            [2, "desc"]
        ]
    });

})
</script>
<?= $this->endSection() ;?>