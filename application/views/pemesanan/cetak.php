<!DOCTYPE html>

<style>
    img {
        position: relative;
        z-index: 1;
        top: 0px;
    }

    .tgl {
        position: absolute;
        margin-left: 940px;
        top: 280px;
        z-index: 2;
        color: #000;
    }

    .addr {
        position: absolute;
        margin-left: 940px;
        top: 320px;
        z-index: 2;
        color: #000;
    }

    .seat {
        position: absolute;
        margin-left: 1020px;
        top: 248px;
        z-index: 2;
        color: #000;
    }

    .baris {
        position: absolute;
        margin-left: 1020px;
        top: 210px;
        z-index: 2;
        color: #000;
    }

    .studio {
        position: absolute;
        margin-left: 1020px;
        top: 168px;
        z-index: 2;
        color: #000;
    }

    .judul {
        position: absolute;
        margin-left: 940px;
        margin-right: 90px;
        top: 100px;
        z-index: 2;
        color: #000;
    }

    .bioskop {
        position: absolute;
        margin-left: 940px;
        margin-right: 90px;
        top: 40px;
        z-index: 2;
        color: #000;
    }

    .bioskop3 {
        position: absolute;
        margin-left: 420px;
        margin-right: 90px;
        top: 100px;
        z-index: 2;
        color: #000;
    }

    .judul3 {
        position: absolute;
        margin-left: 420px;
        margin-right: 90px;
        top: 150px;
        z-index: 2;
        color: #000;
    }

    .studio3 {
        position: absolute;
        margin-left: 510px;
        top: 240px;
        z-index: 2;
        color: #000;
    }

    .baris3 {
        position: absolute;
        margin-left: 640px;
        top: 240px;
        z-index: 2;
        color: #000;
    }

    .seat3 {
        position: absolute;
        margin-left: 780px;
        top: 240px;
        z-index: 2;
        color: #000;
    }

    .tgl3 {
        position: absolute;
        margin-left: 420px;
        top: 280px;
        z-index: 2;
        color: #000;
    }

    .addr3 {
        position: absolute;
        margin-left: 420px;
        top: 300px;
        z-index: 2;
        color: #000;
    }
</style>


<body>
    <div>

        <!-- <body class="A4">
    <div class="sheet"> -->

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
            <div>
                <img src="<?= base_url('assets/template') ?>/images/temp_laporan/Theater Ticket (Kosong) Grayscale.png" width="100%">
                <div class="row">
                    <div class="col-md-3" hidden>
                        <h4 class="bioskop2">Bioskop Terwantas</h4>
                        <h3 class="judul2"><?= $r->judul ?></h3>
                        <div class="row">
                            <div class="studio2 col-md-1 mr-4 mb-4 studio"><?= substr($r->studio, -1) ?></div>
                            <div class="baris2 col-md-1 mr-4"><?= substr($r->seat, 0, 1) ?></div>
                            <div class="seat2 col-md-1"><?= substr($r->seat, -1) ?></div>
                        </div>
                        <h4 class="tgl2"><?= date('d-m-Y', strtotime($r->tgl_show)) ?></h4>
                        <h5 class="addr2">at Bioskop Terwantas</h5>
                    </div>

                    <div class="samping">
                        <h4 class="bioskop">Bioskop Terwantas</h4>
                        <h3 class="judul"><?= $r->judul ?></h3>
                        <div class="studio mr-4 mb-2 studio"><?= substr($r->studio, -1) ?></div>
                        <div class="baris mr-4 mb-2"><?= substr($r->seat, 0, 1) ?></div>
                        <div class="seat mb-2"><?= substr($r->seat, -1) ?></div>
                        <h4 class="tgl"><?= $day ?>,<br> <?= date('d F Y', strtotime($r->tgl_show)) ?></h4>
                        <h5 class="addr">at Bioskop Terwantas</h5>
                    </div>
                    <div class="samping">
                        <h3 class="bioskop3">Bioskop Terwantas</h3>
                        <h2 class="judul3"><?= $r->judul ?></h2>
                        <div class="row">
                            <div class="studio3 col-md-1 mr-4 mb-4 studio">
                                <h3><?= substr($r->studio, -1) ?></h3>
                            </div>
                            <div class="baris3 col-md-1 mr-4">
                                <h3><?= substr($r->seat, 0, 1) ?></h3>
                            </div>
                            <div class="seat3 col-md-1">
                                <h3><?= substr($r->seat, -1) ?></h3>
                            </div>
                        </div>
                        <h4 class="tgl3"><?= $day ?>, <?= date('d F Y', strtotime($r->tgl_show)) ?></h4>
                        <h5 class="addr3">at Bioskop Terwantas</h5>
                    </div>
                </div>
            </div>

            <!-- <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">id_pemesanan</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Tanggal show</th>
                        <th class="text-center">jam tayang</th>
                        <th class="text-center">Studio</th>
                        <th class="text-center">tanggal pesan</th>
                        <th class="text-center">Row</th>
                        <th class="text-center">seat</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    // $h_total = 0;
                    foreach ($read as $r) {

                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $r->id_pemesanan ?></td>
                            <td><?= $r->judul ?></td>
                            <td><?= $r->tgl_show ?></td>
                            <td><?= $r->jam_tayang ?></td>
                            <td><?= $r->studio ?></td>
                            <td><?= $r->tgl_data ?></td>
                            <td><?= substr($r->seat, 0, 1) ?></td>
                            <td><?= substr($r->seat, -1) ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>

            </table> -->

        <?php        // } ?>
    </div>

</body>
<script>
    window.print();
</script>