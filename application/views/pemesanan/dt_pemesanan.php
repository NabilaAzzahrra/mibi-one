<style>
    * {
        box-sizing: border-box;
    }

    .card img {
        height: 450px;
        width: 220px;
        border-radius: 15px 15px 0px 0px;
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
        background-color: azure;
        box-shadow: 0 16px 32px 0 rgba(0, 0, 0, 0.8);
    }

    .buy {
        display: block;
        background-color: #F9CC14;
        color: #000000;
        padding: 11px;
        text-align: center;
        font-weight: 600;
        width: 220px;
        border-radius: 0px 0px 15px 15px;

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
        <?php
        foreach ($read as $r) {
        }
        ?>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="foto ml-2">
                                    <img src="<?= base_url('./film/') . $r->foto ?>">
                                    <a class="buy mb-4" href="<?=base_url('Admin/pemesanan_tiket')?>?id_m_transaksi=<?=$r->id_m_transaksi?>">BUY TICKET</a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h3 class="mb-4 ml-4"><b><?= $r->judul ?></b></h3>

                                <div class="row ml-4">
                                    <div class="form-group col-md-3" id="space">
                                        <label>Jenis Film</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->jenis ?>">
                                    </div>
                                    <div class="form-group col-md-3" id="space">
                                        <label>Produser</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->produser ?>">
                                    </div>
                                    <div class="form-group col-md-3" id="space">
                                        <label>Sutradara</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->sutradara ?>">
                                    </div>
                                    <div class="form-group col-md-3" id="space">
                                        <label>Penulis</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->penulis ?>">
                                    </div>
                                    <div class="form-group col-md-3" id="space">
                                        <label>Produksi</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->produksi ?>">
                                    </div>
                                    <div class="form-group col-md-3" id="space">
                                        <label>Casts</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->casts ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tanggal Show</label>
                                        <input type="date" name="tgl_show" class="form-control" placeholder="Tanggal Show" readonly value="<?= $r->tgl_show ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Jam Show</label>
                                        <input type="time" name="jam_tayang" class="form-control" placeholder="Jam Show" readonly value="<?= $r->jam_tayang ?>">
                                    </div>
                                    <div class="form-group col-md-3" id="space">
                                        <label>Studio</label>
                                        <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= $r->studio ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control" placeholder="Harga" readonly value="<?= $r->harga ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Sinopsis</label>
                                        <textarea type="text" name="harga" class="form-control" placeholder="Sinopsis" readonly value=""><?= $r->sinopsis ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Ubah dan Tambah -->
    <form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        <div id="Modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-header" class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-d-none="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_studio">
                        <span id="modal-body-update-or-create">
                            <!-- <div class="form-group">
                                <label>Studio</label>
                                <input type="text" name="studio" class="form-control" placeholder="Studio">
                            </div>
                            <div class="form-group">
                                <label>Space</label>
                                <input type="number" name="space" class="form-control" placeholder="Space">
                            </div> -->
                            <div class="row">
                                <?php
                                foreach ($studio as $k) {
                                    # code...

                                ?>
                                    <div class="col-md-1 mr-2">
                                        <a class="btn btn-primary">A1</a>
                                    </div>
                                <?php } ?>
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