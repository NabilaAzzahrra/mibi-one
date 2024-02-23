<style>
    /* .film{
        width: 100%;
        height: 100%;
    } */
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#disable').on('click', function() {
            $('#clickElement').off('click');
        });
        $('#clickElement').on('click', function() {
            alert('Welcome to CodexWorld!');
        });
    });
</script>
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
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <!-- <a onclick="return tambah()" class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tambah Studio
                        </a> -->

                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Pemesanan</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Studio</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal Show</th>
                                    <th class="text-center">Jam Tayang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Seat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                // $h_total = 0;
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
                                    // $tot_kursi = count($r->sheat);
                                    $cc = count($total);
                                    $h_total = $r->harga * $cc;
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $r->tgl_pemesanan ?></td>
                                        <td><?= date('H:i:s', strtotime($r->tgl_data)) ?></td>
                                        <td><?= $r->judul ?></td>
                                        <td><?= $r->studio ?></td>
                                        <td><?= $day ?></td>
                                        <td><?= $r->tgl_show ?></td>
                                        <td><?= $r->jam_tayang ?></td>
                                        <td><?= $r->harga ?></td>
                                        <td><?= $r->seat ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-danger" href="<?= base_url('Admin/cetak_pemesanan') ?>?id_pemesanan=<?= $r->id_pemesanan ?>&seat=<?= $r->seat ?>" id="disable" target="_blank">
                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Cetak
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