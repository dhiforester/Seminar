<?php
    $QryPembayaran=mysqli_query($Conn, "SELECT*FROM transaksi_pembayaran WHERE status='Pending'");
    while ($DataPembayaran = mysqli_fetch_array($QryPembayaran)) {
        $id_pembayaran= $DataPembayaran['id_pembayaran'];
        $order_id= $DataPembayaran['order_id'];
        $StatusPembayaran= $DataPembayaran['status'];
        //Buka detail Pembayaran
        if(!empty($DataPembayaran['order_id'])){
            $Url="$api_payment_url/StatusPembayaran.php?order_id=$order_id";
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_URL, $Url);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
            $send=curl_exec($ch);
            $data =json_decode($send, true);
            if(!empty($data["metadata"]["transaction_status"])){
                $StatusPembayaranBaru=$data["metadata"]["transaction_status"];
                if($StatusPembayaran!==$StatusPembayaranBaru){
                    if($StatusPembayaranBaru=="pending"){
                        $StatusPembayaranBaru="Pending";
                    }else{
                        if($StatusPembayaranBaru=="settlement"){
                            $StatusPembayaranBaru="Lunas";
                        }else{
                            if($StatusPembayaranBaru=="expire"){
                                $StatusPembayaranBaru="Expire";
                            }else{
                                $StatusPembayaranBaru=$StatusPembayaranBaru;
                            }
                        }
                    }
                    //update status_pembayaran pada tabel transaksi
                    $QryUpdate = mysqli_query($Conn,"UPDATE transaksi_pembayaran SET status='$StatusPembayaranBaru' WHERE id_pembayaran='$id_pembayaran'")or die(mysqli_error($Conn));
                }
            }
        }
    }
?>