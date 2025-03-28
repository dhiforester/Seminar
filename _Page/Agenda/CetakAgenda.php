<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include '../../vendor/autoload.php';
    //Tangkap id_akses
    if(empty($_POST['format_cetak'])){
        echo ' Format Cetak Tidak Boleh Kosong';
    }else{
        if(empty($_POST['periode1'])){
            echo 'Periode Awal Tidak Boleh Kosong';
        }else{
            if(empty($_POST['periode1'])){
                echo 'Periode Akhir Tidak Boleh Kosong';
            }else{
                if(empty($_POST['header'])){
                    echo 'Header Tidak Boleh Kosong';
                }else{
                    if(empty($_POST['hanya_saya'])){
                        echo 'Keerangan Data Tidak Boleh Kosong';
                    }else{
                        $format_cetak=$_POST['format_cetak'];
                        $periode1=$_POST['periode1'];
                        $periode2=$_POST['periode2'];
                        $header=$_POST['header'];
                        $hanya_saya=$_POST['hanya_saya'];
                        if($format_cetak=="PDF"){
                            $mpdf = new \Mpdf\Mpdf();
                            $nama_dokumen= "Laporan-Agenda";
                            // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
                            $html='<style>@page *{margin-top: 0px;}</style>'; 
                            //Beginning Buffer to save PHP variables and HTML tags
                            ob_start();
                        }
                        //Menghitung Data
                        if($hanya_saya=="Tampilkan Semua"){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal>='$periode1' AND tanggal<='$periode2'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses='$SessionIdAkses' AND tanggal>='$periode1' AND tanggal<='$periode2'"));
                        }
?>
    <html>
        <head>
            <title>Laporan Dukungan</title>
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
            <?php if($header=="Ya"){ ?>
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
                </table><br>
            <?php }  ?>
            <table class="data" width="100%">
                <tr>
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Tanggal/Waktu</b></td>
                    <td align="center"><b>User/Pengguna</b></td>
                    <td align="center"><b>Unit</b></td>
                    <td align="center"><b>Kegiatan</b></td>
                    <td align="center"><b>Status</b></td>
                </tr>
                <?php
                    if(empty($JumlahData)){
                        echo '<tr>';
                        echo '  <td colspan="6" align="center">Tdak Ada Data</td>';
                        echo '</tr>';
                    }else{
                        $no = 1;
                        //KONDISI PENGATURAN MASING FILTER
                        if($hanya_saya=="Tampilkan Semua"){
                            $query = mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal>='$periode1' AND tanggal<='$periode2' ORDER BY id_agenda ASC");
                        }else{
                            $query = mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal>='$periode1' AND tanggal<='$periode2' AND id_akses='$SessionIdAkses' ORDER BY id_agenda ASC");
                        }
                            while ($DataKegiatan = mysqli_fetch_array($query)) {
                                $id_agenda= $DataKegiatan['id_agenda'];
                                $ListIdAkses= $DataKegiatan['id_akses'];
                                $ListIdUnitKerja= $DataKegiatan['id_unit_kerja'];
                                $tanggal= $DataKegiatan['tanggal'];
                                $kategori= $DataKegiatan['kategori'];
                                $agenda= $DataKegiatan['agenda'];
                                $status= $DataKegiatan['status'];
                                $strtotime=strtotime($tanggal);
                                $TanggalKegiatan=date('d/m/Y',$strtotime);
                                $JamKegiatan=date('H:i',$strtotime);
                                 //Buka data askes
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$ListIdAkses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$ListIdUnitKerja'")or die(mysqli_error($Conn));
                                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                if($status=="Rencana"){
                                    $LabelStatus='<span class="badge badge-info">Rencana</span>';
                                }else{
                                    if($status=="Ditunda"){
                                        $LabelStatus='<span class="badge badge-warning">Ditunda</span>';
                                    }else{
                                        if($status=="Batal"){
                                            $LabelStatus='<span class="badge badge-danger">Batal</span>';
                                        }else{
                                            if($status=="Selesai"){
                                                $LabelStatus='<span class="badge badge-success">Selesai</span>';
                                            }else{
                                                $LabelStatus='<span class="badge badge-dark">None</span>';
                                            }
                                        }
                                    }
                                }
                                echo '<tr>';
                                echo '  <td align="center">'.$no.'</td>';
                                echo '  <td align="left">'.$TanggalKegiatan.'<br> Jam '.$JamKegiatan.'</td>';
                                echo '  <td align="left">'.$nama_akses.'</td>';
                                echo '  <td align="left">'.$nama_unit_kerja.'</td>';
                                echo '  <td align="left"><b>'.$kategori.'</b><br><small>'.$agenda.'</small></td>';
                                echo '  <td align="left">'.$status.'</td>';
                                echo '</tr>';
                        $no++;}
                    }
                ?>
            </table>
        </body>
    </html>
<?php 
                    }
                }
            }
        }
    }
    if($format_cetak=="PDF"){
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        exit;
    }
?>