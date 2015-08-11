<?php $this->load->view('templates/header'); ?>
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="page-content">
            <?php
            $this->load->view($dynamiccontent);
            ?>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>