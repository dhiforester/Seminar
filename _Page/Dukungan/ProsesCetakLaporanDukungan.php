<?php
    //Koneksi
    include "../../_Config/Connection.php";
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
                    if(empty($_POST['id_unit_kerja'])){
                        $id_unit_kerja="";
                    }else{
                        $id_unit_kerja=$_POST['id_unit_kerja'];
                    }
                    $format_cetak=$_POST['format_cetak'];
                    $periode1=$_POST['periode1'];
                    $periode2=$_POST['periode2'];
                    $header=$_POST['header'];
                    if($format_cetak=="PDF"){
                        $mpdf = new \Mpdf\Mpdf();
                        $nama_dokumen= "Laporan-Dukungan";
                        // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
                        $html='<style>@page *{margin-top: 0px;}</style>'; 
                        //Beginning Buffer to save PHP variables and HTML tags
                        ob_start();
                    }
                    //Menghitung Data
                    if(empty($id_unit_kerja)){
                        $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE tanggal_request>='$periode1' AND tanggal_request<='$periode2'"));
                    }else{
                        $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE tanggal_request>='$periode1' AND tanggal_request<='$periode2' AND id_unit_kerja='$id_unit_kerja'"));
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
                    <td align="center"><b>Datetime</b></td>
                    <td align="center"><b>Kategori</b></td>
                    <td align="center"><b>Keterangan</b></td>
                    <td align="center"><b>Pemohon</b></td>
                    <td align="center"><b>Tujuan</b></td>
                    <td align="center"><b>Status</b></td>
                    <td align="center"><b>Response</b></td>
                    <td align="center"><b>Done</b></td>
                </tr>
                <?php
                    if(empty($JumlahData)){
                        echo '<tr>';
                        echo '  <td colspan="9" align="center">Tdak Ada Data</td>';
                        echo '</tr>';
                    }else{
                        $no = 1;
                        //KONDISI PENGATURAN MASING FILTER
                        if(empty($id_unit_kerja)){
                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE tanggal_request>='$periode1' AND tanggal_request<='$periode2' ORDER BY id_dukungan ASC");
                        }else{
                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE tanggal_request>='$periode1' AND tanggal_request<='$periode2' AND id_unit_kerja='$id_unit_kerja' ORDER BY id_dukungan ASC");
                        }
                            while ($data = mysqli_fetch_array($query)) {
                                $id_dukungan= $data['id_dukungan'];
                                $id_akses= $data['id_akses'];
                                $id_unit_kerja= $data['id_unit_kerja'];
                                if(empty($data['tanggal_request'])){
                                    $tanggal_request=date('Y-m-d H:i:s');
                                }else{
                                    $tanggal_request= $data['tanggal_request'];
                                    $tanggal_request= strtotime($tanggal_request);
                                    $tanggal_request= date('Y-m-d H:i:s', $tanggal_request);
                                }
                                if(empty($data['tanggal_response'])){
                                    $tanggal_response=date('Y-m-d H:i:s');
                                }else{
                                    $tanggal_response= $data['tanggal_response'];
                                    $tanggal_response= strtotime($tanggal_response);
                                    $tanggal_response= date('Y-m-d H:i:s', $tanggal_response);
                                }
                                if(empty($data['tanggal_selesai'])){
                                    $tanggal_selesai=date('Y-m-d H:i:s');
                                }else{
                                    $tanggal_selesai= $data['tanggal_selesai'];
                                    $tanggal_selesai= strtotime($tanggal_selesai);
                                    $tanggal_selesai= date('Y-m-d H:i:s', $tanggal_selesai);
                                }
                                $judul_dukungan= $data['judul_dukungan'];
                                $kategori_dukungan= $data['kategori_dukungan'];
                                $keterangan_dukungan= $data['keterangan_dukungan'];
                                $status_dukungan= $data['status_dukungan'];
                                //Buka detail akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                //Buka unit tujuan
                                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                if($status_dukungan=="Request"){
                                    $LabelStatus='<span class="badge badge-danger">Rqst</span>';
                                }else{
                                    if($status_dukungan=="Response"){
                                        $LabelStatus='<span class="badge badge-warning">Rsps</span>';
                                    }else{
                                        if($status_dukungan=="Done"){
                                            $LabelStatus='<span class="badge badge-success">Done</span>';
                                        }else{
                                            $LabelStatus='<span class="badge badge-dark">None</span>';
                                        }
                                    }
                                }
                                $request=$data['tanggal_request'];
                                if(empty($data['tanggal_response'])){
                                    $response=date('Y-m-d H:i:s');
                                }else{
                                    $response=$data['tanggal_response'];
                                    $response= strtotime($response);
                                    $response= date('Y-m-d H:i:s', $response);
                                }
                                if(empty($data['tanggal_selesai'])){
                                    $selesai=date('Y-m-d H:i:s');
                                }else{
                                    $selesai=$data['tanggal_selesai'];
                                    $selesai= strtotime($selesai);
                                    $selesai= date('Y-m-d H:i:s', $selesai);
                                }
                                //Menghitung Durasi response
                                $request = new DateTime($tanggal_request);//start time
                                $response = new DateTime($response);//end time
                                $DurasiResponse = $request->diff($response);
                                $DurasiResponse=$DurasiResponse->format('%i');
                                //Menghitung Durasi response
                                $selesai = new DateTime($tanggal_selesai);//end time
                                $DurasiSelesai = $request->diff($selesai);
                                $DurasiSelesai=$DurasiSelesai->format('%i');
                            echo '<tr>';
                            echo '  <td align="center">'.$no.'</td>';
                            echo '  <td align="left">'.$tanggal_request.'</td>';
                            echo '  <td align="left">'.$kategori_dukungan.'</td>';
                            echo '  <td align="left">'.$judul_dukungan.'</td>';
                            echo '  <td align="left">'.$nama_akses.'</td>';
                            echo '  <td align="left">'.$nama_unit_kerja.'</td>';
                            echo '  <td align="left">'.$status_dukungan.'</td>';
                            echo '  <td align="left">'.$tanggal_response.' ('.$DurasiResponse.' Menit)</td>';
                            echo '  <td align="left">'.$tanggal_selesai.' ('.$DurasiSelesai.' Menit)</td>';
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
    if($format_cetak=="PDF"){
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        exit;
    }
?>