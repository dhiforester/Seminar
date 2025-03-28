<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/SettingPayment.php";
    include "../../_Config/Session.php";
    //DasarPencarian
    if(!empty($_POST['DasarPencarian'])){
        $DasarPencarian=$_POST['DasarPencarian'];
    }else{
        $DasarPencarian="";
    }
    //keyword
    if(!empty($_POST['KeywordAktivitasPayment'])){
        $keyword=$_POST['KeywordAktivitasPayment'];
    }else{
        $keyword="";
    }
?>
<div class="card-body">
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead class="">
                        <tr>
                            <th class="text-center">
                                <b>No</b>
                            </th>
                            <th class="text-center">
                                <b>Tanggal</b>
                            </th>
                            <th class="text-center">
                                <b>Kode Transaksi</b>
                            </th>
                            <th class="text-center">
                                <b>Order ID</b>
                            </th>
                            <th class="text-center">
                                <b>Metode</b>
                            </th>
                            <th class="text-center">
                                <b>Jumlah</b>
                            </th>
                            <th class="text-center">
                                <b>Status</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $headers = array(
                                'Content-Type:Application/x-www-form-urlencoded',         
                            );
                            //CURL send data
                            if($DasarPencarian=="Tanggal"){
                                $arr = array(
                                    "merchant_id" => "$id_marchant",
                                    "transaction_time" => "$keyword"
                                );
                                $url="$api_payment_url/GetPaymentLog.php";
                            }else{
                                $arr = array(
                                    "kode_transaksi" => "$keyword"
                                );
                                $url="$api_payment_url/GetPaymentLogByKode.php";
                            }
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
                                echo '<tr>';
                                echo '  <td colspan="77" class="text-danger text-center">Tidak Ada Response</td>';
                                echo '</tr>';
                            }else{
                                if(empty($ShowList['list'])){
                                    echo '<tr>';
                                    echo '  <td colspan="7" class="text-danger text-center">Data Tidak Ditemukan</td>';
                                    echo '</tr>';
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
                                        echo '<tr>';
                                        echo '  <td class="text-center">'.$no.'</td>';
                                        echo '  <td class="text-left" align="left">'.$transaction_time.'</td>';
                                        echo '  <td class="text-left" align="left">'.$kode_transaksi.'</td>';
                                        echo '  <td class="text-left" align="left">'.$order_id.'</td>';
                                        echo '  <td class="text-left" align="left">'.$payment_type.'</td>';
                                        echo '  <td class="text-left" align="left">'.$gross_amount.'</td>';
                                        echo '  <td class="text-left" align="left">'.$transaction_status.'</td>';
                                        echo '</tr>';
                                        $no++;
                                    }
                                }
                            }
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>