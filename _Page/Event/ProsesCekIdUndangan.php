<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['id_event_undangan'])){
            echo '<span class="text-danger">ID Undangan Event Tidak Boleh Kosong!</span>';
        }else{
            $id_event=$_POST['id_event'];
            $id_event_undangan=$_POST['id_event_undangan'];
            //Buka data undangan
            $QryUndangan= mysqli_query($Conn,"SELECT * FROM event_undangan WHERE id_event_undangan='$id_event_undangan' AND id_event='$id_event'")or die(mysqli_error($Conn));
            $DataUndangan= mysqli_fetch_array($QryUndangan);
            if(empty($DataUndangan['id_event_undangan'])){
                echo '<span class="text-danger">ID Undangan Event Tidak Valid!</span>';
            }else{
                $nama= $DataUndangan['nama'];
                $unit_instansi= $DataUndangan['unit_instansi'];
                $kontak= $DataUndangan['kontak'];
                $email= $DataUndangan['email'];
?>
    <table>
        <tr>
            <td><b>Nama</b></td>
            <td><b>:</b></td>
            <td><?php echo "$nama"; ?></td>
        </tr>
        <tr>
            <td><b>Unit/Instansi</b></td>
            <td><b>:</b></td>
            <td><?php echo "$unit_instansi"; ?></td>
        </tr>
        <tr>
            <td><b>Kontak</b></td>
            <td><b>:</b></td>
            <td><?php echo "$kontak"; ?></td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td><b>:</b></td>
            <td><?php echo "$email"; ?></td>
        </tr>
    </table>
<?php }}} ?>