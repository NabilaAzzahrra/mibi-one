<style>
    * {
        box-sizing: border-box;
    }

    .card img {
        height: 240px;
        /* width: 220px; */
    }

    .card-row {
        width: 100%;
        margin: 0 5px;
    }

    .card-column {
        width: 15%;
        float: left;
        padding: 0 16px;
    }

    .card {
        background-color: white;
        padding: 16px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        transition: 0.8s;
    }

    .card:hover {
        background-color: antiquewhite;
        box-shadow: 0 16px 32px 0 rgba(0, 0, 0, 0.8);
    }

    @media screen and (max-width: 600px) {
        .card-column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    /* .title { */
    /* text-align: center; */
    /* margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 3px;
        margin-right: 5px;
        min-height: 50px; */
    /* text-align: center;
        font-size: 12px;
        font-weight: bold;
    } */
</style>
<link rel="stylesheet" href="style.css">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 mb-4">
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


        <!-- <div class="card position-relative">
                    <div class="card-header">
                        <form action="<?= base_url('Peserta/presensi') ?>" method="GET">
                            <div class="row">
                                <div class="mt-2 ml-2 text-primary">Semester :</div>
                                <div class="form-group col-lg-2">
                                    <select id="semester" class="form-control" name="semester">
                                        <option value="all">--ALL--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="ml-2 btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="card-body">


                </div>
            </div> -->

        <!-- <div class="grid">
                    <div class="grid_movie">
                        <img src="<?= base_url('./film/') . $r->foto ?>" style="max-height:700px">
                        <div class="title">
                            <?= $r->judul ?>
                        </div>
                    </div>
                </div> -->
        <?= $this->session->flashdata('pesan'); ?>
        <?php
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
            <div class="card-row">
                <div class="card-column mr-5">
                    <div class="card mx-8" style="width: 12rem;">
                        <img src="<?= base_url('./film/') . $r->foto ?>" class="mb-3">
                        <h4 class="mb-3"><a href="<?= base_url('Admin/pemesanan_tiket') ?>?id_m_transaksi=<?= $r->id_m_transaksi ?>"><?= $r->judul ?></a></h4>
                        <h6><?= $day ?>, <?= $r->tgl_show ?></h6>
                        <p>Pukul <?= date('H:i', strtotime($r->jam_tayang)) ?> WIB</p>
                        <h6>Rp. <?= $r->harga ?></h6>
                    </div>
                </div>
            </div>
        <?php } ?>

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