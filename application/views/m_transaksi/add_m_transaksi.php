<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="<?=base_url('assets/template/')?>library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
<script src="<?=base_url('assets/template/')?>library/bootstrap-5/bootstrap.bundle.min.js"></script>
<script src="<?=base_url('assets/template/')?>library/dselect.js"></script>
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
                    <form name="form" action="<?= base_url('Admin/actadd_m_transaksi') ?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">
                            <input type="hidden" name="id_m_transaksi">
                            <div class="form-group col-md-6">
                                <label for="id_film">Film</label>
                                <select class="form-control" id="id_film" name="id_film">
                                    <option value="" selected disabled>--Pilih--</option>
                                    <?php foreach ($film as $k) {
                                    ?>
                                        <option value="<?= $k->id_film ?>"><?= $k->judul ?></option>
                                    <?php  }  ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Studio</label>
                                <select class="form-control" id="id_studio" name="id_studio" onchange="return getStudio()" required value="<?= set_value('id_studio') ?>">
                                <!-- <select name="id_studio" class="form-select" id="select_box"> -->
                                    <option value="" selected disabled>--Pilih Studio--</option>
                                    <?php foreach ($studio as $s) { ?>
                                        <option value="<?= $s->id_studio ?>"><?= $s->studio ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="form-group col-md-3" id="space">
                                <label>Space</label>
                                <input type="text" name="space" class="form-control" placeholder="Space" readonly value="<?= set_value('space') ?>">
                            </div> -->
                            <!-- <div class="form-group col-md-3">
                                <label for="day">Hari</label>
                                <select class="form-control" id="day" name="day">
                                    <option value="" selected disabled>--Pilih--</option>
                                    <option value="Monday">Senin</option>
                                    <option value="Tuesday">Selasa</option>
                                    <option value="Wednesday">Rabu</option>
                                    <option value="Thursday">Kamis</option>
                                    <option value="Friday">Jumat</option>
                                    <option value="Saturday">Sabtu</option>
                                    <option value="Sunday">Minggu</option>
                                </select>
                            </div> -->
                            <div class="form-group col-md-3">
                                <label>Tanggal Show</label>
                                <input type="date" name="tgl_show" class="form-control" placeholder="Tanggal Show" required value="<?= set_value('tgl_show') ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jam Show</label>
                                <input type="time" name="jam_tayang" class="form-control" placeholder="Jam Show" required value="<?= set_value('jam_tayang') ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="Harga" required value="<?= set_value('harga') ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('Admin/m_transaksi') ?>" type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Batal</a>
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

    <script>
        var select_box_element = document.querySelector('#select_box');

        dselect(select_box_element, {
            search: true
        });
    </script>