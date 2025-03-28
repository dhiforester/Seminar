<?php
    include "_Config/Connection.php";
    include "_Config/SettingGeneral.php";
    include "_Config/Function.php";
    include "vendor/phpqrcode/qrlib.php";
    require_once __DIR__ . '/vendor/autoload.php';
    if(empty($_GET['Token'])){
        echo "Token Sertifikat Tidak Valid!";
    }else{
        $Token=$_GET['Token'];
        $id_event_setting=getDataDetail($Conn,'event_sertifikat','token',$Token,'id_event_setting');
        $id_setting_sertifikat=getDataDetail($Conn,'event_sertifikat','token',$Token,'id_setting_sertifikat');
        $nama=getDataDetail($Conn,'event_sertifikat','token',$Token,'nama');
        //Buka Pengaturan
        $group_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'group_name');
        $text_align=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'text_align');
        $line_height=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'line_height');
        $margin_left=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'margin_left');
        $font_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'font_name');
        $font_size=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'font_size');
        $font_color=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'font_color');
        $img_bg=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'img_bg');
        if(empty($id_setting_sertifikat)){
            echo "Tidak ada pengaturan setting sertifikat";
        }else{
            $gambar = "assets/img/Sertifikat/$img_bg";
            $mpdf = new \Mpdf\Mpdf();
            $nama_dokumen= "Sertifikat";
            // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [338.47, 239.04]]);
            $html='<style>@page *{margin-top: 0px;}</style>'; 
            //Beginning Buffer to save PHP variables and HTML tags
            ob_start();

            //Membuat QR Code
            $TempDirQr = "assets/img/qrcode/"; 
            $LogoTengahQrPath = "assets/img/qrcode/logo.png";
            $NamaQrCode ="$Token.png";
            //Kualitas dari QRCode 
            $QualityQrCode = 'H'; 
            //Ukuran besar QRCode
            $UkuranQrCode = 8; 
            $PaddingQrCode = 0; 
            QRCode::png($Token,$TempDirQr.$NamaQrCode,$QualityQrCode,$UkuranQrCode,$PaddingQrCode);
            $filepath = $TempDirQr.$NamaQrCode;
            $QR = imagecreatefrompng($filepath);
            //Membuat Logo
            $logo = imagecreatefromstring(file_get_contents($LogoTengahQrPath));
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);

            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            //besar logo
            $logo_qr_width = $QR_width/2.5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;

            //posisi logo
            imagecopyresampled($QR, $logo, $QR_width/3.3, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            imagepng($QR,$filepath);
?>
    <html>
        <head>
            <title>Sertifikat</title>
            <style type="text/css">
                /* @font-face {
                    font-family: 'charm';
                    src: url('assets/font-sertifikat/Charm-Regular.ttf');
                } */
                @page {
                    margin-top: 0cm;
                    margin-bottom: 0cm;
                    margin-left: 0cm;
                    margin-right: 0cm;
                    background-image: url("assets/img/Sertifikat/<?php echo $img_bg; ?>");
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center;
                    background-size: cover;
                    height: 100%; 
                }
                body {
                    font-size: 52.5pt;
                    font-family: "charm";
                    position: relative;
                }
                .nama{
                    text-align: center;
                    line-height: 175mm;
                    color: #155B39;
                    margin-left: 187px;
                }
                .QrCode{
                    position: absolute;
                    text-align: left;
                    bottom:0px;
                    width: 144px; 
                    height: 144px; 
                }
            </style>
        </head>
        <body>
            <div class="nama"><?php echo $nama;?></div>
            <div class="QrCode">
                <img src="assets/img/qrcode/<?php echo $NamaQrCode; ?>" width="144px" class="ImageQrCode">
            </div>
        </body>
    </html>
<?php
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf->WriteHTML(utf8_encode($html));
            $mpdf->Output($nama_dokumen.".pdf" ,'I');
            exit;
        }
    }
?>