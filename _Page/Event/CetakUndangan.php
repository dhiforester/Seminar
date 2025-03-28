<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include '../../vendor/autoload.php';
    include "../../assets/phpqrcode/qrlib.php";
    $penyimpanan = "../../assets/img/qrcode/";
    if(empty($_GET['id'])){
        echo "ID Tidak Boleh Kosong";
    }else{
        $id_event_undangan=$_GET['id'];
        //Buka detail undangan
        $QryUndangan= mysqli_query($Conn,"SELECT * FROM event_undangan WHERE id_event_undangan='$id_event_undangan'")or die(mysqli_error($Conn));
        $DataUndangan= mysqli_fetch_array($QryUndangan);
        $id_event= $DataUndangan['id_event'];
        $id_akses= $DataUndangan['id_akses'];
        $in_ex= $DataUndangan['in_ex'];
        $nama= $DataUndangan['nama'];
        $unit_instansi= $DataUndangan['unit_instansi'];
        $kontak= $DataUndangan['kontak'];
        $email= $DataUndangan['email'];
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_akses_pembuat= $DataEvent['id_akses'];
        $id_unit_kerja= $DataEvent['id_unit_kerja'];
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $tanggal_selesai= $DataEvent['tanggal_selesai'];
        $nama_event= $DataEvent['nama_event'];
        $keterangan_event= $DataEvent['keterangan_event'];
        $status= $DataEvent['status'];
        //Buka detail akses
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses_pembuat'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama_akses= $DataDetailAkses['nama_akses'];
        //Buka unit tujuan
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
        //Buka data undangan
        $QryTamplate= mysqli_query($Conn,"SELECT * FROM event_tamplate WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataTamplate= mysqli_fetch_array($QryTamplate);
        if(empty($DataTamplate['id_event_tamplate'])){
            echo '<div class="modal-body">';
            echo '  <div class="row mt-2"> ';
            echo '      <div class="col-md-12 text-danger text-center">';
            echo '          Belum ada tamplate undangan yang terhubung!';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
            echo '<div class="modal-footer bg-info">';
            echo '  <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
            echo '      <i class="bi bi-x-circle"></i> Tutup';
            echo '  </button>';
            echo '</div>';
        }else{
            $id_event_tamplate= $DataTamplate['id_event_tamplate'];
            $id_tamplate_event= $DataTamplate['id_tamplate'];
            $undangan= $DataTamplate['undangan'];
            $mpdf = new \Mpdf\Mpdf();
            $nama_dokumen= "Undangan-$id_event";
            // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
            $html='<style>@page *{margin-top: 0px;}</style>'; 
            //Beginning Buffer to save PHP variables and HTML tags
            ob_start();
            $isi = "$base_url/_Page/Event/CetakUndangan.php?id=$id_event_undangan"; 
            QRcode::png($isi, $penyimpanan."$id_event_undangan.png"); 
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
                    font-size:14px;
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
                table tr td.GarisBawah{
                    border-bottom: 1px solid #666;
                }
            </style>
        </head>
        <body>
            <table>
                <tr>
                    <td align="left">
                        <img src="../../assets/img/<?php echo $logo;?>" alt="Logo" width="100px">
                    </td>
                    <td align="left" class="GarisBawah">
                        <?php
                            echo '<h3><b>'.$title_page.'</b></h3><br>';
                            echo '<i>'.$alamat_bisnis.'</i>';
                            echo '<i>Telepon '.$telepon_bisnis.'</i>';
                        ?>
                    </td>
                </tr>
            </table>
            <br>
            <table class="kostum">
                <tr>
                    <td>
                        <small><dt>No.Surat</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo "$id_event/$id_event_tamplate/$id_event_undangan"; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Prihal</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo $nama_event; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Tanggal Pelaksanaan</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo "$tanggal_mulai s/d $tanggal_selesai"; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Kepada</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo "$nama"; ?></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <small><dt>Unit/Instansi</dt></small>
                    </td>
                    <td><b>:</b></td>
                    <td>
                        <small><?php echo "$unit_instansi"; ?></small>
                    </td>
                </tr>
            </table>
            <br>
            <?php echo "$undangan"; ?>
            <br>
            <br>
            <div class="col-md-12">
                <?php 
                    echo '';
                    echo "Mengetahui, <br>"; 
                    echo '<img src="'.$base_url.'/assets/img/qrcode/'.$id_event_undangan.'.png" width="100px"><br>';
                    echo ''.$nama_unit_kerja.'<br>';
                ?>
            </div>
        </body>
    </html>
<?php 
        }
    }
    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'I');
    exit;
?>