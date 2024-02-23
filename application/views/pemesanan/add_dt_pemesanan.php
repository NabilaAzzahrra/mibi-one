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
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?= base_url('Admin/acteditdetganti_kelas'); ?>" method="post" class="formupdate">
                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <?php if (count($id_m_transaksi)) : ?>
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">No Kursi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($id_m_transaksi as $r) :
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <input type="text" class="form-control" name="id_m_transaksi[]" value="<?= $r->nim ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="user_id[]" value="<?= $r->nama_lengkap ?>" readonly>
                                                </td>
                                                <!-- <td>
                                                <input type="text" class="form-control" name="nama_kelas[]" value="<?= $r->id_kelas ?>">
                                            </td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                            </table>
                        <?php else : ?>
                            NOT FOUND
                        <?php endif; ?>
                        </form>
                    </div>
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