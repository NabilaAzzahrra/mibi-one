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
                        <a class="btn btn-primary btn-sm" href="<?= base_url('Admin/add_m_transaksi') ?>">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Penayangan
                        </a>
                        <hr>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Film</th>
                                    <th class="text-center">Studio</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal Show</th>
                                    <th class="text-center">Jam</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
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
                                <tbody>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $r->judul ?></td>
                                        <td><?= $r->studio ?></td>
                                        <td><?= $day ?></td>
                                        <td><?= $r->tgl_show ?></td>
                                        <td><?= $r->jam_tayang ?></td>
                                        <td><?= $r->harga ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($r->status == 1) { ?>
                                                <a onclick="return offkan(`<?= $r->id_m_transaksi ?>`,`<?= $r->judul ?>`)" class="btn btn-success" href="#">
                                                    <!--<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>-->
                                                    <i class="bi bi-check-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Aktif
                                                </a>
                                            <?php } else { ?>
                                                <a onclick="return onkan(`<?= $r->id_m_transaksi ?>`,`<?= $r->judul ?>`)" class="btn btn-secondary" href="#">
                                                    <i class="bi bi-check-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Tidak Aktif
                                                </a>
                                            <?php }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-warning" href="<?= base_url('Admin/ubah_m_transaksi') ?>?id_m_transaksi=<?= $r->id_m_transaksi ?>">
                                                <i class="bi bi-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit
                                            </a>
                                            <a onclick="return hapus(`<?= $r->id_m_transaksi ?>`,`<?= $r->judul ?>`)" class="btn btn-danger" href="#">
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
                        <input type="hidden" name="id_m_transaksi">
                        <span id="modal-body-update-or-create">
                        </span>
                        <span id="modal-body-delete">
                            Yakin untuk menghapus <b id="name-delete"></b> dari tabel ini?
                        </span>
                        <span id="modal-body-onkan">
                            Yakin untuk mengaktifkan <b id="name-on"></b> dari tabel ini?
                        </span>
                        <span id="modal-body-offkan">
                            Yakin untuk menonaktifkan <b id="name-off"></b> dari tabel ini?
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
        function getStudio() {
            var kode = $('[name="id_studio"]').val();
            $('#space').load('<?= base_url() ?>Admin/getStudio/' + kode);
        }

        function tambah() {
            $('#Modal').modal('show');
            $('#modal-header').html('Tambah Master Transaksi');
            $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('#modal-body-onkan').addClass('d-none');
            $('#modal-body-offkan').addClass('d-none');
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
            $('#modal-body-onkan').addClass('d-none');
            $('#modal-body-offkan').addClass('d-none');
            $('[name="id_studio"]').val(id_studio);
            $('[name="studio"]').val(studio);
            $('[name="space"]').val(space);
            document.form.action = '<?= base_url('Admin/actedit_studio'); ?>';
        }

        function hapus(id_m_transaksi, judul) {
            $('#Modal').modal('show');
            $('#modal-header').html('Hapus Master Transaksi');
            $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('#modal-body-onkan').addClass('d-none');
            $('#modal-body-offkan').addClass('d-none');
            $('[name="id_m_transaksi"]').val(id_m_transaksi);
            $('#name-delete').html(judul);
            document.form.action = '<?= base_url('Admin/acthapus_m_transaksi'); ?>';
        }

        function onkan(id_m_transaksi, judul) {
            $('#Modal').modal('show');
            $('#modal-header').html('Aktif Master Transaksi');
            $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('#modal-body-onkan').removeClass('d-none');
            $('#modal-body-offkan').addClass('d-none');
            $('[name="id_m_transaksi"]').val(id_m_transaksi);
            $('#name-on').html(judul);
            document.form.action = '<?= base_url('Admin/actonkan_m_transaksi'); ?>';
        }

        function offkan(id_m_transaksi, judul) {
            $('#Modal').modal('show');
            $('#modal-header').html('Offkan Master Transaksi');
            $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
            $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('#modal-body-onkan').addClass('d-none');
            $('#modal-body-offkan').removeClass('d-none');
            $('[name="id_m_transaksi"]').val(id_m_transaksi);
            $('#name-off').html(judul);
            document.form.action = '<?= base_url('Admin/actoffkan_m_transaksi'); ?>';
        }
    </script>