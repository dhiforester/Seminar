<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include '../../vendor/autoload.php';
    //Tangkap id_akses
    if(empty($_POST['Format'])){
        echo ' Format Tidak Boleh Kosong';
    }else{
        if(empty($_POST['Periode1'])){
            echo 'Periode Awal Tidak Boleh Kosong';
        }else{
            if(empty($_POST['Periode2'])){
                echo 'Periode Akhir Tidak Boleh Kosong';
            }else{
                $FormatCetak=$_POST['Format'];
                $Periode1=$_POST['Periode1'];
                $Periode2=$_POST['Periode2'];
                //Jumlah Data
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE tanggal>='$Periode1' AND tanggal<='$Periode2'"));
                if($FormatCetak=="PDF"){
                    $mpdf = new \Mpdf\Mpdf();
                    $nama_dokumen= "Riwayat-Kerja";
                    // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
                    $html='<style>@page *{margin-top: 0px;}</style>'; 
                    //Beginning Buffer to save PHP variables and HTML tags
                    ob_start();
                }
?>
    <html>
        <head>
            <title>Riwayat Kerja</title>
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
            <table class="data" width="100%">
                <tr>
                    <td align="center">
                        <b>No</b>
                    </td>
                    <td align="center">
                        <b>Kegiatan</b>
                    </td>
                    <td align="center">
                        <b>Tanggal</b>
                    </td>
                    <td align="center">
                        <b>Nama</b>
                    </td>
                    <td align="center">
                        <b>Unit Kerja</b>
                    </td>
                    <td align="center">
                        <b>Kategori</b>
                    </td>
                </tr>
                <?php
                    if(empty($jml_data)){
                        echo '<tr>';
                        echo '  <td class="text-center" colspan="6"><small class="text-danger">Belum Ada Data Yang Ditampilkan</small></td>';
                        echo '</tr>';
                    }else{
                        $no=1;
                        $QryRiwayat = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE tanggal>='$Periode1' AND tanggal<='$Periode2' ORDER BY tanggal ASC");
                            while ($data = mysqli_fetch_array($QryRiwayat)) {
                                $id_riwayat_kerja= $data['id_riwayat_kerja'];
                                $id_akses= $data['id_akses'];
                                $id_unit_kerja= $data['id_unit_kerja'];
                                $id_dukungan= $data['id_dukungan'];
                                $id_agenda= $data['id_agenda'];
                                $id_event= $data['id_event'];
                                $nama= $data['nama'];
                                $tanggal= $data['tanggal'];
                                $kategori_kerja= $data['kategori_kerja'];
                                $keterangan= $data['keterangan'];
                                $gambar_kerja= $data['gambar_kerja'];
                                //Buka detail akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                //Buka data unit kerja
                                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                $id_unit_kerja = $DataUnitKerja['id_unit_kerja'];
                                $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                //Kategori Riwayat
                                if(!empty($data['id_dukungan'])){
                                    $KategoriRiwayatKerja="<span class='badge bg-info'>Dukungan</span>";
                                }else{
                                    if(!empty($data['id_agenda'])){
                                        $KategoriRiwayatKerja="<span class='badge bg-danger'>Agenda</span>";
                                    }else{
                                        if(!empty($data['id_event'])){
                                            $KategoriRiwayatKerja="<span class='badge bg-success'>Kegiatan</span>";
                                        }else{
                                            $KategoriRiwayatKerja="<span class='badge bg-dark'>None</span>";
                                        }
                                    }
                                }
                                //Label unit kerja
                                if(empty($DataUnitKerja['nama_unit_kerja'])){
                                    $LabelUnitKerja='<small class="text-warning">General</small>';
                                }else{
                                    $LabelUnitKerja='<small class="text-dark">'.$nama_unit_kerja.'</small>';
                                }
                                //Tanggal
                                $strtotime=strtotime($tanggal);
                                $DateOnly=date('d/m/Y', $strtotime);
                                $TimeOnly=date('H:i', $strtotime);
                                //Label Nama
                                if(empty($data['nama'])){
                                    $LabelNama='<small class="text-danger">None</small>';
                                }else{
                                    $LabelNama='<small class="text-dark">'.$nama.'</small>';
                                }
                ?>
                    <tr>
                        <td align="center">
                            <?php echo "$no" ?>
                        </td>
                        <td align="left">
                            <?php 
                                echo "<b>$kategori_kerja</b><br>";
                                echo "<small>$keterangan</small>";
                            ?>
                        </td>
                        <td align="left">
                            <?php echo "<b>$DateOnly</b><br><small>$TimeOnly WIB</small>" ?>
                        </td>
                        <td align="left">
                            <?php echo "$LabelNama" ?>
                        </td>
                        <td align="left">
                            <?php echo "$LabelUnitKerja" ?>
                        </td>
                        <td align="left">
                            <?php echo "$KategoriRiwayatKerja" ?>
                        </td>
                    </tr>
                <?php $no++;}} ?>
            </table>
        </body>
    </html>
<?php 
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