<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include '../../vendor/autoload.php';
    //Tangkap id_akses
    if(empty($_POST['id_event'])){
        echo ' ID Event Tidak Boleh Kosong';
    }else{
        if(empty($_POST['FormatCetak'])){
            echo 'Format Cetak Tidak Boleh Kosong';
        }else{
            if(empty($_POST['rincian_event'])){
                echo 'Rincian Event Tidak Boleh Kosong';
            }else{
                if(empty($_POST['header'])){
                    echo 'Header Cetak Tidak Boleh Kosong';
                }else{
                    $id_event=$_POST['id_event'];
                    $FormatCetak=$_POST['FormatCetak'];
                    $rincian_event=$_POST['rincian_event'];
                    $header=$_POST['header'];
                    //Buka data Event
                    $QryEvent= mysqli_query($Conn,"SELECT * FROM event WHERE id_event='$id_event'")or die(mysqli_error($Conn));
                    $DataEvent= mysqli_fetch_array($QryEvent);
                    if(empty($DataEvent['id_event'])){
                        echo ' ID Event Tersebut Tidak Ditemukan';
                    }else{
                        $id_akses= $DataEvent['id_akses'];
                        $id_unit_kerja= $DataEvent['id_unit_kerja'];
                        $tanggal_mulai= $DataEvent['tanggal_mulai'];
                        $tanggal_selesai= $DataEvent['tanggal_selesai'];
                        $nama_event= $DataEvent['nama_event'];
                        $keterangan_event= $DataEvent['keterangan_event'];
                        $status= $DataEvent['status'];
                        //Buka detail akses
                        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                        $nama_akses= $DataDetailAkses['nama_akses'];
                        //Buka unit tujuan
                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                        //Jumlah Data
                        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event='$id_event'"));
                        if($FormatCetak=="PDF"){
                            $mpdf = new \Mpdf\Mpdf();
                            $nama_dokumen= "Jadwal-$id_event";
                            // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
                            $html='<style>@page *{margin-top: 0px;}</style>'; 
                            //Beginning Buffer to save PHP variables and HTML tags
                            ob_start();
                        }
?>
    <html>
        <head>
            <title>Jadwal Kegiatan</title>
            <style type="text/css">
                @page {
                    margin-top: 1cm;
                    margin-bottom: 1cm;
                    margin-left: 1cm;
                    margin-right: 1cm;
                }
                body {
                    background-color: #FFF;
                    font-family: arial;
                }
                table{
                    border-collapse: collapse;
                    margin-top:10px;
                }
                table.kostum tr td {
                    border:none;
                    color:#333;
                    border-spacing: 0px;
                    padding: 2px;
                    border-collapse: collapse;
                    font-size:12px;
                }
                table.data tr td {
                    border: 1px solid #666;
                    color:#333;
                    border-spacing: 0px;
                    padding: 10px;
                    border-collapse: collapse;
                }
                .tabel_garis_bawah {
                    border-bottom: 1px solid #666;
                }
                table.TableForm tr td{
                    padding: 10px;
                }
            </style>
        </head>
        <body>
            <table width="100%">
                <tr>
                    <td align="center">
                        <img src="../../assets/img/<?php echo $logo;?>" alt="Logo" width="100px">
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php
                            echo '<h3><b>'.$title_page.'</b></h3><br>';
                            echo '<i>'.$alamat_bisnis.'</i>';
                            echo '<i>Telepon '.$telepon_bisnis.'</i>';
                        ?>
                    </td>
                </tr>
            </table>
            <br>
            <table class="TableForm">
                <tr>
                    <td>
                        <small><dt>Unit/Penyelenggara</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $nama_unit_kerja; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Tanggal Mulai</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $tanggal_mulai; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Tanggal Selesai</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $tanggal_selesai; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Nama Event</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $nama_event; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Keterangan</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $keterangan_event; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Status Event</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $status; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Dibuat Oleh</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $nama_akses; ?></small>
                    </td>
                </tr>
            </table>
            <br>
            <table class="data" width="100%">
                <tr>
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Waktu</b></td>
                    <td align="center"><b>Keterangan Kegiatan</b></td>
                </tr>
                <?php
                    if(empty($jml_data)){
                        echo '<tr>';
                        echo '  <td class="text-center" colspan="4"><small class="text-danger">Belum Ada Data Jadwal Kegiatan</small></td>';
                        echo '</tr>';
                    }else{
                        $no=1;
                        $QryTanggal = mysqli_query($Conn, "SELECT DISTINCT tanggal FROM event_jadwal WHERE id_event='$id_event' ORDER BY tanggal ASC");
                        while ($DataTanggal = mysqli_fetch_array($QryTanggal)) {
                            $ListTanggalAwal= $DataTanggal['tanggal'];
                            $Strtotime= Strtotime($ListTanggalAwal);
                            $ListTanggal=date('d F Y',$Strtotime);
                            echo '<tr>';
                            echo '  <td class="text-left" colspan="3"><b>'.$ListTanggal.'</b></td>';
                            echo '</tr>';
                            $no=1;
                            $QryKegiatan = mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event='$id_event' AND tanggal='$ListTanggalAwal' ORDER BY waktu1 ASC");
                            while ($DataKegiatan = mysqli_fetch_array($QryKegiatan)) {
                                $id_event_jadwal= $DataKegiatan['id_event_jadwal'];
                                $id_akses= $DataKegiatan['id_akses'];
                                $waktu1= $DataKegiatan['waktu1'];
                                $waktu2= $DataKegiatan['waktu2'];
                                $keterangan= $DataKegiatan['keterangan'];
                                //Buka detail akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                ?>
                    <tr>
                        <td align="center"><?php echo "$no"; ?></td>
                        <td align="left"><?php echo "$waktu1 s/d $waktu2"; ?></td>
                        <td align="left"><?php echo "<b>$keterangan</b><br><small class=''text-info>Input Oleh : $nama_akses</small>"; ?></td>
                    </tr>
                <?php $no++;}}} ?>
            </table>
        </body>
    </html>
<?php 
                    }
                }
            }
        }
    }
    if($FormatCetak=="PDF"){
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        exit;
    }
?>