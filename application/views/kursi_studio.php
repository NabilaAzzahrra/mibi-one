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
        /* background: #5bfc60; */
        border-radius: 5px;
        color: black;
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
                    <form name="form" action="<?= base_url('') ?>Admin/actadd_kursi" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <!-- <form name="form" method="post" enctype="multipart/form-data" accept-charset="UTF-8"> -->
                        <div class="row">
                            <input type="hidden" name="id_studio" value="<?= $r->id_studio ?>">
                        </div>
                        <?php
                        // $bobotxz = array(-0.5, -0.4, -0.3, -0.2, -0.1, 0, 0.1, 0.2, 0.3, 0.4, 0.5);
                        $kolom = $r->kolom;
                        $baris = $r->baris;

                        $hidden = $kolom;
                        $jumlah_x = $baris;


                        $id = $r->id_studio;

                        $abjad = array(" ", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "O", "P");

                        echo "<ol>";
                        echo "<li>";
                        // for ($a = 1; $ja<= $pa; $a++) {

                        for ($j = 1; $j <= $jumlah_x; $j++) {

                            echo "<ol class='seats'>";
                            for ($i = 1; $i <= $hidden; $i++) {
                                echo "<li class='seat'>";
                                //echo "&nbsp".$bobotxz[array_rand($bobotxz)]."&nbsp";
                                echo "<input type='checkbox' id='$abjad[$j]$i' name='user_id[]' value='$abjad[$j]$i' checked='checked'/>
                                        <label for='$abjad[$j]$i'><small>$abjad[$j]$i</small></label>
                                        ";

                                             echo "</li>";
                            }
                            echo "</ol>";
                        }
                        // }
                        echo "</li>";
                        echo "</ol>";
                        ?>

                        <?php
                        // $kolom = $r->kolom;
                        // $baris = $r->baris;

                        // $hidden = $kolom;
                        // $jumlah_x = $baris;


                        // $id = $r->id_studio;

                        // $abjad = array(" ", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N");

                        // echo "<ol>";
                        // echo "<li>";

                        // for ($j = 1; $j <= $jumlah_x; $j++) {

                        //     echo "<ol class='seats'>";
                        //     for ($i = 1; $i <= $hidden; $i++) {
                        //         echo "<li class='seat'>";

                        //         echo "
                        //         <label class='btn btn-danger col-md-3'>
                        //             <input type='checkbox' name='user_id[]' autocomplete='off' value='$abjad[$j]$i' checked='checked'><lable>$abjad[$j]$i</lable>
                        //         </label>
                        //             ";
                        //         echo "</li>";
                        //     }
                        //     echo "</ol>";
                        // }
                        // echo "</li>";
                        // echo "</ol>";
                        ?>

                        <!-- <input type="checkbox" onchange="checkAll(this)" name="check" required style="align-items: center;"> -->
                        <!-- <div class="alert alert-primary" role="alert">
                            <strong> Checklist untuk Verifikasi Kursi!</strong>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('Admin/hapus_studio') ?>?id_studio=<?= $r->id_studio ?>" type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <script type="text/javascript">
        // function checkAll(ele) {
        //     var checkboxes = document.getElementsByTagName('input');
        //     if (ele.checked) {
        //         for (var i = 0; i < checkboxes.length; i++) {
        //             if (checkboxes[i].type == 'checkbox' && !(checkboxes[i].disabled)) {
        //                 checkboxes[i].checked = true;
        //             }
        //         }
        //     } else {
        //         for (var i = 0; i < checkboxes.length; i++) {
        //             if (checkboxes[i].type == 'checkbox') {
        //                 checkboxes[i].checked = false;
        //             }
        //         }
        //     }
        // }

        // $(document).ready(function() {
        //     $('.formupdate').submit(function(e) {
        //         e.preventDefault();
        //         let jmldata = $('.select_update').is('checked');
        //         alert(jmldata.length);
        //         return false;
        //     });

        // });
    </script>