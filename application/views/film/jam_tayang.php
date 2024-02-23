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
        }
        ?>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form name="form" action="<?= base_url('Admin/actedit_jam_tayang') ?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">
                            <input type="hidden" name="id_film[]" value="<?= $r->id_film ?>">
                        </div>
                        <div class="row" id="textboxDiv">
                            <div class="form-group col-md-3">
                                <label>Jam Tayang</label>
                                <input type="time" name="jam_tayang[]" class="form-control" placeholder="" required value="<?= set_value('jam_tayang') ?>">
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            Jika ingin menambah <b>inputan jam tayang</b> maka klik button di bawah sesuai dengan title pada button
                        </div>
                        <div>
                            <button class="btn btn-info btn-sm" id="Add">Tambah Inputan Jam Tayang</button>
                            <button class="btn btn-warning btn-sm" id="Remove">Hapus Inputan Jam Tayang</button>
                        </div><br>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <script>
        $(document).ready(function() {
            $("#Add").on("click", function() {
                $("#textboxDiv").append("<div class='form-group col-md-3'><label>Jam Tayang</label><input type='time' name='jam_tayang[]' class='form-control' placeholder='' required></div><div class='form-group col-md-3' hidden><label>ID FILM</label><input type='number' name='id_film[]' class='form-control' value='<?= $r->id_film ?>' required></div>");
            });
            $("#Remove").on("click", function() {
                $("#textboxDiv").children().last().remove();
            });
        });
    </script>