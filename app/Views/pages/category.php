<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">Category</h1>

<a href="<?= site_url('category/tambah') ?>" class="btn tambah btn-primary mb-3">
    Tambah Category
</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Category</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Creator</th>
                        <th>Created</th>
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
//ajax start
var myTable

$(document).ready(function() {
    myTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url() ?>/category/getData'
        },
        columns: [
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'creator',
                name: 'creator'
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
            [0, "desc"]
        ]
    });

})
</script>
<?= $this->endSection() ;?>