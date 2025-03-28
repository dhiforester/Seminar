<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SettingPayment.php";
    include "../../_Config/Function.php";
    $now=date('Y-m-d H:i:s');
    $MikroTime=strtotime($now);
    //Tangkap id_event_pembayaran
    if(empty($_POST['id_event_pembayaran'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Pembayaran Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_pembayaran=$_POST['id_event_pembayaran'];
        //Buka Detail Pembayaran
        $IdEventPembayaran=getDataDetail($Conn,'event_pembayaran','id_event_pembayaran',$id_event_pembayaran,'id_event_pembayaran');
        $id_peserta=getDataDetail($Conn,'event_pembayaran','id_event_pembayaran',$id_event_pembayaran,'id_peserta');
        $harga=getDataDetail($Conn,'event_pembayaran','id_event_pembayaran',$id_event_pembayaran,'harga');
        $tagihan=getDataDetail($Conn,'event_pembayaran','id_event_pembayaran',$id_event_pembayaran,'tagihan');
        $status=getDataDetail($Conn,'event_pembayaran','id_event_pembayaran',$id_event_pembayaran,'status');
        $kode_transaksi=getDataDetail($Conn,'event_pembayaran','id_event_pembayaran',$id_event_pembayaran,'kode_transaksi');
        $TagihanRupiah = "Rp " . number_format($tagihan, 0, ',', '.');
        //Buka Nama Peserta
        $NamaPeserta=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'nama');
        $Explode = explode(" " , $NamaPeserta);
        $first_name =$Explode[0];
        if(empty($Explode[1])){
            $last_name ="";
        }else{
            $last_name =$Explode[1];
        }
        //Email dan Kontak
        $email=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'email');
        $phone=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'kontak');
        //Membuat Order ID
        $order_id ="ORDID-$id_peserta-$MikroTime";
        $gross_amount =$tagihan;
        if($status=="Lunas"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12 text-center text-danger"><b>Anda Tidak Bisa Melakukan Pembayaran Karena Transaksi Sudah Lunas</b></div>';
            echo '</div>';
        }else{
            //Cek Status Transaksi Pada Service Payment Gateway Berdasarkan Kode Transaksi
            $headers1 = array(
                'Content-Type:Application/x-www-form-urlencoded',         
            );
            $url="$api_payment_url/StatusPembayaran.php?kode_transaksi=$kode_transaksi";
            //CURL send data
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $data =json_decode($response, true);
            $code=$data["metadata"]["code"];
            if($code==200){
                $StatusTransaksiService=$data["metadata"]["transaction_status"];
            }else{
                $StatusTransaksiService=$data["metadata"]["pesan"];
            }
            if($StatusTransaksiService=="settlement"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12 text-center text-danger"><b>Berdasarkan infroamsi service, transaksi sudah lunas, silahkan lakukan update transaksi.</b></div>';
                echo '</div>';
            }else{
                //Krim data dengan CURL
                $headers = array(
                    'Content-Type:Application/x-www-form-urlencoded',         
                );
                //CURL send data
                $arr = array(
                    "ServerKey" => "$server_key",
                    "Production" => "$production",
                    "kode_transaksi" => "$kode_transaksi",
                    "order_id" => "$order_id",
                    "gross_amount" => "$gross_amount",
                    "first_name" => "$first_name",
                    "last_name" => "$last_name",
                    "email" => "$email",
                    "phone" => "$phone",
                );
                $json = json_encode($arr);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "$api_payment_url/GetSnapToken.php");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                $data =json_decode($response, true);
                if($data["code"]!==200){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12 text-center text-danger"><b>Token Gagal Dibuat</b></div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12 text-center text-danger">'.$data["pesan"].'</div>';
                    echo '</div>';
                }else{
                    $token=$data["token"];
?>
    <div class="row mb-3">
        <div class="col-md-4"><b>Kode Transaksi</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$kode_transaksi"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Order ID</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$order_id"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Snap Token</b></div>
        <div class="col-md-8"><code class="text-success"><?php echo "$token"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Gross Amount</b></div>
        <div class="col-md-8"><code class="text-success"><?php echo "$TagihanRupiah"; ?></code></div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3 text-center">
            <?php
                $headers = array(
                    'Content-Type:Application/x-www-form-urlencoded',         
                );
                //CURL send data
                $arr = array(
                    "snap_url" => "$snap_url",
                    "client_id" => "$server_key",
                    "snapToken" => "$token"
                );
                $json = json_encode($arr);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "$api_payment_url/GenerateSnapButton.php");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                $data =json_decode($response, true);
                // $code=$data["code"];
                // $pesan=$data["pesan"];
                // $token=$data["token"];
                echo "$response";
            ?>
        </div>
    </div>
<?php }}}} ?>