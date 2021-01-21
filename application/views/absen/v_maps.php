<h2 class="title-3 m-b-30"><?php echo $breadcrumb ?></h2>
<div class="container">
    <div class="row">

        <?php
        $get_map1 = '<div class="col-md-6">
            <label><b><u>Absen Sesi 1</u></b></label>
            <p>Latitude : <input type="text" readonly id="latitude" value="' . $absen->latitude1 . '"></p>
            <p>Longitude : <input type="text" readonly id="longitude" value="' . $absen->longitude1 . '"></p>
        </div>

        <div class="col-md-6">
            <label><b><u>Lokasi Rumah</u></b></label>
            <p>Latitude : <input type="text" readonly id="latitude_rumah" value="' . $absen_rumah->latitude_rumah . '"></p>
            <p>Longitude : <input type="text" readonly id="longitude_rumah" value="' . $absen_rumah->longitude_rumah . '"></p>
        </div>';
        $get_map2 = '<div class="col-md-6">
            <label><b><u>Absen Sesi 2</u></b></label>
            <p>Latitude : <input type="text" readonly id="latitude" value="' . $absen->latitude2 . '"></p>
            <p>Longitude : <input type="text" readonly id="longitude" value="' . $absen->longitude2 . '"></p>
        </div>

        <div class="col-md-6">
            <label><b><u>Lokasi Rumah</u></b></label>
            <p>Latitude : <input type="text" readonly id="latitude_rumah" value="' . $absen_rumah->latitude_rumah . '"></p>
            <p>Longitude : <input type="text" readonly id="longitude_rumah" value="' . $absen_rumah->longitude_rumah . '"></p>
        </div>';
        $get_map3 = '<div class="col-md-6">
            <label><b><u>Absen Sesi 3</u></b></label>
            <p>Latitude : <input type="text" readonly id="latitude" value="' . $absen->latitude3 . '"></p>
            <p>Longitude : <input type="text" readonly id="longitude" value="' . $absen->longitude3 . '"></p>
        </div>

        <div class="col-md-6">
            <label><b><u>Lokasi Rumah</u></b></label>
            <p>Latitude : <input type="text" readonly id="latitude_rumah" value="' . $absen_rumah->latitude_rumah . '"></p>
            <p>Longitude : <input type="text" readonly id="longitude_rumah" value="' . $absen_rumah->longitude_rumah . '"></p>
        </div>';

        if ($identitas == "absen1") {
            echo $get_map1;
        } else if ($identitas == "absen2") {
            echo $get_map2;
        } else {
            echo $get_map3;
        }
        ?>
    </div>
</div>


<div id="googleMap" style="width:100%;height:380px;"></div>

<center>
    <?php
    $konfirmasi1 = '<form method="POST" action="' . base_url('Absen_siswa/cek_absensi') . '">
        <button type="submit" value="absen1-' . $id . '" name="button-cek1" class="btn btn-primary mt-3">Konfirmasi</button>
    </form>';
    $konfirmasi2 = '<form method="POST" action="' . base_url('Absen_siswa/cek_absensi') . '">
        <button type="submit" value="absen2-' . $id . '" name="button-cek1" class="btn btn-primary mt-3">Konfirmasi</button>
    </form>';
    $konfirmasi3 = '<form method="POST" action="' . base_url('Absen_siswa/cek_absensi') . '">
        <button type="submit" value="absen3-' . $id . '" name="button-cek1" class="btn btn-primary mt-3">Konfirmasi</button>
    </form>';

    if ($identitas == "absen1") {
        echo $konfirmasi1;
    } else if ($identitas == "absen2") {
        echo $konfirmasi2;
    } else {
        echo $konfirmasi3;
    }

    ?>
</center>