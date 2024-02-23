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
            <div class="card position-relative">
                <div class="card-body">
                    <form name="form" action="<?= base_url('Admin/actedit_film') ?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">
                            <input type="hidden" name="id_film">
                            <div class="form-group col-md-6" hidden>
                                <label>ID Film</label>
                                <input type="text" name="id_film" class="form-control" placeholder="ID Film" required value="<?= $r->id_film ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required value="<?= $r->judul ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jenis</label>
                                <input type="text" name="jenis" class="form-control" placeholder="Jenis" required value="<?= $r->jenis ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Produser</label>
                                <input type="text" name="produser" class="form-control" placeholder="Produser" required value="<?= $r->produser ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sutradara</label>
                                <input type="text" name="sutradara" class="form-control" placeholder="Sutradara" required value="<?= $r->sutradara ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Penulis</label>
                                <input type="text" name="penulis" class="form-control" placeholder="Penulis" required value="<?= $r->penulis ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Produksi</label>
                                <input type="text" name="produksi" class="form-control" placeholder="Produksi" required value="<?= $r->produksi ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Casts</label>
                                <input type="text" name="casts" class="form-control" placeholder="Casts" required value="<?= $r->casts ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sinopsis</label>
                                <input type="text" name="sinopsis" class="form-control" placeholder="Sinopsis" required value="<?= $r->sinopsis ?>"></input>
                            </div>
                            <div class="form-group col-md-6 ml-100">
                                <img class="film" src="<?= base_url('./film/') . $r->foto ?>" width="50%">
                            </div>
                            <div class=" form-group col-md-6 ">
                                <label>Foto</label>
                                <input type="file" name="film_foto" class="form-control" placeholder="Foto">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->