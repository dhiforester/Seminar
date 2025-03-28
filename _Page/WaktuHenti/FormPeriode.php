<?php
    if(empty($_POST['bulan'])){
        $bulan=date('m');
    }else{
        $bulan=$_POST['bulan'];
    }
?>
<select name="bulan" id="bulan" class="form-control">
    <option <?php if($bulan=="01"){echo "selected";} ?> value="01">Januari</option>
    <option <?php if($bulan=="02"){echo "selected";} ?> value="02">Februari</option>
    <option <?php if($bulan=="03"){echo "selected";} ?> value="03">Maret</option>
    <option <?php if($bulan=="04"){echo "selected";} ?> value="04">April</option>
    <option <?php if($bulan=="05"){echo "selected";} ?> value="05">Mei</option>
    <option <?php if($bulan=="06"){echo "selected";} ?> value="06">Juni</option>
    <option <?php if($bulan=="07"){echo "selected";} ?> value="07">Juli</option>
    <option <?php if($bulan=="08"){echo "selected";} ?> value="08">Agustus</option>
    <option <?php if($bulan=="09"){echo "selected";} ?> value="09">September</option>
    <option <?php if($bulan=="10"){echo "selected";} ?> value="10">Oktober</option>
    <option <?php if($bulan=="11"){echo "selected";} ?> value="11">November</option>
    <option <?php if($bulan=="12"){echo "selected";} ?> value="12">Desember</option>
</select>
<small>Bulan</small>