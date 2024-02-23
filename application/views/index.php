<style>
    .card {
        border-radius: 15px;
        color: #fff;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Selamat datang, <?= $this->session->userdata('nama') ?>...</h3>
                        <h6 class="font-weight-normal mb-0">Dashboard Sistem Penjualan Tiket <span class="text-primary"><b>MiBi-One</b></span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <button class="btn btn-sm btn-light bg-white" type="button">
                                <?php
                                function hariIndo($hariInggris)
                                {
                                    switch ($hariInggris) {
                                        case 'Sunday':
                                            return 'Minggu';
                                        case 'Monday':
                                            return 'Senin';
                                        case 'Tuesday':
                                            return 'Selasa';
                                        case 'Wednesday':
                                            return 'Rabu';
                                        case 'Thursday':
                                            return 'Kamis';
                                        case 'Friday':
                                            return 'Jumat';
                                        case 'Saturday':
                                            return 'Sabtu';
                                        default:
                                            return 'hari tidak valid';
                                    }
                                }
                                $hariBahasaInggris = date('l');
                                $hariBahasaIndonesia = hariIndo($hariBahasaInggris);
                                ?>
                                <i class="mdi mdi-calendar"></i> <?= $hariBahasaIndonesia, date(', d F Y') ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card mb-0">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="<?= base_url('assets/template/') ?>images/dashboard/people.svg" alt="people">
                        <!-- <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Tasikmalaya</h4>
                                    <h6 class="font-weight-normal">Indonesia</h6>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card bg-success">
                            <div class="card-body">
                                <p class="mb-4">Jumlah Film Terdaftar</p>
                                <p class="fs-30 mb-2"><?= count($film) ?></p>
                                <!-- <p>10.00% (30 days)</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <p class="mb-4">Tiket terjual</p>
                                <p class="fs-30 mb-2"><?= count($pemesanan) ?></p>
                                <!-- <p>22.00% (30 days)</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <h4 class="mb-3">Film yang tayang hari ini</h4>
                                <?php
                                foreach ($read as $r) {
                                ?>
                                    <p class="fs-20 mb-3"><strong><?= $r->judul ?></strong> | <strong class="badge badge-primary"> <?= date('H:i', strtotime($r->jam_tayang)) ?> WIB</strong></p>
                                <?php
                                }
                                ?>
                                <!-- <p>2.00% (30 days)</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->