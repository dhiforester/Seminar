<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    //Tangkap id_akses
    if(empty($_GET['periode1'])){
        echo ' Periode Tidak Boleh Kosong';
    }else{
        if(empty($_GET['periode2'])){
            echo ' Periode Tidak Boleh Kosong';
        }else{
            if(empty($_GET['id_ruangan'])){
                echo 'Ruangan Tidak Boleh Kosong';
            }else{
                $periode1=$_GET['periode1'];
                $periode2=$_GET['periode2'];
                $id_ruangan=$_GET['id_ruangan'];
                $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM list_kunjungan WHERE id_ruangan='$id_ruangan' AND datetime>='$periode1' AND datetime<='$periode2'"));
                //Menghitung Data
                if(empty($JumlahData)){
                    echo 'Data Tidak Ada';
                }else{
                    //bUKA DATA RUANGAN
                    $QryRuangan = mysqli_query($Conn,"SELECT * FROM list_ruangan WHERE id_ruangan='$id_ruangan'")or die(mysqli_error($Conn));
                    $DataRuangan = mysqli_fetch_array($QryRuangan);
                    $nama_ruangan= $DataRuangan['nama_ruangan'];
?>
    <html>
        <head>
            <title>Laporan Kunjungan</title>
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
            <table class="kostum" width="100%">
                <tr>
                    <td align="center">
                        <h4>LAPORAN KUNJUNGAN RUANGAN</h4><BR>
                        <b><?php echo "$nama_ruangan"; ?></b>
                    </td>
                </tr>
            </table>
            <table class="data" width="100%">
                <tr>
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Datetime</b></td>
                    <td align="center"><b>Nama Pengunjung</b></td>
                    <td align="center"><b>Unit</b></td>
                </tr>
                <?php
                    $no = 1;
                    $query = mysqli_query($Conn, "SELECT*FROM list_kunjungan WHERE id_ruangan='$id_ruangan' AND datetime>='$periode1' AND datetime<='$periode2' ORDER BY datetime ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_kunjungan= $data['id_kunjungan'];
                        $id_ruangan= $data['id_ruangan'];
                        $nama= $data['nama'];
                        $unit= $data['unit'];
                        $datetime= $data['datetime'];
                        echo '<tr>';
                        echo '  <td align="center">'.$no.'</td>';
                        echo '  <td align="left">'.$datetime.'</td>';
                        echo '  <td align="left">'.$nama.'</td>';
                        echo '  <td align="left">'.$unit.'</td>';
                        echo '</tr>';
                        $no++;
                        }
                    }
                ?>
            </table>
        </body>
    </html>
<?php 
        }
    }
}
?>