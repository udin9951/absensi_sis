<h2 class="title-3 m-b-30"><?php echo $breadcrumb ?></h2>

<!-- pesan start -->
<?= $this->session->flashdata('pesan') ?>
<!-- pesan end -->


<div class="container">
    <form action="<?= base_url('Absen_siswa/proses_edit_status') ?>" method="POST">
        <div class="form-group">
            <label>Ubah Status</label>
            <select name="ubah_status" id="ubah_status" class="form-control" required>
                <option value="">Pilih</option>
                <option value="1">COCOK</option>
                <option value="2">TIDAK COCOK</option>
            </select>
            <input type="hidden" name="id" value="<?= $id ?>">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
    </form>
</div>