<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <form name="form" action="<?= base_url('Admin/actadd_film') ?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">
                            <input type="hidden" name="id_film">
                            <div class="form-group col-md-6">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required value="<?= set_value('judul') ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jenis</label>
                                <input type="text" name="jenis" class="form-control" placeholder="Jenis" required value="<?= set_value('jenis') ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Produser</label>
                                <input type="text" name="produser" class="form-control" placeholder="Produser" required value="<?= set_value('produser') ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sutradara</label>
                                <input type="text" name="sutradara" class="form-control" placeholder="Sutradara" required value="<?= set_value('sutradara') ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Penulis</label>
                                <input type="text" name="penulis" class="form-control" placeholder="Penulis" required value="<?= set_value('penulis') ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Rumah Produksi</label>
                                <input type="text" name="produksi" class="form-control" placeholder="Produksi" required value="<?= set_value('produksi') ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Casts</label>
                                <input type="text" name="casts" class="form-control" placeholder="Casts" required value="<?= set_value('casts') ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sinopsis</label>
                                <textarea type="text" name="sinopsis" class="form-control" placeholder="Sinopsis" required value="<?= set_value('sinopsis') ?>"></textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Foto</label>
                                <input type="file" name="film_foto" class="form-control" placeholder="Foto">
                            </div>
                            <!-- <div class="form-group col-md-3">
                                <label>Studio</label>
                                <select class="form-control" id="id_studio" name="id_studio" onchange="return getStudio()" required value="<?= set_value('id_studio') ?>">
                                    <option value="" selected disabled>--Pilih Studio--</option>
                                    <?php foreach ($studio as $s) { ?>
                                        <option value="<?= $s->id_studio ?>"><?= $s->studio ?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
                            <!-- <div class="form-group col-md-2" id="space">
                                <label>Space</label>
                                <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= set_value('space') ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Tanggal Mulai Tayang</label>
                                <input type="date" name="tanggal_dari" class="form-control" placeholder="" value="<?= set_value('tanggal_dari') ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Tanggal Berakhir Tayang</label>
                                <input type="date" name="tanggal_sampai" class="form-control" placeholder="" value="<?= set_value('tanggal_sampai') ?>">
                            </div> -->

                        </div>
                        <div class="row" id="textboxDiv">
                            <!-- <div class="form-group col-md-3">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="" required value="<?= set_value('harga') ?>">
                            </div> -->
                            <!-- <div class="form-group col-md-3">
                                <label>Jam Tayang</label>
                                <input type="time" name="jam_tayang[]" class="form-control" placeholder="" required value="<?= set_value('jam_tayang') ?>">
                            </div> -->
                        </div>
                        <!-- <div class="alert alert-warning" role="alert">
                            Jika ingin menambah <b>inputan jam tayang</b> maka klik button di bawah sesuai dengan title pada button
                        </div> -->
                        <!-- <button class="btn btn-info btn-sm" id="Add">Tambah Inputan Jam Tayang</button> -->
                        <!-- <button class="btn btn-warning btn-sm" id="Remove">Hapus Inputan Jam Tayang</button> -->
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?=base_url('Admin/film')?>" type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <script>
        function getStudio() {
            var kode = $('[name="id_studio"]').val();
            $('#space').load('<?= base_url() ?>Admin/getStudio/' + kode);
        }

        $(document).ready(function() {
            $("#Add").on("click", function() {
                $("#textboxDiv").append("<div class='form-group col-md-3'><label>Jam Tayang</label><input type='time' name='jam_tayang[]' class='form-control' placeholder='' required></div>");
            });
            $("#Remove").on("click", function() {
                $("#textboxDiv").children().last().remove();
            });
        });
    </script>