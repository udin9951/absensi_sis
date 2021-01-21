<div class="logo">
    <a href="#">

        <label>
            <h3><?= $this->session->userdata('username') ?></h3>
        </label> <!-- <img src="<?php echo base_url(''); ?>asset/images/icon/logo-absensi.png" alt="MURIS STUDIO" /> -->

    </a>
</div>
<div class="menu-sidebar__content js-scrollbar1">
    <nav class="navbar-sidebar">
        <ul class="list-unstyled navbar__list">
            <li>
                <?php echo anchor('absen', '<i class="far fa-check-square"></i> Dashboard'); ?>
            </li>

            <li style="display : <?php if ($this->session->userdata('username') !=  "admin") echo "none";
                                    else  echo "block"; ?>">
                <?php echo anchor('guru', '<i class="far fa-check-square"></i> Data guru'); ?>
            </li>
            <li style="display : <?php if ($this->session->userdata('username') !=  "admin") echo "none";
                                    else  echo "block"; ?>">
                <?php echo anchor('kelas', '<i class="far fa-check-square"></i> Data Kelas'); ?>
            </li>
            <li>
                <?php echo anchor('siswa', '<i class="far fa-check-square"></i> Data Siswa'); ?>
            </li>
            <li style="display : <?php if ($this->session->userdata('username') !=  "admin") echo "none";
                                    else  echo "block"; ?>">
                <?php echo anchor('semester', '<i class="far fa-check-square"></i> Data Semester'); ?>
            </li>
            <li>
                <?php echo anchor('absen', '<i class="far fa-check-square"></i> Data Absensi'); ?>
            </li>
            <li style="display : <?php if ($this->session->userdata('username') !=  "admin") echo "none";
                                    else  echo "block"; ?>">
                <?php echo anchor('rekap_absensi', '<i class="far fa-check-square"></i> Rekap Absensi'); ?>
            </li>
            <li>
                <?php echo anchor('logout', '<i class="far fa-check-square"></i> Logout', array('onclick' => "return confirm('Anda yakin akan logout?')")); ?>
            </li>



        </ul>
    </nav>
</div>