<?php
$form = array(
    'nis' => array(
        'name' => 'nis',
        'size' => '30',
        'class' => 'form-control',
        'value' => set_value('nis', isset($form_value['nis']) ? $form_value['nis'] : '')
    ),
    'nama'    => array(
        'name' => 'nama',
        'size' => '30',
        'class' => 'form-control',
        'value' => set_value('nama', isset($form_value['nama']) ? $form_value['nama'] : '')
    ),
    'submit'   => array(
        'name' => 'submit',
        'class' => 'btn btn-primary',
        'id' => 'submit',
        'value' => 'Simpan'
    )
);
?>

<h2 class="title-3 m-b-30"><?php echo $breadcrumb ?></h2>

<!-- pesan start -->
<?php if (!empty($pesan)) : ?>
    <div class="pesan">
        <?php echo $pesan; ?>
    </div>
<?php endif ?>
<!-- pesan end -->

<!-- form start -->
<?php echo form_open($form_action); ?>
<div class="col-md-6">

</div>
<div class="form-group">
    <?php echo form_label('NIS', 'nis'); ?>
    <input type="text" name="nis" id="nis" class="form-control" required>
</div>
<?php echo form_error('nis', '<p class="text-danger">', '</p>'); ?>

<div class=" form-group">
    <?php echo form_label('Nama', 'nama'); ?>
    <input type="text" name="nama" id="nama" class="form-control" required>
</div>
<?php echo form_error('nama', '<p class="text-danger">', '</p>'); ?>

<div class=" form-group">
    <?php echo form_label('Kelas', 'id_kelas'); ?>
    <select name="id_kelas" id="id_kelas" class="form-control" required>
        <option value="">Pilih</option>
        <?php foreach ($select as $key) { ?>
            <option value="<?= $key->id_kelas ?>"><?= $key->kelas  ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <?php echo form_label('Wali Kelas', 'wali_kelas'); ?>
    <select name="wali_kelas" id="wali_kelas" class="form-control" required>
        <option value="">Pilih</option>
        <?php foreach ($wali_kelas as $key) { ?>
            <option value="<?= $key->nopeg ?>"><?= $key->nama  ?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <?php echo form_label('Latitude', 'latitude'); ?>
    <input type="text" name="latitude" id="latitude" class="form-control" required>
</div>
<div class="form-group">
    <?php echo form_label('Latitude', 'longitude'); ?>
    <input type="text" name="longitude" id="longitude" class="form-control" required>
</div>

<div class="form-group">
    <?php echo form_submit($form['submit']); ?>
    <?php echo anchor('siswa', 'Batal', array('class' => 'btn btn-warning')) ?>
</div>
<?php echo form_close(); ?>
<!-- form start -->

<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>