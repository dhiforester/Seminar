<?php
    include "../../_Config/Connection.php";
?>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="kategori_barang">Kategori</label>
        <select name="kategori_barang" id="kategori_barang" class="form-control">
            <option value="">Semua</option>
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_barang FROM inventaris ORDER BY kategori_barang ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kategori_barang= $DataKategori['kategori_barang'];
                    if(!empty($DataKategori['kategori_barang'])){
                        echo '<option value="'.$kategori_barang.'">'.$kategori_barang.'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-6 mt-3">
        <label for="kategori_asset">Asset/BHP</label>
        <select name="kategori_asset" id="kategori_asset" class="form-control">
            <option value="">Semua</option>
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_asset FROM inventaris ORDER BY kategori_asset ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kategori_asset= $DataKategori['kategori_asset'];
                    if(!empty($DataKategori['kategori_asset'])){
                        echo '<option value="'.$kategori_asset.'">'.$kategori_asset.'</option>';
                    }
                }
            ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="nama_unit_kerja">Unit Kerja</label>
        <select name="nama_unit_kerja" id="nama_unit_kerja" class="form-control">
            <option value="">Semua</option>
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT nama_unit_kerja FROM inventaris ORDER BY nama_unit_kerja ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $nama_unit_kerja= $DataKategori['nama_unit_kerja'];
                    if(!empty($DataKategori['nama_unit_kerja'])){
                        echo '<option value="'.$nama_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-6 mt-3">
        <label for="kondisi">Kondisi Barang</label>
        <select name="kondisi" id="kondisi" class="form-control">
            <option value="">Semua</option>
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kondisi FROM inventaris ORDER BY kondisi ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kondisi= $DataKategori['kondisi'];
                    if(!empty($DataKategori['kondisi'])){
                        echo '<option value="'.$kondisi.'">'.$kondisi.'</option>';
                    }
                }
            ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="ketersediaan">Ketersediaan</label>
        <select name="ketersediaan" id="ketersediaan" class="form-control">
            <option value="">Semua</option>
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT ketersediaan FROM inventaris ORDER BY ketersediaan ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $ketersediaan= $DataKategori['ketersediaan'];
                    if(!empty($DataKategori['ketersediaan'])){
                        echo '<option value="'.$ketersediaan.'">'.$ketersediaan.'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-6 mt-3">
        <label for="format_cetak">Format Cetak</label>
        <select name="format_cetak" id="format_cetak" class="form-control">
            <option value="HTML">HTML</option>
            <option value="PDF">PDF</option>
        </select>
    </div>
</div>