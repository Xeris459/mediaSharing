<?= $this->extend('layout/content'); ?>


<?=  $this->section('content') ?>
<?= $this->include('component/banner/add_edit') ?>

<!-- tabel -->
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Banner</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:25px">Sort</th>
                        <th style="max-width:250px; width:200px">Banner</th>
                        <!-- <th>Caption</th> -->
                        <th>Url</th>
                        <th style="width:100px">Start Date</th>
                        <th style="width:100px">End Date</th>
                        <th style="width:150px">Created</th>
                        <th style="width:50px">Status</th>
                        <th style="width:50px">Action</th>
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
    $('#img').hide(0);
    $('#loading').hide(0);
    $('#isi').show(0);
    $('.modal-title').html('Tambah <?= ucfirst($page) ?>');

    // $('#caption ').val('');
    $('#start').val('');
    $('#end').val('');
    $('#status').val('');
    $('#banner').val('');
    $('#url').val('');
    $('#id').val('');
    $('#banner').prop('required', true);
});

$(document).ready(function() {
    myTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url() ?>/api/admin/banner'
        },
        columns: [{
                data: 'sort',
                name: 'Sort'
            },
            {
                data: 'image',
                name: 'Image'
            },
            {
                data: 'url',
                name: 'Url'
            },
            {
                data: 'start_date',
                name: 'Start Date'
            },
            {
                data: 'end_date',
                name: 'End Date'
            },
            {
                data: 'created_at',
                name: 'Created_at'
            },
            {
                data: 'status',
                name: 'Status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
        order: [
            [0, "asc"]
        ]
    });

})
</script>
<?= $this->endSection() ;?>