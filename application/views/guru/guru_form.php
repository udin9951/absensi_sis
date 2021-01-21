<?php
$form = array(
    'nis' => array(
        'name' => 'nopeg',
        'size' => '30',
        'class' => 'form-control',
        'value' => set_value('nis', isset($form_value['nopeg']) ? $form_value['nopeg'] : '')
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
<?= $this->session->flashdata('pesan') ?>
<!-- form start -->
<form action="<?php echo base_url('guru/tambah_data') ?>" method="POST">
    <div class="form-group">
        <label>Nopeg</label>
        <input type="text" name="nopeg" id="nopeg" class="form-control" required>
    </div>
    <?php echo form_error('nis', '<p class="text-danger">', '</p>'); ?>

    <div class=" form-group">
        <label>Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <?php echo form_error('nama', '<p class="text-danger">', '</p>'); ?>

    <div class=" form-group">
        <label>Password</label>
        <input type="Password" name="password" id="password" class="form-control" required>
        <input type="checkbox" id="liat_password">&nbsp;Show Password
    </div>
    <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>

    <div class=" form-group">
        <label>Kelas</label>
        <select name="id_kelas" id="id_kelas" class="form-control" required>
            <option value="">Pilih</option>
            <?php foreach ($select as $key) { ?>
                <option value="<?= $key->id_kelas ?>"><?= $key->kelas  ?></option>
            <?php } ?>
        </select>
    </div>
    <?php echo form_error('id_kelas', '<p class="text-danger">', '</p>'); ?>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Tambah</button>
        <?php echo anchor('guru', 'Batal', array('class' => 'btn btn-warning')) ?>
    </div>
</form>
<!-- form start -->

<?php
/* End of file siswa_form.php */
/* Location: ./application/views/kelas/siswa_form.php */
?>