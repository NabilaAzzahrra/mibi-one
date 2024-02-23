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
                        <a onclick="return tambah()" class="btn btn-primary btn-sm" href="#">
                            <i class="bi bi-plus-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tambah User
                        </a>
                        <!-- <label class="btn btn-danger active">
                            <input type="checkbox" autocomplete="off" disabled > AI
                        </label> -->
                        <hr>
                        <?= $this->session->flashdata('pesan'); ?>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($read as $r) {
                                $session = $this->session->userdata('username');
                                if ($r->username != $session) {
                                    $off = "disabled";
                                }else{
                                    $off = "enabled";
                                }
                            ?>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $r->username ?></td>
                                        <td><?= str_repeat("*", strlen($r->password)); ?></td>
                                        <td><?= $r->nama ?></td>
                                        <td class="text-center">
                                            <a onclick="return ubah(`<?= $r->id_user ?>`,`<?= $r->username ?>`,`<?= $r->password ?>`,`<?= $r->nama ?>`)" class="btn btn-warning <?= $off ?>" href="#">
                                                <i class="bi bi-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit
                                            </a>
                                            <a onclick="return hapus(`<?= $r->username ?>`,`<?= $r->nama ?>`)" class="btn btn-danger <?= $off ?>" href="#">
                                                <i class="bi bi-trash3-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php }
                            ?>
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
                        <input type="hidden" name="username">
                        <input type="hidden" name="id_user">
                        <span id="modal-body-update-or-create">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" id="myInput" value="<?= set_value('password') ?>">
                                <input type="checkbox" onclick="myFunction()"> Show Password
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= set_value('nama') ?>">
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
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function tambah() {
            $('#Modal').modal('show');
            $('#modal-header').html('Tambah User');
            $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="username"]').val();
            $('[name="password"]').val();
            $('[name="nama"]').val();
            document.form.action = '<?= base_url('Admin/actadd_user'); ?>';
        }


        function ubah(id_user, username, password, nama) {
            $('#Modal').modal('show');
            $('#modal-header').html('Ubah Kelas');
            $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id_user"]').val(id_user);
            $('[name="username"]').val(username);
            $('[name="password"]').val(password);
            $('[name="nama"]').val(nama);
            document.form.action = '<?= base_url('Admin/actedit_user'); ?>';
        }

        function hapus(username, nama) {
            $('#Modal').modal('show');
            $('#modal-header').html('Hapus Kelas');
            $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('[name="username"]').val(username);
            $('#name-delete').html(nama);
            document.form.action = '<?= base_url('Admin/acthapus_user'); ?>';
        }
    </script>