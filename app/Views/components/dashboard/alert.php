<?php if(!is_null(session()->getFlashdata('errors'))){ ?>
<div id="message">
    <div style="padding: 5px;">
        <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <?php 
            if(is_array(session()->getFlashdata('errors'))){
                foreach (session()->getFlashdata('errors') as $error) {
            ?>
                    <strong>Error</strong> <?php echo $error ?>.
                    <hr>
            <?php
                }
            } else {
            ?>
            <strong>Error</strong> <?php echo session()->getFlashdata('errors') ?>.
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>

<?php if (!is_null(session()->getFlashdata('success'))) { ?>
<div id="message">
    <div style="padding: 5px;">
        <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Success</strong> <?php echo session()->getFlashdata('success') ?>.
        </div>
    </div>
</div>
<?php } ?>