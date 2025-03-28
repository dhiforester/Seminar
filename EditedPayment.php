<?php
        include "Connection.php";
        include "Setting.php";
        include "Function.php";
        //Maual Setting
        $AdminBaseUrl="https://simponas.bconcept.co.id";
        $api_key="2efe458d1a9dd60ddcb0be88d36098";
        require_once "midtrans-php-master/Midtrans.php";
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-RWIfjoriobGtv0veoWqF_YWK';
        $notif = new \Midtrans\Notification();
        $transaction_time = $notif->transaction_time;
        $transaction_status = $notif->transaction_status;
        $transaction_id = $notif->transaction_id;
        $status_message = $notif->status_message;
        $status_code = $notif->status_code;
        $signature_key = $notif->signature_key;
        $payment_type = $notif->payment_type;
        $order_id = $notif->order_id;
        $merchant_id = $notif->merchant_id;
        $fraud_status = $notif->fraud_status;
        $currency = $notif->currency;
        $gross_amount=$notif->gross_amount;
        //Mencari nilai kode transaksi
        $kode_transaksi=getDataDetail($Conn,'order_transaksi','order_id',$order_id,'kode_transaksi');
        if(empty($kode_transaksi)){
            $log = Array (
                "ServerKey" => $SettingServerKey,
                "Production" => $SettingProduction,
                "order_id" => $order_id,
                "Notification" => $notif,
                "transaction_time" => $transaction_time,
                "transaction_status" => $transaction_status,
                "gross_amount" => $gross_amount,
                "kode_transaksi" => $kode_transaksi
            );
            $JsonLog = json_encode($log);
            //Simpan Data
            $simpan=InsertKodeTransaksi($Conn,$order_id,$kode_transaksi,$JsonLog);
        }else{
            $log = Array (
                "ServerKey" => $SettingServerKey,
                "Production" => $SettingProduction,
                "order_id" => $order_id,
                "Notification" => $notif,
                "transaction_time" => $transaction_time,
                "transaction_status" => $transaction_status,
                "gross_amount" => $gross_amount,
                "kode_transaksi" => $kode_transaksi
            );
            $JsonLog = json_encode($log);
            //Simpan Data
            $simpan=UpdateKodeTransaksi($Conn,$order_id,$kode_transaksi,$JsonLog);
        }
        $KodeTransaksi2=getDataDetail($Conn,'order_transaksi','order_id',$order_id,'kode_transaksi');
        if(!empty($KodeTransaksi2)){
            if($transaction_status=="pending"){
                $StatusPembayaran="Pending";
            }else{
                if($transaction_status=="settlement"){
                    $StatusPembayaran="Lunas";
                }else{
                    $StatusPembayaran="Expired";
                }
            }
            $UpdateStatusTransaksiAdmin=UpdateStatusTransaksiAdmin($api_key,$KodeTransaksi2,$StatusPembayaran);
        }
        if($transaction == 'capture'){
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $keterangan="Transaction order_id: " . $order_id ." is challenged by FDS";
                }else {
                    // TODO set payment status in merchant's database to 'Success'
                    $keterangan="Transaction order_id: " . $order_id ." successfully captured using " . $type;
                }
            }else{
                if ($transaction == 'settlement'){
                    // TODO set payment status in merchant's database to 'Settlement'
                    $keterangan= "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
                }else{
                    if($transaction == 'pending'){
                        // TODO set payment status in merchant's database to 'Pending'
                        $keterangan="Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
                    }else{
                        if ($transaction == 'deny') {
                            // TODO set payment status in merchant's database to 'Denied'
                            $keterangan="Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
                        }else{
                            if ($transaction == 'expire') {
                                // TODO set payment status in merchant's database to 'expire'
                                $keterangan="Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
                            }else{
                                if ($transaction == 'cancel') {
                                    // TODO set payment status in merchant's database to 'Denied'
                                    $keterangan="Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
                                }else{
                                    $keterangan="Undefine transaction: $transaction Order ID: " . $order_id ." successfully captured using " . $type;
                                }
                            }
                        }
                    }
                }
            }
        }else{
            $keterangan="Error transaction: " . $order_id ." successfully captured using " . $type;
        }
        $entry="INSERT INTO log_payment (
            kode_transaksi,
            transaction_time,
            transaction_status,
            transaction_id,
            status_message,
            status_code,
            signature_key,
            payment_type,
            order_id,
            merchant_id,
            gross_amount,
            fraud_status,
            currency
        ) VALUES (
            '$kode_transaksi',
            '$transaction_time',
            '$transaction_status',
            '$transaction_id',
            '$status_message',
            '$status_code',
            '$signature_key',
            '$payment_type',
            '$order_id',
            '$merchant_id',
            '$gross_amount',
            '$fraud_status',
            '$currency'
        )";
        $Input=mysqli_query($Conn, $entry);
        if($Input){
            echo "$keterangan";
        }else{
            echo "Input Data Gagal";
        }
?>