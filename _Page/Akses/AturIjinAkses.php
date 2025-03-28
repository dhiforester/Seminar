<?php
    if(empty($_GET['id_akses'])){
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-lg-12">';
        echo '          <div class="card">';
        echo '              <div class="card-body">';
        echo '                  ID Akses Tidak Boleh Kosong';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_GET['id_akses'];
        //Buka data acc_dashboard
        $QryAccDashboard = mysqli_query($Conn,"SELECT * FROM acc_dashboard WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDashboard = mysqli_fetch_array($QryAccDashboard);
        if(!empty($DataDashboard['id_acc_dashboard'])){
            $acc_dashboard1 = $DataDashboard['acc_dashboard1'];
            $acc_dashboard2 = $DataDashboard['acc_dashboard2'];
            $acc_dashboard3 = $DataDashboard['acc_dashboard3'];
        }else{
            $acc_dashboard1 = "";
            $acc_dashboard2 = "";
            $acc_dashboard3 = "";
        }
        //Buka data acc_akses
        $QryAcc1 = mysqli_query($Conn,"SELECT * FROM acc_akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAcc1 = mysqli_fetch_array($QryAcc1);
        if(!empty($DataAcc1['id_acc_akses'])){
            $acc_akses1 = $DataAcc1['acc_akses1'];
            $acc_akses2 = $DataAcc1['acc_akses2'];
            $acc_akses3 = $DataAcc1['acc_akses3'];
            $acc_akses4 = $DataAcc1['acc_akses4'];
            $acc_akses5 = $DataAcc1['acc_akses5'];
        }else{
            $acc_akses1 = "";
            $acc_akses2 = "";
            $acc_akses3 = "";
            $acc_akses4 = "";
            $acc_akses5 = "";
        }
        //Buka data acc_mitra
        $QryAccMitra = mysqli_query($Conn,"SELECT * FROM acc_mitra WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccMitra = mysqli_fetch_array($QryAccMitra);
        if(!empty($DataAccMitra['id_acc_mitra'])){
            $acc_mitra1 = $DataAcc1['acc_mitra1'];
            $acc_mitra2 = $DataAcc1['acc_mitra2'];
            $acc_mitra3 = $DataAcc1['acc_mitra3'];
            $acc_mitra4 = $DataAcc1['acc_mitra4'];
            $acc_mitra5 = $DataAcc1['acc_mitra5'];
        }else{
            $acc_mitra1 = "";
            $acc_mitra2 = "";
            $acc_mitra3 = "";
            $acc_mitra4 = "";
            $acc_mitra5 = "";
        }
        //Buka data acc_pasien
        $QryAccPasien = mysqli_query($Conn,"SELECT * FROM acc_pasien WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccPasien = mysqli_fetch_array($QryAccPasien);
        if(!empty($DataAccPasien['id_acc_pasien'])){
            $acc_pasien1 = $DataAccPasien['acc_pasien1'];
            $acc_pasien2 = $DataAccPasien['acc_pasien2'];
            $acc_pasien3 = $DataAccPasien['acc_pasien3'];
            $acc_pasien4 = $DataAccPasien['acc_pasien4'];
            $acc_pasien5 = $DataAccPasien['acc_pasien5'];
        }else{
            $acc_pasien1 = "";
            $acc_pasien2 = "";
            $acc_pasien3 = "";
            $acc_pasien4 = "";
            $acc_pasien5 = "";
        }
        //Buka data acc_kunjungan
        $QryAccKunjungan = mysqli_query($Conn,"SELECT * FROM acc_kunjungan WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccKunjungan = mysqli_fetch_array($QryAccKunjungan);
        if(!empty($DataAccKunjungan['id_acc_kunjungan'])){
            $acc_kunjungan1 = $DataAccKunjungan['acc_kunjungan1'];
            $acc_kunjungan2 = $DataAccKunjungan['acc_kunjungan2'];
            $acc_kunjungan3 = $DataAccKunjungan['acc_kunjungan3'];
            $acc_kunjungan4 = $DataAccKunjungan['acc_kunjungan4'];
            $acc_kunjungan5 = $DataAccKunjungan['acc_kunjungan5'];
            $acc_kunjungan6 = $DataAccKunjungan['acc_kunjungan6'];
            $acc_kunjungan7 = $DataAccKunjungan['acc_kunjungan7'];
            $acc_kunjungan8 = $DataAccKunjungan['acc_kunjungan8'];
            $acc_kunjungan9 = $DataAccKunjungan['acc_kunjungan9'];
        }else{
            $acc_kunjungan1 = "";
            $acc_kunjungan2 = "";
            $acc_kunjungan3 = "";
            $acc_kunjungan4 = "";
            $acc_kunjungan5 = "";
            $acc_kunjungan6 = "";
            $acc_kunjungan7 = "";
            $acc_kunjungan8 = "";
            $acc_kunjungan9 = "";
        }
        //Buka data acc_form
        $QryAccForm = mysqli_query($Conn,"SELECT * FROM acc_form WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccForm = mysqli_fetch_array($QryAccForm);
        if(!empty($DataAccForm['id_acc_form'])){
            $acc_form1 = $DataAccKunjungan['acc_form1'];
            $acc_form2 = $DataAccKunjungan['acc_form2'];
            $acc_form3 = $DataAccKunjungan['acc_form3'];
            $acc_form4 = $DataAccKunjungan['acc_form4'];
        }else{
            $acc_kunjungan1 = "";
            $acc_form1 = "";
            $acc_form2 = "";
            $acc_form3 = "";
            $acc_form4 = "";
        }
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <form action="javascript:void(0);" id="ProsesAturIjinAkses">
                    <input type="hidden" name="id_akses" id="id_akses" value="<?php echo "$id_akses"; ?>">
                    <div class="card">
                        <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10 mt-3">
                                        <b>Atur Ijin Akses</b>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <a href="index.php?Page=Akses" class="btn btn-md btn-dark w-100">
                                            <i class="bi bi-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_dashboard1" name="acc_dashboard1" <?php if($acc_dashboard1=="Ya"){echo "checked";} ?>>
                                            <b>
                                                <label class="form-check-label" for="acc_dashboard1">
                                                    Dashboard
                                                </label>
                                            </b>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input dashboard_cehcked" type="checkbox" value="Ya" id="acc_dashboard2" name="acc_dashboard2" <?php if($acc_dashboard2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_dashboard2">
                                                        Dashboard Admin
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input dashboard_cehcked" type="checkbox" value="Ya" id="acc_dashboard3" name="acc_dashboard3" <?php if($acc_dashboard3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_dashboard3">
                                                        Dashboard Mitra
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_akses1" name="acc_akses1" <?php if($acc_akses1=="Ya"){echo "checked";} ?>>
                                            <b>
                                                <label class="form-check-label" for="acc_akses1">
                                                    Akses
                                                </label>
                                            </b>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses2" name="acc_akses2" <?php if($acc_akses2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses2">
                                                        Tambah Data Akses
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses3" name="acc_akses3" <?php if($acc_akses3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses3">
                                                        Edit Data Akses
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses4" name="acc_akses4" <?php if($acc_akses4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses4">
                                                        Hapus Data Akses
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses5" name="acc_akses5" <?php if($acc_akses5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses5">
                                                        Atur Fitur Akses
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_mitra1" name="acc_mitra1" <?php if($acc_mitra1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_mitra1">
                                                <b>Mitra</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra2" name="acc_mitra2" <?php if($acc_mitra2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra2">
                                                        Tambah Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra3" name="acc_mitra3" <?php if($acc_mitra3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra3">
                                                        Edit Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_akses4" name="acc_akses4" <?php if($acc_akses4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses4">
                                                        Hapus Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra5" name="acc_mitra5" <?php if($acc_mitra5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra5">
                                                        Atur Akses Mitra
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_pasien1" name="acc_pasien1" <?php if($acc_pasien1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_pasien1">
                                                <b>Pasien</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien2" name="acc_pasien2" <?php if($acc_pasien2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien2">
                                                        Tambah Pasien Baru
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien3" name="acc_pasien3" <?php if($acc_pasien3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien3">
                                                        Edit Data Pasien
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien4" name="acc_pasien4" <?php if($acc_pasien4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien4">
                                                        Hapus Data Pasien
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien5" name="acc_pasien5" <?php if($acc_pasien5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien5">
                                                        Menambahkan Kunjungan
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_mitra1" name="acc_mitra1" <?php if($acc_mitra1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_mitra1">
                                                <b>Mitra</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra2" name="acc_mitra2" <?php if($acc_mitra2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra2">
                                                        Tambah Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra3" name="acc_mitra3" <?php if($acc_mitra3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra3">
                                                        Edit Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_akses4" name="acc_akses4" <?php if($acc_akses4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses4">
                                                        Hapus Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra5" name="acc_mitra5" <?php if($acc_mitra5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra5">
                                                        Atur Akses Mitra
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_mitra1" name="acc_mitra1" <?php if($acc_mitra1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_mitra1">
                                                <b>Mitra</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra2" name="acc_mitra2" <?php if($acc_mitra2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra2">
                                                        Tambah Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra3" name="acc_mitra3" <?php if($acc_mitra3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra3">
                                                        Edit Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_akses4" name="acc_akses4" <?php if($acc_akses4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akses4">
                                                        Hapus Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra5" name="acc_mitra5" <?php if($acc_mitra5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra5">
                                                        Atur Akses Mitra
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="NotifikasiAturIjinAkses">
                                    <span>Pastikan ijin akses sudah sesuai</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-md btn-success">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>