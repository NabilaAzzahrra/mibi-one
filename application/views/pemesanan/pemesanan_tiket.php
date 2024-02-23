<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-size: 16px;
        background: black;
    }

    .plane {
        margin: 20px auto;
        max-width: 300px;
        background: white;
        border-top-left-radius: 50%;
        border-top-right-radius: 50%;
    }

    .select {
        height: 250px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .select h1 {
        width: 60%;
        margin: 100px auto 35px auto;
    }

    .exit {
        position: relative;
        height: 50px;
    }

    .exit:before,
    .exit:after {
        content: "EXIT";
        font-size: 14px;
        line-height: 18px;
        padding: 0px 2px 2px 2px;
        display: block;
        position: absolute;
        background: red;
        color: white;
        top: 50%;
        transform: translate(0, -50%);
        border-radius: 5px;
    }

    .exit:before {
        left: 10px;
    }

    .exit:after {
        right: 10px;
    }

    ol {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .seats {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        /*width: 300px;*/
    }

    .seat {
        display: flex;
        flex: 0 0 14.28%;
        padding: 5px;
        position: relative;
    }

    .seat label {
        display: block;
        position: relative;
        width: 100%;
        text-align: center;
        font-size: 14px;
        font-weight: bolder;
        line-height: 1.5rem;
        padding: 4px 0;
        background: #5bfc60;
        border-radius: 5px;
        color: black;
        /*width: 50px;*/
    }

    .seat label:hover {
        cursor: pointer;
        box-shadow: 0 0 0px 2px green;
    }

    .seat:nth-child(3) {
        /* margin-right: 14%; */
    }

    .seat input[type=checkbox] {
        position: absolute;
    }

    .seat input[type=checkbox]:checked+label {
        background: #656e65;
    }
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
        <?php
        foreach ($read as $r) {
        }
        ?>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative align-center">
                <div class="card-body">
                    <form name="form" action="<?= base_url('') ?>Admin/actadd_dt_pemesanan" method="post" enctype="multipart/form-data" accept-charset="UTF-8">

                        <div class="row">
                            <input type="hidden" name="id_m_transaksi" value="<?= $r->id_m_transaksi ?>">

                        </div>


                        <?php

                        $date = date('Ymdhis');

                        $kolom = $r->kolom;
                        $baris = $r->baris;

                        $hidden = $kolom;
                        $jumlah_x = $baris;


                        $abjad = array(" ", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "O", "P");

                        for ($j = 1; $j <= $jumlah_x; $j++) {

                            echo "<ol class='seats w-50'>";
                            for ($i = 1; $i <= $hidden; $i++) {
                                echo "<li class='seat'>";

                        ?>
                                <?php
                                $hu = "$abjad[$j]$i";

                                $this->db->select('*');
                                $this->db->from('pemesanan');
                                $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
                                $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
                                $this->db->where('pemesanan.seat =', $hu);
                                $this->db->where('pemesanan.id_m_transaksi =', $r->id_m_transaksi);
                                $cek = $this->db->get();
                                if ($cek->num_rows() > 0) {
                                    $bg = "danger";
                                    $disab = "disabled";
                                } else {
                                    $bg = "";
                                    $disab = "enabled";
                                }

                                echo "<input type='hidden' name='id_pemesanan' value='$date'>
                                <input type='checkbox' id='$abjad[$j]$i' name='user_id[]'  value='$hu' $disab/>
                            <label for='$abjad[$j]$i'><small class='badge badge-$bg'>$abjad[$j]$i</small></label>
                            ";
                                ?>
                        <?php
                                echo "</li>";
                            }
                            echo "</ol>";
                        }
                        echo "</li>";
                        echo "</ol>";
                        ?>

                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('Admin/pemesanan') ?>" type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function enable() {
            document.getElementById("check").disabled = false;

        }

        function disable() {
            document.getElementById("check").disabled = true;
        }
    </script>