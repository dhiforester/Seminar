<?php
    include "Function.php";
	$fp = fopen('php://input', 'r');
	$raw = stream_get_contents($fp);
	$Tangkap = json_decode($raw,true);
	if(empty($Tangkap['ServerKey'])){
		$Array = Array (
			"pesan" => "Server Key Tidak Boleh Kosong",
			"code" =>201,
			"token" =>"",
		);
	}else{
		if(empty($Tangkap['Production'])){
			$Array = Array (
				"pesan" => "Informasi Production Tidak Boleh Kosong",
				"code" =>201,
				"token" =>"",
			);
		}else{
			if(empty($Tangkap['order_id'])){
				$Array = Array (
					"pesan" => "Order ID Tidak Boleh Kosong",
					"code" =>201,
					"token" =>"",
				);
			}else{
				if(empty($Tangkap['gross_amount'])){
					$Array = Array (
						"pesan" => "Jumlah Tagihan Tidak Boleh Kosong",
						"code" =>201,
						"token" =>"",
					);
				}else{
					if(empty($Tangkap['first_name'])){
						$Array = Array (
							"pesan" => "first_name Tidak Boleh Kosong",
							"code" =>201,
							"token" =>"",
						);
					}else{
						if(empty($Tangkap['last_name'])){
							$Array = Array (
								"pesan" => "last_name Tidak Boleh Kosong",
								"code" =>201,
								"token" =>"",
							);
						}else{
							if(empty($Tangkap['email'])){
								$Array = Array (
									"pesan" => "email Tidak Boleh Kosong",
									"code" =>201,
									"token" =>"",
								);
							}else{
								if(empty($Tangkap['phone'])){
									$Array = Array (
										"pesan" => "Nomor HP Tidak Boleh Kosong",
										"code" =>201,
										"token" =>"",
									);
								}else{
								    if(empty($Tangkap['kode_transaksi'])){
    									$Array = Array (
    										"pesan" => "Kode Transaksi Tidak Boleh Kosong",
    										"code" =>201,
    										"token" =>"",
    									);
    								}else{
    									$GetServerKey=$Tangkap['ServerKey'];
    									$Production=$Tangkap['Production'];
    									$order_id=$Tangkap['order_id'];
    									$gross_amount=$Tangkap['gross_amount'];
    									$first_name=$Tangkap['first_name'];
    									$last_name=$Tangkap['last_name'];
    									$email=$Tangkap['email'];
    									$phone=$Tangkap['phone'];
    									$kode_transaksi=$Tangkap['kode_transaksi'];
    									//Bungkus Data
    									$log = Array (
											"ServerKey" => $GetServerKey,
											"Production" => $Production,
											"order_id" => $order_id,
											"gross_amount" => $gross_amount,
											"first_name" => $first_name,
											"last_name" => $last_name,
											"email" => $email,
											"phone" => $phone,
											"kode_transaksi" => $kode_transaksi
										);
										$JsonLog = json_encode($log);
    									//Simpan Data
    									$simpan=InsertKodeTransaksi($Conn,$order_id,$kode_transaksi,$JsonLog);
    									if($simpan!=="Berhasil"){
    									   $Array = Array (
        										"pesan" => "Terjadi kesalahan pada saat menyimpan data transaksi",
        										"code" =>201,
        										"token" =>"",
        									); 
    									}else{
        									require_once "midtrans-php-master/Midtrans.php";
        									// Set your Merchant Server Key
        									\Midtrans\Config::$serverKey = ''.$GetServerKey.'';
        									// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        									if($Production=="true"){
        										\Midtrans\Config::$isProduction = true;
        									}else{
        										\Midtrans\Config::$isProduction = false;
        									}
        									// Set sanitization on (default)
        									\Midtrans\Config::$isSanitized = true;
        									// Set 3DS transaction for credit card to true
        									\Midtrans\Config::$is3ds = true;
        									$params = array(
        										'transaction_details' => array(
        											'order_id' => $order_id,
        											'gross_amount' => $gross_amount,
        										),
        										'customer_details' => array(
        											'first_name' => ''.$first_name.'',
        											'last_name' => ''.$last_name.'',
        											'email' => ''.$email.'',
        											'phone' => ''.$phone.'',
        										),
        									);
        									$snapToken = \Midtrans\Snap::getSnapToken($params);
        									if(!empty($snapToken)){
        										$Array = Array (
        											"pesan" => "Berhasil",
        											"code" =>200,
        											"token" =>"$snapToken",
        										); 
        									}else{
        										$Array = Array (
        											"pesan" => "Token Gagal Dibuat",
        											"code" =>201,
        											"token" =>"",
        										);
        									}
    									}
    								}
								}
							}
						}
					}
				}
			}
		}
	}
	$json = json_encode($Array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (10 * 60)));
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header('Content-Type: application/json');
	header('Pragma: no-chache');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, x-token, token"); 
	echo $json;
	exit();
    
?>