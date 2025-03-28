<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include '../../vendor/autoload.php';
    //Tangkap id_akses
    if(empty($_POST['format_cetak'])){
        echo ' Format Cetak Tidak Boleh Kosong';
    }else{
        if(empty($_POST['kategori_barang'])){
            $kategori_barang="";
        }else{
            $kategori_barang=$_POST['kategori_barang'];
        }
        if(empty($_POST['kategori_asset'])){
            $kategori_asset="";
        }else{
            $kategori_asset=$_POST['kategori_asset'];
        }
        if(empty($_POST['nama_unit_kerja'])){
            $nama_unit_kerja="";
        }else{
            $nama_unit_kerja=$_POST['nama_unit_kerja'];
        }
        if(empty($_POST['kondisi'])){
            $kondisi="";
        }else{
            $kondisi=$_POST['kondisi'];
        }
        if(empty($_POST['ketersediaan'])){
            $ketersediaan="";
        }else{
            $ketersediaan=$_POST['ketersediaan'];
        }
        $format_cetak=$_POST['format_cetak'];
        if($format_cetak=="PDF"){
            $mpdf = new \Mpdf\Mpdf();
            $nama_dokumen= "Laporan-Waktu-Henti";
            // $mpdf=new mPDF('utf-8', array($panjang_x,$lebar_y)); 
            $html='<style>@page *{margin-top: 0px;}</style>'; 
            //Beginning Buffer to save PHP variables and HTML tags
            ob_start();
        }
        //Menghitung Data
        if(empty($kategori_barang)){
            if(empty($kategori_asset)){
                if(empty($nama_unit_kerja)){
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }else{
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }
            }else{
                if(empty($nama_unit_kerja)){
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }else{
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }
            }
        }else{
            if(empty($kategori_asset)){
                if(empty($nama_unit_kerja)){
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }else{
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }
            }else{
                if(empty($nama_unit_kerja)){
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }else{
                    if(empty($kondisi)){
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'"));
                        }
                    }else{
                        if(empty($ketersediaan)){
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'"));
                        }else{
                            $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'"));
                        }
                    }
                }
            }
        }
?>
    <html>
        <head>
            <title>Laporan Data Inventaris</title>
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
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Barang</b></td>
                    <td align="center"><b>Kategori</b></td>
                    <td align="center"><b>Unit/User</b></td>
                    <td align="center"><b>Qty</b></td>
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
                        if(empty($kategori_barang)){
                            if(empty($kategori_asset)){
                                if(empty($nama_unit_kerja)){
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }else{
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }
                            }else{
                                if(empty($nama_unit_kerja)){
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }else{
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }
                            }
                        }else{
                            if(empty($kategori_asset)){
                                if(empty($nama_unit_kerja)){
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }else{
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }
                            }else{
                                if(empty($nama_unit_kerja)){
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }else{
                                    if(empty($kondisi)){
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND ketersediaan='$ketersediaan'");
                                        }
                                    }else{
                                        if(empty($ketersediaan)){
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi'");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE kategori_barang='$kategori_barang' AND kategori_asset='$kategori_asset' AND nama_unit_kerja='$nama_unit_kerja' AND kondisi='$kondisi' AND ketersediaan='$ketersediaan'");
                                        }
                                    }
                                }
                            }
                        }
                        while ($data = mysqli_fetch_array($query)) {
                            $id_inventaris= $data['id_inventaris'];
                            $id_akses= $data['id_akses'];
                            $id_unit_kerja= $data['id_unit_kerja'];
                            $nama_unit_kerja= $data['nama_unit_kerja'];
                            $kode= $data['kode'];
                            $nama= $data['nama'];
                            $kategori_barang= $data['kategori_barang'];
                            $kategori_asset= $data['kategori_asset'];
                            $spesifikasi= $data['spesifikasi'];
                            $nomor_serial= $data['nomor_serial'];
                            $gambar= $data['gambar'];
                            $kondisi= $data['kondisi'];
                            $ketersediaan= $data['ketersediaan'];
                            $lokasi= $data['lokasi'];
                            $qty= $data['qty'];
                            $satuan= $data['satuan'];
                            $tanggal_beli= $data['tanggal_beli'];
                            $tanggal_garansi= $data['tanggal_garansi'];
                            $tanggal_input= $data['tanggal_input'];
                            //Buka data akses
                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                            $nama_akses= $DataDetailAkses['nama_akses'];
                            echo '<tr>';
                            echo '  <td align="center">'.$no.'</td>';
                            echo '  <td align="left">'.$nama.'<br>Kode: '.$kode.'<br>SN:'.$nomor_serial.'</td>';
                            echo '  <td align="left">'.$kategori_barang.'<br>'.$kategori_asset.'</td>';
                            echo '  <td align="left">'.$nama_akses.'<br>'.$nama_unit_kerja.'</td>';
                            echo '  <td align="left">'.$qty.' '.$satuan.'</td>';
                            echo '  <td align="left">'.$kondisi.'<br>'.$ketersediaan.'</td>';
                            echo '</tr>';
                        $no++;}
                    }
                ?>
            </table>
        </body>
    </html>
<?php 
    }
    if($format_cetak=="PDF"){
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        exit;
    }
?>