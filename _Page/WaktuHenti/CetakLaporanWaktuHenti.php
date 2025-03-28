<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include '../../vendor/autoload.php';
    //Tangkap id_akses
    if(empty($_POST['bentuk_laporan2'])){
        echo ' Bentuk Laporan Tidak Boleh Kosong';
    }else{
        if(empty($_POST['periode_laporan2'])){
            echo 'Periode Laporan Tidak Boleh Kosong';
        }else{
            if(empty($_POST['bulan2'])){
                echo 'Bulan Laporan Tidak Boleh Kosong';
            }else{
                if(empty($_POST['tahun2'])){
                    echo 'Tahun Data Tidak Boleh Kosong';
                }else{
                    if(empty($_POST['FormatCetak'])){
                        echo 'Format Cetak Tidak Boleh Kosong';
                    }else{
                        if(empty($_POST['TampilkanKop'])){
                            echo 'Tampilkan Header Tidak Boleh Kosong';
                        }else{
                            $bentuk_laporan2=$_POST['bentuk_laporan2'];
                            $periode_laporan2=$_POST['periode_laporan2'];
                            $bulan2=$_POST['bulan2'];
                            $tahun2=$_POST['tahun2'];
                            $FormatCetak=$_POST['FormatCetak'];
                            $TampilkanKop=$_POST['TampilkanKop'];
                            if($FormatCetak=="PDF"){
                                $mpdf = new \Mpdf\Mpdf();
                                $nama_dokumen= "Laporan-Waktu-Henti";
                                // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
                                $html='<style>@page *{margin-top: 0px;}</style>'; 
                                //Beginning Buffer to save PHP variables and HTML tags
                                ob_start();
                            }
                            //Menghitung Data
                            if($periode_laporan2=="Tahunan"){
                                $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$tahun2%'"));
                            }else{
                                $PeriodeTahun="$tahun2-$bulan2";
                                $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%'"));
                            }
?>
    <html>
        <head>
            <title>Laporan Waktu Henti</title>
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
            <?php if($TampilkanKop=="Ya"){ ?>
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
            <?php if($bentuk_laporan2=="Tabel"){ ?>
                <table class="data" width="100%">
                    <tr>
                        <td align="center"><b>No</b></td>
                        <td align="center"><b>Kategori</b></td>
                        <td align="center"><b>Nama User</b></td>
                        <td align="center"><b>Mulai</b></td>
                        <td align="center"><b>Selesai</b></td>
                        <td align="center"><b>Durasi</b></td>
                        <td align="center"><b>Status</b></td>
                    </tr>
                    <?php
                        if(empty($JumlahData)){
                            echo '<tr>';
                            echo '  <td colspan="7" align="center">Tdak Ada Data</td>';
                            echo '</tr>';
                        }else{
                            $no = 1;
                            //KONDISI PENGATURAN MASING FILTER
                            if($periode_laporan2=="Tahunan"){
                                $query = mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$tahun2%' ORDER BY tanggal_mulai ASC");
                            }else{
                                $query = mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%' ORDER BY tanggal_mulai ASC");
                            }
                                while ($data = mysqli_fetch_array($query)) {
                                $id_waktu_henti= $data['id_waktu_henti'];
                                $id_akses= $data['id_akses'];
                                $nama_user= $data['nama_user'];
                                $tanggal_mulai= $data['tanggal_mulai'];
                                $tanggal_selesai= $data['tanggal_selesai'];
                                $tanggal_catat= $data['tanggal_catat'];
                                $kategori= $data['kategori'];
                                $keterangan= $data['keterangan'];
                                $status= $data['status'];
                                //Buka Detail Akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                $kontak_akses= $DataDetailAkses['kontak_akses'];
                                $email_akses = $DataDetailAkses['email_akses'];
                                //Menghitung Durasi
                                $datetime1 = new DateTime($tanggal_mulai);//start time
                                $datetime2 = new DateTime($tanggal_selesai);//end time
                                $durasi = $datetime1->diff($datetime2);
                                $durasi=$durasi->format('%H Jam');
                                echo '<tr>';
                                echo '  <td align="center">'.$no.'</td>';
                                echo '  <td align="left">'.$kategori.'</td>';
                                echo '  <td align="left">'.$nama_user.'</td>';
                                echo '  <td align="left">'.$tanggal_mulai.'</td>';
                                echo '  <td align="left">'.$tanggal_selesai.'</td>';
                                echo '  <td align="left">'.$durasi.'</td>';
                                echo '  <td align="left">'.$status.'</td>';
                                echo '</tr>';
                            $no++;}
                        }
                    ?>
                </table>
            <?php }else{ ?>
                <table class="data" width="100%">
                    <tr>
                        <td align="center"><b>No</b></td>
                        <td align="center"><b>Tanggal/Bulan</b></td>
                        <td align="center"><b>Jumlah Kejadian</b></td>
                    </tr>
                    <tbody>
                        <?php
                            if($periode_laporan2=="Tahunan"){
                                $no=1;
                                for ( $i =1; $i<=12; $i++ ){
                                    $fzeropadded = sprintf("%02d", $i);
                                    $PeriodeTahun="$tahun2-$fzeropadded";
                                    $Strtotime=strtotime($PeriodeTahun);
                                    $NamaBulan=date('F',$Strtotime);
                                    $Jumlahkejadian= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%'"));
                                    echo '<tr>';
                                    echo '  <td align="center">'.$no.'</td>';
                                    echo '  <td align="left">'.$NamaBulan.' '.$tahun.'</td>';
                                    echo '  <td class="text-right">'.$Jumlahkejadian.' Kejadian</td>';
                                    echo '</tr>';
                                $no++;}
                            }else{
                                $JumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan2, $tahun2);
                                $no=1;
                                for ( $i =1; $i<=$JumlahHari; $i++ ){
                                    $fzeropadded = sprintf("%02d", $i);
                                    $PeriodeTahun="$tahun2-$bulan2-$fzeropadded";
                                    $Strtotime=strtotime($PeriodeTahun);
                                    $NamaBulan=date('d F Y',$Strtotime);
                                    $Jumlahkejadian= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%'"));
                                    if(!empty($Jumlahkejadian)){
                                        echo '<tr class="bg-success text-light">';
                                    }else{
                                        echo '<tr>';
                                    }
                                    echo '  <td align="center">'.$no.'</td>';
                                    echo '  <td align="left">'.$NamaBulan.'</td>';
                                    echo '  <td class="text-right">'.$Jumlahkejadian.' Kejadian</td>';
                                    echo '</tr>';
                                $no++;}
                            }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
        </body>
    </html>
<?php 
                        }
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