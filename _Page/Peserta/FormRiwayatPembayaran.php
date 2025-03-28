<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SettingPayment.php";
    include "../../_Config/Session.php";
    //Tangkap id_event_pembayaran
    if(empty($_POST['id_event_pembayaran'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Pembayaran Tidak Boleh Kosong.';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_pembayaran=$_POST['id_event_pembayaran'];
        //Buka data Pembayaran
        $QryPembayaran = mysqli_query($Conn,"SELECT * FROM event_pembayaran WHERE id_event_pembayaran='$id_event_pembayaran'")or die(mysqli_error($Conn));
        $DataPembayaran = mysqli_fetch_array($QryPembayaran);
        if(empty( $DataPembayaran['id_event_pembayaran'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center text-danger">';
            echo '      ID Pembayaran Tidak Valid.';
            echo '  </div>';
            echo '</div>';
        }else{
            $kode_transaksi= $DataPembayaran['kode_transaksi'];
            $headers = array(
                'Content-Type:Application/x-www-form-urlencoded',         
            );
            $arr = array(
                "kode_transaksi" => "$kode_transaksi"
            );
            $url="$api_payment_url/GetPaymentLogByKode.php";
            $json = json_encode($arr);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "$url");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $ShowList =json_decode($response, true);
            if(empty($response)){
                echo '<div class="row">';
                echo '  <div class="col-md-12 mb-3 text-center text-danger">';
                echo '      Tidak ada response dari service payment gateway.';
                echo '  </div>';
                echo '</div>';
            }else{
                if(empty($ShowList['list'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 mb-3 text-center text-danger">';
                    echo '      Tidak ada data riwayat transaksi yang ditemukan.';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $List=$ShowList['list'];
                    $no=1;
                    foreach($List as $ShowList){
                        $id_log_payment=$ShowList["id_log_payment"];
                        $kode_transaksi=$ShowList["kode_transaksi"];
                        $transaction_time=$ShowList["transaction_time"];
                        $transaction_status=$ShowList["transaction_status"];
                        $transaction_id=$ShowList["transaction_id"];
                        $status_message=$ShowList["status_message"];
                        $status_code=$ShowList["status_code"];
                        $signature_key=$ShowList["signature_key"];
                        $payment_type=$ShowList["payment_type"];
                        $order_id=$ShowList["order_id"];
                        $merchant_id=$ShowList["merchant_id"];
                        $gross_amount=$ShowList["gross_amount"];
                        $fraud_status=$ShowList["fraud_status"];
                        $currency=$ShowList["currency"];
?>
    <div class="row mb-3">
        <?php
            echo '<div class="col-md-12">';
            echo '  <b>'.$transaction_id.'</b>';
            echo '  <small>';
            echo '      <ul>';
            echo '          <li>ID Log : <code>'.$id_log_payment.'</code></li>';
            echo '          <li>Status : <code>'.$transaction_status.'</code></li>';
            echo '          <li>Date/Time : <code>'.$transaction_time.'</code></li>';
            echo '          <li>Type : <code>'.$payment_type.'</code></li>';
            echo '          <li>Order ID : <code>'.$order_id.'</code></li>';
            echo '          <li>Gross amount : <code>'.$gross_amount.'</code></li>';
            echo '          <li>Currency : <code>'.$currency.'</code></li>';
            echo '      </ul>';
            echo '  </small>';
            echo '</div>';
        ?>
    </div>
<?php $no++;}}}}} ?>