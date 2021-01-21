<h2 class="title-3 m-b-30"><?php echo $breadcrumb ?></h2>

<!-- pesan flash message start -->
<?php $flash_pesan = $this->session->flashdata('pesan') ?>
<?php if (!empty($flash_pesan)) : ?>
    <div class="pesan">
        <?php echo $flash_pesan; ?>
    </div>
<?php endif ?>
<!-- pesan flash message end -->

<!-- pesan start -->
<?php if (!empty($pesan)) : ?>
    <div class="pesan">
        <?php echo $pesan; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- pagination start -->



<!-- paginatin end -->


<div class="filters m-b-45">
    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
        <?php echo anchor('absen/tambah/', '<button class="au-btn au-btn-icon au-btn--green au-btn--small">
        <i class="zmdi zmdi-plus"></i>Tambah Absen</button>', array('class' => 'add')) ?>
    </div>

</div>


<!-- tabel data start -->
<div class="table-responsive table--no-card m-b-30">
    <?php if (!empty($tabel_data)) : ?>
        <?php echo $tabel_data; ?>
    <?php endif ?>
</div>
<!-- tabel data end -->

<?php if (!empty($pagination)) : ?>
    <ul class="pagination">
        <?php echo $pagination; ?>
    </ul>
<?php endif ?>