<!-- <style>
    img {
        position: relative;
        z-index: 1;
        top: 0px;
    }

    .tgl {
        position: absolute;
        margin-left: 840px;
        top: 250px;
        z-index: 2;
        color: #000;
    }

    .addr {
        position: absolute;
        margin-left: 840px;
        top: 290px;
        z-index: 2;
        color: #000;
    }

    .seat {
        position: absolute;
        margin-left: 1020px;
        top: 235px;
        z-index: 2;
        color: #000;
    }

    .baris {
        position: absolute;
        margin-left: 940px;
        top: 200px;
        z-index: 2;
        color: #000;
    }

    .studio {
        position: absolute;
        margin-left: 940px;
        top: 164px;
        z-index: 2;
        color: #000;
    }

    .judul {
        position: absolute;
        margin-left: 840px;
        margin-right: 90px;
        top: 80px;
        z-index: 2;
        color: #000;
    }

    .bioskop {
        position: absolute;
        margin-left: 840px;
        margin-right: 90px;
        top: 35px;
        z-index: 2;
        color: #000;
    }

    .bioskop3 {
        position: absolute;
        margin-left: 370px;
        margin-right: 90px;
        top: 40px;
        z-index: 2;
        color: #000;
    }

    .judul3 {
        position: absolute;
        margin-left: 370px;
        margin-right: 90px;
        top: 100px;
        z-index: 2;
        color: #000;
    }

    .studio3 {
        position: absolute;
        margin-left: 450px;
        top: 210px;
        z-index: 2;
        color: #000;
    }

    .baris3 {
        position: absolute;
        margin-left: 580px;
        top: 210px;
        z-index: 2;
        color: #000;
    }

    .seat3 {
        position: absolute;
        margin-left: 700px;
        top: 210px;
        z-index: 2;
        color: #000;
    }

    .tgl3 {
        position: absolute;
        margin-left: 370px;
        top: 260px;
        z-index: 2;
        color: #000;
    }

    .addr3 {
        position: absolute;
        margin-left: 370px;
        top: 280px;
        z-index: 2;
        color: #000;
    }
</style> -->
<!-- <body>
    <div> -->

<!-- <body class="A4">
    <div class="sheet">


        <div style="height: 1500px;">
            <div>
                <img src="<?= base_url('assets/template') ?>/images/temp_laporan/Theater Ticket (Kosong) Grayscale.png" width="100%">
            </div>
            <?php
            $totalRec = count($id_pemesanan);
            $count = 0;
            foreach ($id_pemesanan as $r) {
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
                        <div class="seat "><?= substr($r->seat, -1) ?></div>
                        <h4 class="tgl"><?= $day ?>,<br> <?= date('d F Y', strtotime($r->tgl_show)) ?></h4>
                        <h5 class="addr">at Bioskop Terwantas</h5>
                    </div>
                    <div class="samping">
                        <h3 class="bioskop3">Bioskop Terwantas</h3>
                        <h1 class="judul3"><?= $r->judul ?></h1>
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

                    <?php
                    if ($count % 1 == 0 && $totalRec == 1) {
                    ?>
                </div>

                <p style='page-break-after:always'></p>

                <div>
                    <img src="<?= base_url('assets/template') ?>/images/temp_laporan/Theater Ticket (Kosong) Grayscale.png" width="100%">
                </div>
                <div class="row">

            <?php        }
                    $count++;
                }

            ?>
                </div>
        </div>



    </div>

</body>
<script>
    window.print();
</script> -->

<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        tr td {
            page-break-before: auto;
            page-break-inside: avoid !important;
        }

        table {
            /* font-size: small; */
            background-image: url("<?= base_url('assets/template') ?>/images/temp_laporan/bg_tiket.png");
            width: 964px;
            height: 312px;
            border: 1px solid black;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .button{
            background-color: cadetblue;
        }
        @media print {
        .balik {
            display: none !important;
        }
    }
    </style>
</head>
<a type="button" href="<?= base_url('Admin/pemesanan') ?>" class="button  balik">Kembali</a>
<body class="m-4" onload=onload()>
    <div class="col-12">
        <div class="col m-3">

            <?php
            $TotalNoOfRecords = 2;
            $Count = 1;
            foreach ($id_pemesanan as $r) { 
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
                <table id="bud" style="padding-top: 60px;">
                    <tr>
                        <td style="text-align: left; width:36%; height: 5%;"></td>
                        <td style="text-align: left; width:20%;height: 5%;"> MiBi-One</td>
                        <td style="text-align: left; width:5%"></td>
                        <td style="text-align: left; width:5%"></td>
                        <td style="text-align: left; width:15%"></td>
                        <td style="text-align: left; width:20%; padding-left: 15px;"><br>MiBi-One</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:36%;"></td>
                        <td style="text-align: left; width:20%;height: 10%; font-size: x-large; font-weight: bold;"><?= $r->judul ?></td>
                        <td style="text-align: left; width:5%"></td>
                        <td style="text-align: left; width:5%"></td>
                        <td style="text-align: left; width:15%"></td>
                        <td style="text-align: left; width:20%; padding-left: 15px; font-weight: bold;"><?= $r->judul ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:36%;"></td>
                        <td style="text-align: left; width:20%;"></td>
                        <td style="text-align: left; width:5%"></td>
                        <td style="text-align: left; width:5%"></td>
                        <td style="text-align: left; width:15%"></td>
                        <td style="text-align: left; width:20%; padding-left: 15px; padding-top: 10px;" rowspan="2">
                        &emsp;&emsp;&emsp;&emsp;&emsp;<?= substr($r->studio, -1) ?> 
                        <br><br> 
                        &emsp;&emsp;&emsp;&emsp;&emsp;<?= substr($r->seat, 0, 1) ?> 
                        <br><br> 
                        &emsp;&emsp;&emsp;&emsp;&emsp;<?= substr($r->seat, -1) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:36%;"></td>
                        <td style="text-align: left; width:10%; height: 10%; padding-top: 60px;" colspan="4"> 
                        &emsp;&emsp;&emsp;&emsp;&emsp;<?= substr($r->studio, -1) ?> 
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= substr($r->seat, 0, 1) ?> 
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= substr($r->seat, -1) ?>
                        </td>

                    </tr>
                    <tr>
                        <td style="text-align: left; width:36%;"></td>
                        <td style="text-align: left; width:10%; height: 10%; padding-top: 5px; font-weight: bold;" colspan="4"><?= $day ?>, <?= date('d F Y', strtotime($r->tgl_show)) ?></td>
                        <td style="text-align: left; width:20%; padding-left: 15px; font-weight: bold;" rowspan="2">
                        <?= $day ?>, <?= date('d F Y', strtotime($r->tgl_show)) ?> <br> at  MiBi-One
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:36%;"></td>
                        <td style="font-weight: bold;">at MiBi-One</td>
                    </tr>
                    <?php
                    if ($Count % 1 == 0 && $Count = 1) {
                    ?>
                </table>

                <p style='page-break-after:always'></p>

        <?php }
                    $Count++;
                }
        ?>

        </div>
    </div>
</body>
<script>
    function onload() {
        window.print();
    }
</script>

</html>