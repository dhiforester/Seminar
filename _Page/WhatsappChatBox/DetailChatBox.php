<?php
    if(empty($_GET['nomor'])){
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-lg-12">';
        echo '          <div class="card">';
        echo '              <div class="card-body">';
        echo '                  <div class="row">';
        echo '                      <div class="col-lg-12 text-center">';
        echo '                          Nomor Akun WA Tidak Boleh Kosong!';
        echo '                      </div>';
        echo '                  </div>';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $GetDetailNomor=$_GET['nomor'];
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form action="javascript:void(0);" id="ProsesBatasDetail">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <h4>Detail Chat Box</h4>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <input type="text" readonly name="nomor" id="nomor" class="form-control" value="<?php echo $GetDetailNomor;?>">
                                    <small>Nomor Akun</small>
                                </div>
                                <div class="col-md-2 text-center mt-3">
                                    <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalKirimPesan" data-id="<?php echo $GetDetailNomor;?>">
                                        <i class="bi bi-plus"></i> Kirim
                                    </button>
                                </div>
                                <div class="col-md-2 text-center mt-3">
                                    <a href="index.php?Page=WhatsappChatBox" class="btn btn-md btn-info btn-block btn-rounded">
                                        <i class="bi bi-arrow-left-circle"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    include "_Config/SettingWhatsapp.php";
                                    //BUKA DATA DISTINCT
                                    $arr = array(
                                        "api_key"=> "$api_key_Whatsapp",
                                        "number"=> "$GetDetailNomor"
                                    );
                                    $headers = array(
                                        'Content-Type:Application/x-www-form-urlencoded'
                                    );
                                    $json=json_encode($arr);
                                    //Kirim data CURL
                                    $ch = curl_init();
                                    curl_setopt($ch,CURLOPT_URL, "$url_chatbox_distinct");
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
                                    curl_setopt($ch,CURLOPT_TIMEOUT, 30);
                                    curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                                    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
                                    curl_setopt($ch,CURLOPT_HEADER, 0);
                                    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
                                    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                        'Content-Type: application/json',
                                        'Content-Length: ' . strlen($json))
                                    );
                                    $result = curl_exec($ch);
                                    curl_close($ch);
                                    $ambil_json =json_decode($result, true);
                                    if($ambil_json["response"]["code"]==200){
                                        $list=$ambil_json["metadata"]["list"];
                                        $CountList=count($list);
                                        if(!empty($CountList)){
                                            foreach($list as $list){
                                                $nomor_pengirim=$list["nomor_pengirim"];
                                                $nomor_tujuan=$list["nomor_tujuan"];
                                                if($GetDetailNomor==$nomor_pengirim){
                                                    $your_number=$nomor_tujuan;
                                                }else{
                                                    $your_number=$nomor_pengirim;
                                                }
                                                //Cek apakah sudah ada di chat_with_me
                                                $CekChatWithMe = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM chat_with_me WHERE my_number='$GetDetailNomor' AND you_number='$your_number'"));
                                                //Apabila kosong maka simpan
                                                if(empty($CekChatWithMe)){
                                                    $entry="INSERT INTO chat_with_me (
                                                        my_number,
                                                        you_number
                                                    ) VALUES (
                                                        '$GetDetailNomor',
                                                        '$your_number'
                                                    )";
                                                    $Input=mysqli_query($Conn, $entry);
                                                    if($Input){
                                                        // echo "<small>$your_number Berhasil Disimpan Sebagai partner $GetDetailNomor</small><br>";
                                                    }
                                                }else{
                                                    // echo "<small>$your_number Sudah ada di database</small><br>";
                                                }
                                            }
                                        }
                                    }else{
                                        $pesan=$ambil_json["response"]["massage"];
                                        // echo "<small>$pesan</small> <br>";
                                    }
                                    //LAKUKAN PENGECEKAN APAKAH LISY chat_with_me masih relevan
                                    $query = mysqli_query($Conn, "SELECT*FROM chat_with_me WHERE my_number='$GetDetailNomor'");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_chat_with_me= $data['id_chat_with_me'];
                                        $my_number= $data['my_number'];
                                        $you_number= $data['you_number'];
                                        //CHECK APAKAHA ADA PADA CHATBOX
                                        $arr = array(
                                            "api_key"=> "$api_key_Whatsapp",
                                            "me"=> "$my_number",
                                            "you"=> "$you_number"
                                        );
                                        $headers = array(
                                            'Content-Type:Application/x-www-form-urlencoded'
                                        );
                                        $json=json_encode($arr);
                                        //Kirim data CURL
                                        $ch = curl_init();
                                        curl_setopt($ch,CURLOPT_URL, "$url_chatbox_count_youme");
                                        curl_setopt($ch, CURLOPT_POST, 1);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                                        curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
                                        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
                                        curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                                        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
                                        curl_setopt($ch,CURLOPT_HEADER, 0);
                                        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
                                        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json',
                                            'Content-Length: ' . strlen($json))
                                        );
                                        $result = curl_exec($ch);
                                        curl_close($ch);
                                        $ambil_json =json_decode($result, true);
                                        if($ambil_json["response"]["code"]==200){
                                            $totalitem=$ambil_json["metadata"]["totalitem"];
                                            if(empty($totalitem)){
                                                //apabila kosong maka hapus
                                                $HapusChatWithMe = mysqli_query($Conn, "DELETE FROM chat_with_me WHERE id_chat_with_me='$id_chat_with_me'") or die(mysqli_error($Conn));
                                                if($HapusChatWithMe){
                                                    // echo "<small>Hapusc Chat Dengan $you_number Berhasil</small> <br>";
                                                }else{
                                                    // echo "<small>Hapusc Chat Dengan $you_number Gagal</small> <br>";
                                                }
                                            }
                                        }
                                    }
                                ?>

                                <table class="table table-hover table-bordered align-items-center mb-0">
                                    <thead class="">
                                        <tr>
                                            <th class="text-center">
                                                <b>No</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Nomor</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Chat</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Inbox</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Outbox</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Option</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            //KONDISI PENGATURAN MASING FILTER
                                            $query = mysqli_query($Conn, "SELECT*FROM chat_with_me WHERE my_number='$GetDetailNomor' ORDER BY id_chat_with_me DESC");
                                            while ($data = mysqli_fetch_array($query)) {
                                                $id_chat_with_me= $data['id_chat_with_me'];
                                                $my_number= $data['my_number'];
                                                $you_number= $data['you_number'];
                                                //CHECK APAKAHA ADA PADA CHATBOX
                                                $arr = array(
                                                    "api_key"=> "$api_key_Whatsapp",
                                                    "me"=> "$my_number",
                                                    "you"=> "$you_number"
                                                );
                                                $headers = array(
                                                    'Content-Type:Application/x-www-form-urlencoded'
                                                );
                                                $json=json_encode($arr);
                                                //Kirim data CURL
                                                $ch = curl_init();
                                                curl_setopt($ch,CURLOPT_URL, "$url_chatbox_count_youme");
                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                                                curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
                                                curl_setopt($ch,CURLOPT_TIMEOUT, 30);
                                                curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                                                curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
                                                curl_setopt($ch,CURLOPT_HEADER, 0);
                                                curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
                                                curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                    'Content-Type: application/json',
                                                    'Content-Length: ' . strlen($json))
                                                );
                                                $result = curl_exec($ch);
                                                curl_close($ch);
                                                $ambil_json =json_decode($result, true);
                                                if($ambil_json["response"]["code"]==200){
                                                    $totalitem=$ambil_json["metadata"]["totalitem"];
                                                    $outbox=$ambil_json["metadata"]["outbox"];
                                                    $inbox=$ambil_json["metadata"]["inbox"];
                                                }else{
                                                    $totalitem=0;
                                                    $outbox=0;
                                                    $inbox=0;
                                                }
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <p class="text-xs text-bold mb-0"><?php echo "$no";?></p>
                                                </td>
                                                <td class="text-left">
                                                    <small><?php echo "$you_number";?></small>
                                                </td>
                                                <td class="text-left">
                                                    <?php echo "<small>$totalitem</small>";?>
                                                </td>
                                                <td class="text-left">
                                                    <?php echo "<small>$inbox</small>";?>
                                                </td>
                                                <td class="text-left">
                                                    <?php echo "<small>$outbox</small>";?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalDetailChatBox" data-id="<?php echo "$my_number,$you_number"; ?>">
                                                        <i class="bi bi-info-circle"></i> Detail
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapusChatBox" data-id="<?php echo "$my_number,$you_number"; ?>">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;}
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>