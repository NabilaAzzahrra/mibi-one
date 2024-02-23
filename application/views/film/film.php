<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<style>
    /* .film{
        width: 100%;
        height: 100%;
    } */
</style>
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
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">

                <div class="card position-relative">
                    <div class="card-body">
                        <a href="<?= base_url('Admin/film_add') ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tambah Film
                        </a>
                        <hr>
                        <!-- <div class="alert alert-warning" role="alert">
                            Jam tayang dapat dilihat ketika akan melakukan order tiket
                        </div> -->
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center" style="width: 25%;">Poster</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Sutradara</th>
                                    <th class="text-center">Rumah Produksi</th>
                                    <!-- <th class="text-center">Jam Tayang</th> -->
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($read as $r) {
                                ?>

                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><img class="film" src="<?= base_url('./film/') . $r->foto ?>"></td>
                                        <td><?= $r->judul ?></td>
                                        <td><?= $r->jenis ?></td>
                                        <td><?= $r->sutradara ?></td>
                                        <td><?= $r->produksi ?></td>
                                        <?php
                                        $this->db->select('*');
                                        $this->db->from('jam_tayang');
                                        $this->db->join('film', 'film.id_film=jam_tayang.id_film');
                                        // $cek = $this->db->get();
                                        // if ($cek->num_rows() > 0) {
                                        //     $jam_tayang = 'Sudah ada jam tayang';
                                        // } else {
                                        //     $jam_tayang = 'Belum ada jam tayang';
                                        // }
                                        // 
                                        ?>
                                        <!-- <td><?= $jam_tayang ?></td> -->
                                        <td class="text-center">
                                            <!-- <a type="button" class="btn btn-primary <?php if ($jam_tayang == 'Sudah ada jam tayang') {
                                                                                                echo "disabled";
                                                                                            } ?>" href="<?= base_url('Admin/jam_tayang') ?>?id_film=<?= $r->id_film ?>">
                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Tambah Jam Tayang
                                            </a> -->
                                            <!-- <a type="button" class="btn btn-primary" href="<?= base_url('Admin/edit_jam_tayang') ?>?id_film=<?= $r->id_film ?>">
                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit Jam Tayang
                                            </a> -->
                                            <!-- YANG INI MAH NANTI PAS DI KLIK ITU MUNCUL DAFTAR JAM TAYANG NAH MASING MASING ADA AKSINYA YAKNI EDIT DAN HAPUS -->
                                            <!-- <a type="button" class="btn btn-primary" href="<?= base_url('Admin/edit_jam_tayang') ?>?id_film=<?= $r->id_film ?>">
                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit Jam Tayang
                                            </a> -->
                                            <a type="button" class="btn btn-warning" href="<?= base_url('Admin/film_edit') ?>?id_film=<?= $r->id_film ?>">
                                                <i class="bi bi-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit
                                            </a>
                                            <a onclick="return hapus(`<?= $r->id_film ?>`,`<?= $r->judul ?>`)" class="btn btn-danger" href="#">
                                                <i class="bi bi-trash3-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>

                                <?php }
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
                        <input type="hidden" name="id_film">
                        <span id="modal-body-update-or-create">
                            <div class="alert alert-warning" role="alert">
                                Jika ingin menambah <b>inputan jam tayang</b> maka klik button di bawah sesuai dengan title pada button
                            </div>
                            <button class="btn btn-info btn-sm" id="Add">Tambah Inputan Jam Tayang</button>
                            <button class="btn btn-warning btn-sm" id="Remove">Hapus Inputan Jam Tayang</button>
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
        function hapus(id_film, judul) {
            $('#Modal').modal('show');
            $('#modal-header').html('Hapus Kelas');
            $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('[name="id_film"]').val(id_film);
            $('#name-delete').html(judul);
            document.form.action = '<?= base_url('Admin/acthapus_film'); ?>';
        }

        function jam_tayang(id_film) {
            $('#Modal').modal('show');
            $('#modal-header').html('Jam Tayang');
            $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id_film"]').val(id_film);
            $('[name="jam_tayang"]').val();
            // $('#name-delete').html(judul);
            document.form.action = '<?= base_url('Admin/actedit_studio'); ?>';
        }
    </script>