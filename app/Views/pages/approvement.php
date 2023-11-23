<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">approvement</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage approvement</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Images</th>
                        <th>Owner</th>
                        <th>File Name</th>
                        <th>File Size</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
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
            url: '<?= base_url() ?>/approvement/getData'
        },
        columns: [{
                data: 'image',
                name: 'image',
                orderable: false
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'file_name',
                name: 'file_name'
            },
            {
                data: 'file_size',
                name: 'file_size'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
        order: [
            [1, "desc"]
        ]
    });

})
</script>
<?= $this->endSection() ;?>