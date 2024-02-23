<!DOCTYPE html>


<body class="A4 landscape">
    <div class="sheet">
        <table class="text-center mt-10 mb-2" align="center">
            <td>
            </td>
            <td class="text-center" align="center">
                <h1>Daftar Pemesanan</h1>
                <h4 class="text-center">MiBi-One</h4>
            </td>
        </table>

        <hr noshade size=4 width="98%">


        <div style="width:100%" align="center">
            <h2>Pemesanan MiBi-One</h2>
        </div><br>
        <div>
            <table border="1" cellspacing="0" cellpadding="5" style="margin:auto">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Id Pemesanan</th>
                        <th class="text-center">Tanggal Pemesanan</th>
                        <th class="text-center">Waktu Pemesanan</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Studio</th>
                        <th class="text-center">Hari</th>
                        <th class="text-center">Tanggal Show</th>
                        <th class="text-center">Jam Tayang</th>
                        <th class="text-center">Seat</th>
                        <th class="text-center">Harga</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $id_pemesanan = "";
                    $id_m_transaksi = "";
                    $no = 1;
                    $total = 0;
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
                        
                        $total += $r->harga;

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pemesanan ?></td>
                            <td><?= $r->tgl_pemesanan ?></td>
                            <td><?= date('H:i:s', strtotime($r->tgl_data)) ?></td>
                            <td><?= $r->judul ?></td>
                            <td><?= $r->studio ?></td>
                            <td><?= $day ?></td>
                            <td><?= $r->tgl_show ?></td>
                            <td><?= $r->jam_tayang ?></td>
                            <td><?= $r->seat ?></td>
                            <td><span class="float-left">Rp</span> <?= number_format($r->harga, 0, ".", "."); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center text-bold" colspan="10">TOTAL</td>
                        <td class="text-right text-bold"><span class="float-left">Rp</span> <?= number_format($total, 0, ".", "."); ?></td>
                    </tr>
                </tfoot>
            </table><br>
        </div>
    </div>

</body>
<script>
    // window.print();
</script>