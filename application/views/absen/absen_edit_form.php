<?php
$form = array(
    'nis' => array(
        'name' => 'nis',
        'size' => '30',
        'autocomplete' => 'off',
        'class' => 'form-control',
        'value' => set_value('nis', isset($form_value['nis']) ? $form_value['nis'] : '')
    ),
    'tanggal'    => array(
        'name' => 'tanggal',
        'size' => '30',
        'autocomplete' => 'off',
        'class' => 'form-control datepicker',
        'value' => set_value('tanggal', isset($form_value['tanggal']) ? $form_value['tanggal'] : '')
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
<div class="form-group">
    <?php echo form_label('NIS', 'nis'); ?>
    <input type="date" name="nis" id="nis" class="form-control" value="<?= $absen->nis ?>">
</div>
<?php echo form_error('nis', '<p class="field_error">', '</p>'); ?>

<div class="form-group">
    <?php echo form_label('Tanggal (dd-mm-yyyy)', 'tanggal'); ?>
    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $absen->tanggal ?>">

</div>
<?php echo form_error('tanggal', '<p class="field_error">', '</p>'); ?>

<div class="form-group">
    <?php echo form_label('Absen', 'absen'); ?>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio">Sakit
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio">Izin
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio">Alfa
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio">Terlambat
        </label>
    </div>
</div>
<?php echo form_error('absen', '<p class="field_error">', '</p>'); ?>

<div class="form-group">
    <?php echo form_submit($form['submit']); ?>
    <?php echo anchor('absen', 'Batal', array('class' => 'btn btn-warning')) ?>
</div>
<?php echo form_close(); ?>
<!-- form end -->