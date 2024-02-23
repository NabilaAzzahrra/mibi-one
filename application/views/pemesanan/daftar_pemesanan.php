<style>
    /* .film{
        width: 100%;
        height: 100%;
    } */
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#disable').on('click', function() {
            $('#clickElement').off('click');
        });
        $('#clickElement').on('click', function() {
            alert('Welcome to CodexWorld!');
        });
    });
</script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"><?= $title ?></h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <h6 class="font-weight-normal mb-0"><?= $title ?> / <span class="text-primary"><a href="<?= base_url('Admin/index') ?>">Dashboard</a></span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-header">
                        <div class="col-md-12">
                            <form action="<?= base_url('Admin/lihat_daftar_pemesanan') ?>" method="GET">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="bulan">Bulan</label>
                                        <select class="form-control" id="bulan" name="bulan" onchange="bln()" required>
                                            <option value="" selected disabled>--Pilih--</option>
                                            <option value="all">ALL</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="tahun">Tahun</label>
                                        <select class="form-control" id="tahun" name="tahun" onchange="thn()" required>
                                            <option value="" selected disabled>--Pilih--</option>
                                            <option value="all">--ALL--</option>
                                            <?php foreach ($tahun as $k) {
                                            ?>
                                                <option value="<?= date('Y', strtotime($k->tgl_pemesanan)) ?>"><?= date('Y', strtotime($k->tgl_pemesanan)) ?></option>
                                            <?php  }  ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="film">Film</label>
                                        <select class="form-control" id="film" name="film" onchange="flm()" required>
                                            <option value="" selected disabled>--Pilih--</option>
                                            <option value="all">ALL</option>
                                            <?php foreach ($film as $k) {
                                            ?>
                                                <option value="<?= $k->id_film ?>"><?= $k->judul ?></option>
                                            <?php  }  ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="film"></label>
                                        <button type="submit" class="form-control btn btn-primary btn-sm" name="form"><span><i class="fas fa-search"></i></span>Tampilkan</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="col-md-12">
                            <form action="<?= base_url('Admin/print') ?>" target="_blank">

                                <div class="row">
                                    <?php
                                    if (isset($_GET['form'])) {
                                        $_SESSION['eName'] = $_GET['bulan'];
                                        $_SESSION['eThn'] = $_GET['tahun'];
                                        $_SESSION['eFlm'] = $_GET['film'];
                                    }
                                    ?>

                                    <div class="form-group col-md-3" hidden>
                                        <label for="bulan">Bulan</label>
                                        <input type="text" name="nm_bln" class="form-control" value="<?php if(isset($_SESSION['eName'])) { echo $_SESSION['eName']; }?>">
                                    </div>
                                    <div class="form-group col-md-3" hidden>
                                        <label for="bulan">Tahun</label>
                                        <input type="text" name="nm_tahun" class="form-control" value="<?php if(isset($_SESSION['eThn'])) { echo $_SESSION['eThn']; }?>">
                                    </div>
                                    <div class="form-group col-md-3" hidden>
                                        <label for="bulan">Film</label>
                                        <input type="text" name="nm_film" class="form-control" value="<?php if(isset($_SESSION['eFlm'])) { echo $_SESSION['eFlm']; }?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="film"></label>
                                        <button type="submit" class="form-control btn btn-warning btn-sm"><span><i class="fas fa-search"></i></span>Print</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <a onclick="return tambah()" class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tambah Studio
                        </a> -->

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Id Pemesanan</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Pemesanan</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Studio</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal Show</th>
                                    <th class="text-center">Jam Tayang</th>
                                    <th class="text-center">Seat</th>
                                    <th class="text-center">Harga</th>
                                    <!-- <th class="text-center">Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $id_pemesanan = "";
                                $id_m_transaksi = "";
                                $no = 1;
                                foreach ($read as $r) {
                                    $day = "";
                                    if ($r->day == 'Monday') {
                                        $day = 'Senin';
                                    } elseif ($r->day == 'Tuesday') {
                                        $day = 'Selasa';
                                    } elseif ($r->day == 'Wednesday') {
                                        $day = 'Rabu';
                                    } elseif ($r->day == 'Thursday') {
                                        $day = 'Kamis';
                                    } elseif ($r->day == 'Friday') {
                                        $day = 'Jumat';
                                    } elseif ($r->day == 'Saturday') {
                                        $day = 'Sabtu';
                                    } elseif ($r->day == 'Sunday') {
                                        $day = 'Minggu';
                                    }

                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $r->id_pemesanan ?></td>
                                        <td><?= $r->tgl_pemesanan ?></td>
                                        <td><?= date('H:i:s', strtotime($r->tgl_data)) ?></td>
                                        <td><?= $r->judul ?></td>
                                        <td><?= $r->studio ?></td>
                                        <td><?= $day ?></td>
                                        <td><?= $r->tgl_show ?></td>
                                        <td><?= $r->jam_tayang ?></td>
                                        <td><?= $r->seat ?></td>
                                        <td><?= $r->harga ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ubah dan Tambah -->
    <form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        <div id="Modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-header" class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-d-none="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_studio">
                        <span id="modal-body-update-or-create">
                            <div class="form-group">
                                <label>Studio</label>
                                <input type="text" name="studio" class="form-control" placeholder="Studio">
                            </div>
                            <div class="form-group">
                                <label>Space</label>
                                <input type="number" name="space" class="form-control" placeholder="Space">
                            </div>
                        </span>
                        <span id="modal-body-delete">
                            Yakin untuk menghapus <b id="name-delete"></b> dari tabel ini?
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block" id="modal-button" style="color: #fff;">Simpan</button>
                        <button type="button" class="btn btn-block" data-dismiss="modal" id="batal" aria-d-none="true" style="color: #fff;">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- content-wrapper ends -->
    <script type="text/javascript">
        function bln() {
            var tes = document.getElementById("bulan").value;
            document.getElementById("isi_bulan").value = tes;
        }

        function thn() {
            var tes = document.getElementById("tahun").value;
            document.getElementById("isi_tahun").value = tes;
        }

        function flm() {
            var tes = document.getElementById("film").value;
            document.getElementById("isi_film").value = tes;
        }
    </script>
    <script>
        function tambah() {
            $('#Modal').modal('show');
            $('#modal-header').html('Tambah Studio');
            $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id_studio"]').val();
            $('[name="studio"]').val();
            $('[name="space"]').val();
            document.form.action = '<?= base_url('Admin/actadd_studio'); ?>';
        }


        function ubah(id_studio, studio, space) {
            $('#Modal').modal('show');
            $('#modal-header').html('Ubah Kelas');
            $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id_studio"]').val(id_studio);
            $('[name="studio"]').val(studio);
            $('[name="space"]').val(space);
            document.form.action = '<?= base_url('Admin/actedit_studio'); ?>';
        }

        function hapus(id_studio, studio) {
            $('#Modal').modal('show');
            $('#modal-header').html('Hapus Kelas');
            $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('[name="id_studio"]').val(id_studio);
            $('#name-delete').html(studio);
            document.form.action = '<?= base_url('Admin/acthapus_studio'); ?>';
        }
    </script>