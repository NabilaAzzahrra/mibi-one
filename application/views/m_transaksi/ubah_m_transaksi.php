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
        }
        ?>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <form name="form" action="<?= base_url('Admin/actubah_m_transaksi') ?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">
                            <input type="hidden" name="id_m_transaksi" value="<?= $r->id_m_transaksi ?>">
                            <div class="form-group col-md-6">
                                <label for="id_film">Film</label>
                                <select class="form-control" id="id_film" name="id_film">
                                    <option value="<?= $r->id_film ?>" selected><?= $r->judul ?></option>
                                    <?php foreach ($film as $k) {
                                    ?>
                                        <option value="<?= $k->id_film ?>"><?= $k->judul ?></option>
                                    <?php  }  ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Studio</label>
                                <select class="form-control" id="id_studio" name="id_studio" required value="<?= set_value('id_studio') ?>">
                                    <option value="<?= $r->id_studio ?>" selected><?= $r->studio ?></option>
                                    <?php foreach ($studio as $s) { ?>
                                        <option value="<?= $s->id_studio ?>"><?= $s->studio ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="form-group col-md-3">
                                <label for="day">Hari</label>
                                <select class="form-control" id="day" name="day">
                                    <option value="<?= $r->day ?>" selected><?= $day ?></option>
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
                                <input type="date" name="tgl_show" class="form-control" placeholder="Tanggal Show" required value="<?= $r->tgl_show ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jam Show</label>
                                <input type="time" name="jam_tayang" class="form-control" placeholder="Jam Show" required value="<?= $r->jam_tayang ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="Harga" required value="<?= $r->harga ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Batal</button>
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