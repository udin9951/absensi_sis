<h2 class="title-3 m-b-30"><?php echo $breadcrumb ?></h2>
<?= $this->session->flashdata('pesan') ?>
<div class="container">
    <div class="row">
        <form action="<?= base_url('Rekap_absensi/export') ?>" method="POST">
            <div class="form-group">
                <label>Bulan</label>
                <select name="bulan" id="bulan">
                    <option value="">Pilih</option>
                    <option value="January">JANUARI</option>
                    <option value="February">FEBRUARI</option>
                    <option value="March">MARET</option>
                    <option value="April">APRIL</option>
                    <option value="May">MEI</option>
                    <option value="June">JUNI</option>
                    <option value="July">JULY</option>
                    <option value="August">AGUSTUS</option>
                    <option value="September">SEPTEMBER</option>
                    <option value="Oktober">OKTOBER</option>
                    <option value="November">NOVEMBER</option>
                    <option value="December">DESEMBER</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Download PDF</button>
        </form>
    </div>
</div>
<form action="<?= base_url('Rekap_absensi/download') ?>" method="POST">
    <input type="hidden" id="get_bulan" name="get_bulan">
    <button type="submit" class="btn btn-primary mt-2" style="height: 40px;">Download Excel</button>
</form>