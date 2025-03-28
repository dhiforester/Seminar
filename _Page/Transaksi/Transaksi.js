$('#MenampilkanTabelTransaksi').html("Loading...");
$('#MenampilkanTabelTransaksi').load("_Page/Transaksi/TabelTransaksi.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelTransaksi').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelTransaksi.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelTransaksi').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelTransaksi').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelTransaksi.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelTransaksi').html(data);
        }
    });
});
$('#ProsesFilterTransaksi').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelTransaksi').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelTransaksi.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelTransaksi').html(data);
            $('#ModalFilterTransaksi').modal('hide');
        }
    });
});
//TAMBAH TRANSAKSI
var GetIdMitra = $('#GetIdMitra').val();
//Menampilkan jumlah transaksi
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
    data 	    :  {id_mitra: GetIdMitra},
    success     : function(data){
        $('#jumlah_transaksi').val(data);
    }
});
$('#MenampilkanTabelRincian').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Transaksi/TabelRincian.php',
    data 	    :  {id_mitra: GetIdMitra},
    success     : function(data){
        $('#MenampilkanTabelRincian').html(data);
    }
});
//Ketika mitra di ubah
$('#GetIdMitra').change(function(){
    var GetIdMitra = $('#GetIdMitra').val();
    $('#jumlah_transaksi').val("Loading...");
    $('#MenampilkanTabelRincian').html('Loading...');
    $('#PilihSupplier').html('<option value="">Loading..</option>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelRincian.php',
        data 	    :  {id_mitra: GetIdMitra},
        success     : function(data){
            $('#MenampilkanTabelRincian').html(data);
        }
    });
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/PilihSupplier.php',
        data 	    :  {id_mitra: GetIdMitra},
        success     : function(data){
            $('#PilihSupplier').html(data);
        }
    });
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
        data 	    :  {id_mitra: GetIdMitra},
        success     : function(data){
            $('#jumlah_transaksi').val(data);
        }
    });
});
//Ketika mitra di ubah
$('#kategori').change(function(){
    var GetKategori = $('#kategori').val();
    var GetIdMitra = $('#GetIdMitra').val();
    if(GetKategori=="Pembelian"||GetKategori=="Pembayaran"){
        $('#PutFormSupplier').html('Loading....');
        $('#PutFormpasien').html('Loading....');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Transaksi/FormSupplier.php',
            data 	    :  {id_mitra: GetIdMitra},
            success     : function(data){
                $('#PutFormSupplier').html(data);
            }
        });
        $('#PutFormpasien').html("");
    }else{
        if(GetKategori=="Penjualan"||GetKategori=="Pendaftaran"||GetKategori=="Penerimaan"){
            $('#PutFormSupplier').html('Loading....');
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/Transaksi/FormPasien.php',
                data 	    :  {id_mitra: GetIdMitra},
                success     : function(data){
                    $('#PutFormSupplier').html(data);
                }
            });
            $('#PutFormpasien').html('Loading....');
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/Transaksi/FormKunjungan.php',
                data 	    :  {id_mitra: GetIdMitra},
                success     : function(data){
                    $('#PutFormpasien').html(data);
                }
            });
        }else{
            $('#PutFormSupplier').html("");
            $('#PutFormpasien').html("");
        }
    }
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/PilihSupplier.php',
        data 	    :  {id_mitra: GetIdMitra},
        success     : function(data){
            $('#PilihSupplier').html(data);
        }
    });
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
        data 	    :  {id_mitra: GetIdMitra},
        success     : function(data){
            $('#jumlah_transaksi').val(data);
        }
    });
});
//Tambah Jumlah Dari Rincian
$('#ClickTambahDariRincian').click(function(){
    var GetIdMitra = $('#GetIdMitra').val();
    $('#jumlah_transaksi').val("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
        data 	    :  {id_mitra: GetIdMitra},
        success     : function(data){
            $('#jumlah_transaksi').val(data);
        }
    });
});
//Tambah Jumlah Dari Rincian2
$('#ClickTambahDariRincianEdit').click(function(){
    var GetIdTransaksiEdit = $('#GetIdTransaksiEdit').val();
    $('#tagihan').val("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/HitungJumlahRincian3.php',
        data 	    :  {id_transaksi: GetIdTransaksiEdit},
        success     : function(data){
            $('#tagihan').val(data);
        }
    });
});
//Samakan dengan tagihan
$('#ClickSamakanDenganJumlahTagihan').click(function(){
    var GetIdTransaksiEdit = $('#GetIdTransaksiEdit').val();
    $('#pembayaran').val("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/HitungJumlahRincian3.php',
        data 	    :  {id_transaksi: GetIdTransaksiEdit},
        success     : function(data){
            $('#pembayaran').val(data);
        }
    });
});
//Modal Cari Pasien
$('#ModalCariPasien').on('show.bs.modal', function (e) {
    var PencarianPasien = $('#PencarianPasien').val();
    var JumlahDataPasien = $('#JumlahDataPasien').val();
    var GetIdMitra = $('#GetIdMitra').val();
    $('#MenampilkanTabelPasien').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelPasien.php',
        data        : {PencarianPasien: PencarianPasien, JumlahDataPasien: JumlahDataPasien,  GetIdMitra: GetIdMitra},
        success     : function(data){
            $('#MenampilkanTabelPasien').html(data);
        }
    });
    //Ketika pencarian pasien di click
    $('#ProsesCariPasien').submit(function(){
        var ProsesCariPasien = $('#ProsesCariPasien').serialize();
        $('#MenampilkanTabelPasien').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Transaksi/TabelPasien.php',
            data        : ProsesCariPasien,
            success     : function(data){
                $('#MenampilkanTabelPasien').html(data);
            }
        });
    });
    //Ketika JumlahDataPasien pasien di ubah
    $('#JumlahDataPasien').change(function(){
        var ProsesCariPasien = $('#ProsesCariPasien').serialize();
        $('#MenampilkanTabelPasien').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Transaksi/TabelPasien.php',
            data        : ProsesCariPasien,
            success     : function(data){
                $('#MenampilkanTabelPasien').html(data);
            }
        });
    });
});
//Modal Pilih Kunjungan
$('#ModalPilihKunjungan').on('show.bs.modal', function (e) {
    var id_pasien = $(e.relatedTarget).data('id');
    $('#MenampilkanTabelKunjungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelKunjungan.php',
        data        : {id_pasien: id_pasien},
        success     : function(data){
            $('#MenampilkanTabelKunjungan').html(data);
        }
    });
});
//ModalPilihKunjunganPasien
$('#ModalPilihKunjunganPasien').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_kunjungan = pecah[0];
    var id_pasien = pecah[1];
    $('#MenampilkanKonfirmasiKunjunganPasien').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/MenampilkanKonfirmasiKunjunganPasien.php',
        data        : {id_kunjungan: id_kunjungan, id_pasien: id_pasien},
        success     : function(data){
            $('#MenampilkanKonfirmasiKunjunganPasien').html(data);
            //Ketika data pasien di konfirmasi
            $('#KonfirmasiPilihPasienPut').click(function(){
                //Tempelkan pada form
                $('#PutIdPasien').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/PutIdPasien.php',
                    data        : {GetIdPasien: id_pasien},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#PutIdPasien').html(data);
                    }
                });
                $('#PutIdKunjungan').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/PutIdKunjungan.php',
                    data        : {GetKunjunganPasien: id_kunjungan},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#PutIdKunjungan').html(data);
                    }
                });
                $('#ModalPilihKunjunganPasien').modal('hide');
            });
        }
    });
});
//Tambah Rincian
$('#ModalTambahRincian').on('show.bs.modal', function (e) {
    var GetIdTransaksi = $(e.relatedTarget).data('id');
    var PencarianRincian = $('#PencarianRincian').val();
    var KategoriPencarian = $('#KategoriPencarian').val();
    var JumlahData = $('#JumlahData').val();
    var GetIdMitra = $('#GetIdMitra').val();
    $('#MenampilkanTabelBarangTindakan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/TabelBarangTindakan.php',
        data        : {PencarianRincian: PencarianRincian, KategoriPencarian: KategoriPencarian, JumlahData: JumlahData, id_mitra: GetIdMitra, id_transaksi: GetIdTransaksi},
        success     : function(data){
            $('#MenampilkanTabelBarangTindakan').html(data);
            //Ketika Kategori Pencarian Berubah
            $('#KategoriPencarian').change(function(){
                var PencarianRincian = $('#PencarianRincian').val();
                var KategoriPencarian = $('#KategoriPencarian').val();
                var JumlahData = $('#JumlahData').val();
                $('#MenampilkanTabelBarangTindakan').html("Loading...");
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/TabelBarangTindakan.php',
                    data        : {PencarianRincian: PencarianRincian, KategoriPencarian: KategoriPencarian, JumlahData: JumlahData, id_mitra: GetIdMitra},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#MenampilkanTabelBarangTindakan').html(data);
                    }
                });
            });
            //Jumlah Data Berubah
            $('#JumlahData').change(function(){
                var PencarianRincian = $('#PencarianRincian').val();
                var KategoriPencarian = $('#KategoriPencarian').val();
                var JumlahData = $('#JumlahData').val();
                $('#MenampilkanTabelBarangTindakan').html("Loading...");
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/TabelBarangTindakan.php',
                    data        : {PencarianRincian: PencarianRincian, KategoriPencarian: KategoriPencarian, JumlahData: JumlahData, id_mitra: GetIdMitra},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#MenampilkanTabelBarangTindakan').html(data);
                    }
                });
            });
            //ClickPencarian di click
            $('#ClickPencarian').click(function(){
                var PencarianRincian = $('#PencarianRincian').val();
                var KategoriPencarian = $('#KategoriPencarian').val();
                var JumlahData = $('#JumlahData').val();
                $('#MenampilkanTabelBarangTindakan').html("Loading...");
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/TabelBarangTindakan.php',
                    data        : {PencarianRincian: PencarianRincian, KategoriPencarian: KategoriPencarian, JumlahData: JumlahData, id_mitra: GetIdMitra},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#MenampilkanTabelBarangTindakan').html(data);
                    }
                });
            });
        }
    });
});
$('#ModalTambahRincianBarang').on('show.bs.modal', function (e) {
    var id_barang = $(e.relatedTarget).data('id');
    var GetIdMitra = $('#GetIdMitra').val();
    var GetIdTransaksi = $('#GetIdTransaksi2').val();
    var GetTanggal = $('#tanggal').val();
    var GetKategori = $('#kategori').val();
    var GetSupplier = $('#PilihSupplier').val();
    var GetIdPasien = $('#id_pasien').val();
    var GetIdKunjungan = $('#id_kunjungan').val();
    var GetKeterangan = $('#keterangan').val();
    var GetMetode = $('#metode').val();
    var GetStatus = $('#status').val();
    var GetPembayaran = $('#pembayaran').val();
    $('#FormTambahRincianBarang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormTambahRincianBarang.php',
        data        : {
            id_barang: id_barang, 
            id_mitra: GetIdMitra, 
            tanggal: GetTanggal, 
            kategori: GetKategori, 
            supplier: GetSupplier, 
            pasien: GetIdPasien, 
            kunjungan: GetIdKunjungan, 
            metode: GetMetode,
            status: GetStatus,
            keterangan: GetKeterangan,
            pembayaran: GetPembayaran,
            GetIdTransaksi: GetIdTransaksi
        },
        success     : function(data){
            $('#FormTambahRincianBarang').html(data);
            //Ketika Qty di Keyup
            $('#qty_rincian').keyup(function(){
                var qty_rincian = $('#qty_rincian').val();
                var harga_rincian = $('#harga_rincian').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian').val(jumlah_rincian);
            });
            $('#rincian_satuan_barang').change(function(){
                var id_barang = $('#id_barang').val();
                var rincian_satuan_barang = $('#rincian_satuan_barang').val();
                var id_barang_harga = $('#id_barang_harga').val();
                var qty_rincian = $('#qty_rincian').val();
                var harga_rincian = $('#harga_rincian').val();
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesCariHargaBarang.php',
                    data 	    :  {id_barang: id_barang, rincian_satuan_barang: rincian_satuan_barang, id_barang_harga: id_barang_harga, qty_rincian: qty_rincian, harga_rincian: harga_rincian},
                    success     : function(data){
                        $('#harga_rincian').val(data);
                        $('#jumlah_rincian').val('Loading...');
                        var qty_rincian2 = $('#qty_rincian').val();
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/Transaksi/HitungJumlahRincian.php',
                            data 	    :  {harga_rincian2: data, qty_rincian2: qty_rincian2, qty_rincian: qty_rincian},
                            success     : function(data){
                                $('#jumlah_rincian').val(data);
                            }
                        });
                    }
                });
                $('#FormKategoriHarga').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/FormKategoriHarga.php',
                    data 	    :  {id_barang: id_barang, rincian_satuan_barang: rincian_satuan_barang},
                    success     : function(data){
                        $('#FormKategoriHarga').html(data);
                    }
                });
            });
            $('#harga_rincian').keyup(function(){
                var qty_rincian = $('#qty_rincian').val();
                var harga_rincian = $('#harga_rincian').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian').val(jumlah_rincian);
            });
            //Proses Tambah Rincian Transaksi
            $('#ProsesTambahRincianBarang').submit(function(){
                $('#NotifikasiTambahRincianBarang').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRincianBarang')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesTambahRincianBarang.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahRincianBarang').html(data);
                        var NotifikasiTambahRincianBarangBerhasil=$('#NotifikasiTambahRincianBarangBerhasil').html();
                        if(NotifikasiTambahRincianBarangBerhasil=="Success"){
                            var UrlBack=$('#UrlBack').val();
                            text = UrlBack.replace('amp;', "");
                            text = UrlBack.replace('amp;', "");
                            window.location.href = UrlBack;
                        }
                    }
                });
            });
        }
    });
});
$('#ModalTambahRincianTindakan').on('show.bs.modal', function (e) {
    var id_mitra_tindakan = $(e.relatedTarget).data('id');
    var GetIdMitra = $('#GetIdMitra').val();
    var GetIdTransaksi = $('#GetIdTransaksi2').val();
    var GetTanggal = $('#tanggal').val();
    var GetKategori = $('#kategori').val();
    var GetSupplier = $('#PilihSupplier').val();
    var GetIdPasien = $('#id_pasien').val();
    var GetIdKunjungan = $('#id_kunjungan').val();
    var GetKeterangan = $('#keterangan').val();
    var GetMetode = $('#metode').val();
    var GetStatus = $('#status').val();
    var GetPembayaran = $('#pembayaran').val();
    $('#FormTambahRincianTindakan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormTambahRincianTindakan.php',
        data        : {
            id_mitra_tindakan: id_mitra_tindakan, 
            id_mitra: GetIdMitra, 
            id_transaksi: GetIdTransaksi,
            tanggal: GetTanggal, 
            kategori: GetKategori, 
            supplier: GetSupplier, 
            pasien: GetIdPasien, 
            kunjungan: GetIdKunjungan, 
            metode: GetMetode,
            status: GetStatus,
            keterangan: GetKeterangan,
            pembayaran: GetPembayaran
        },
        success     : function(data){
            $('#FormTambahRincianTindakan').html(data);
            //Ketika Qty di Keyup
            $('#qty_rincian2').keyup(function(){
                var qty_rincian = $('#qty_rincian2').val();
                var harga_rincian = $('#harga_rincian2').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian2').val(jumlah_rincian);
            });
            $('#harga_rincian2').keyup(function(){
                var qty_rincian = $('#qty_rincian2').val();
                var harga_rincian = $('#harga_rincian2').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian2').val(jumlah_rincian);
            });
            //Proses Tambah Rincian Transaksi
            $('#ProsesTambahRincianTindakan').submit(function(){
                $('#NotifikasiTambahRincianTindakan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRincianTindakan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesTambahRincianTindakan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahRincianTindakan').html(data);
                        var NotifikasiTambahRincianTindakanBerhasil=$('#NotifikasiTambahRincianTindakanBerhasil').html();
                        if(NotifikasiTambahRincianTindakanBerhasil=="Success"){
                            var UrlBack=$('#UrlBack').val();
                            text = UrlBack.replace('amp;', "");
                            text = UrlBack.replace('amp;', "");
                            window.location.href = UrlBack;
                        }
                    }
                });
            });
        }
    });
});
//Edit Rincian Barang
$('#ModalEditRincianBarang').on('show.bs.modal', function (e) {
    var id_transaksi_rincian = $(e.relatedTarget).data('id');
    var GetIdMitra = $('#GetIdMitra').val();
    var GetIdTransaksi = $('#GetIdTransaksi2').val();
    $('#FormEditRincianBarang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormEditRincianBarang.php',
        data        : {id_transaksi_rincian: id_transaksi_rincian, id_mitra: GetIdMitra, GetIdTransaksi: GetIdTransaksi},
        success     : function(data){
            $('#FormEditRincianBarang').html(data);
            //Ketika Qty di Keyup
            $('#qty_rincian').keyup(function(){
                var qty_rincian = $('#qty_rincian').val();
                var harga_rincian = $('#harga_rincian').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian').val(jumlah_rincian);
            });
            $('#rincian_satuan_barang').change(function(){
                var id_barang = $('#id_barang').val();
                var rincian_satuan_barang = $('#rincian_satuan_barang').val();
                var id_barang_harga = $('#id_barang_harga').val();
                var qty_rincian = $('#qty_rincian').val();
                var harga_rincian = $('#harga_rincian').val();
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesCariHargaBarang.php',
                    data 	    :  {id_barang: id_barang, rincian_satuan_barang: rincian_satuan_barang, id_barang_harga: id_barang_harga, qty_rincian: qty_rincian, harga_rincian: harga_rincian},
                    success     : function(data){
                        $('#harga_rincian').val(data);
                        $('#jumlah_rincian').val('Loading...');
                        var qty_rincian2 = $('#qty_rincian').val();
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/Transaksi/HitungJumlahRincian.php',
                            data 	    :  {harga_rincian2: data, qty_rincian2: qty_rincian2, qty_rincian: qty_rincian},
                            success     : function(data){
                                $('#jumlah_rincian').val(data);
                            }
                        });
                    }
                });
                $('#FormKategoriHarga').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/FormKategoriHarga.php',
                    data 	    :  {id_barang: id_barang, rincian_satuan_barang: rincian_satuan_barang},
                    success     : function(data){
                        $('#FormKategoriHarga').html(data);
                    }
                });
            });
            $('#harga_rincian').keyup(function(){
                var qty_rincian = $('#qty_rincian').val();
                var harga_rincian = $('#harga_rincian').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian').val(jumlah_rincian);
            });
            //Proses Edit Rincian Transaksi
            $('#ProsesEditRincianBarang').submit(function(){
                $('#NotifikasiEditRincianBarang').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditRincianBarang')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesEditRincianBarang.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditRincianBarang').html(data);
                        var NotifikasiEditRincianBarangBerhasil=$('#NotifikasiEditRincianBarangBerhasil').html();
                        if(NotifikasiEditRincianBarangBerhasil=="Success"){
                            if(GetIdTransaksi==""){
                                $('#ModalEditRincianBarang').modal('toggle');
                                $('#MenampilkanTabelRincian').html('Loading...');
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Transaksi/TabelRincian.php',
                                    data 	    :  {id_mitra: GetIdMitra},
                                    success     : function(data){
                                        $('#MenampilkanTabelRincian').html(data);
                                    }
                                });
                                $('#jumlah_transaksi').val("Loading...");
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
                                    data 	    :  {id_mitra: GetIdMitra},
                                    success     : function(data){
                                        $('#jumlah_transaksi').val(data);
                                    }
                                });
                                swal("Good Job!", "Edit Rincian Barang Berhasil!", "success");
                            }else{
                                location.reload();
                            }
                        }
                    }
                });
            });
        }
    });
});

//Modal Edit Rincian Tindakan
$('#ModalEditRincianTindakan').on('show.bs.modal', function (e) {
    var id_transaksi_rincian = $(e.relatedTarget).data('id');
    var GetIdMitra = $('#GetIdMitra').val();
    var GetIdTransaksi = $('#GetIdTransaksi2').val();
    $('#FormEditRincianTindakan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormEditRincianTindakan.php',
        data        : {id_transaksi_rincian: id_transaksi_rincian, id_mitra: GetIdMitra, GetIdTransaksi: GetIdTransaksi},
        success     : function(data){
            $('#FormEditRincianTindakan').html(data);
            //Ketika Qty di Keyup
            $('#qty_rincian4').keyup(function(){
                var qty_rincian = $('#qty_rincian4').val();
                var harga_rincian = $('#harga_rincian4').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian4').val(jumlah_rincian);
            });
            $('#harga_rincian4').keyup(function(){
                var qty_rincian = $('#qty_rincian4').val();
                var harga_rincian = $('#harga_rincian4').val();
                var jumlah_rincian=qty_rincian*harga_rincian;
                $('#jumlah_rincian4').val(jumlah_rincian);
            });
            //Proses Edit Rincian Transaksi
            $('#ProsesEditRincianTindakan').submit(function(){
                $('#NotifikasiEditRincianTindakan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditRincianTindakan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesEditRincianTindakan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditRincianTindakan').html(data);
                        var NotifikasiEditRincianTindakanBerhasil=$('#NotifikasiEditRincianTindakanBerhasil').html();
                        if(NotifikasiEditRincianTindakanBerhasil=="Success"){
                            if(GetIdTransaksi==""){
                                $('#ModalEditRincianTindakan').modal('toggle');
                                $('#MenampilkanTabelRincian').html("Loading...");
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Transaksi/TabelRincian.php',
                                    data 	    :  {id_mitra: GetIdMitra},
                                    success     : function(data){
                                        $('#MenampilkanTabelRincian').html(data);
                                        $.ajax({
                                            type 	    : 'POST',
                                            url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
                                            data 	    :  {id_mitra: GetIdMitra},
                                            success     : function(data){
                                                $('#jumlah_transaksi').val(data);
                                            }
                                        });
                                        swal("Good Job!", "Edit Rincian Tindakan Berhasil!", "success");
                                    }
                                });
                            }else{
                                location.reload();
                            }
                        }
                    }
                });
            });
        }
    });
});
$('#ModalDeleteTransaksiRincian').on('show.bs.modal', function (e) {
    var id_transaksi_rincian = $(e.relatedTarget).data('id');
    var GetIdMitra2 = $('#GetIdMitra').val();
    var GetIdTransaksi = $('#GetIdTransaksi2').val();
    $('#FormDeleteRincian').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormDeleteRincian.php',
        data        : {id_transaksi_rincian: id_transaksi_rincian, GetIdTransaksi: GetIdTransaksi},
        success     : function(data){
            $('#FormDeleteRincian').html(data);
            //Konfirmasi Hapus Rincian Transaksi
            $('#KonfirmasiHapusRincian').click(function(){
                $('#NotifikasiHapusRincian').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesHapusRincianTindakan.php',
                    data        : {id_transaksi_rincian: id_transaksi_rincian, GetIdTransaksi: GetIdTransaksi},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiHapusRincian').html(data);
                        var NotifikasiHapusRincianBerhasil=$('#NotifikasiHapusRincianBerhasil').html();
                        if(NotifikasiHapusRincianBerhasil=="Success"){
                            if(GetIdTransaksi==""){
                                $('#ModalDeleteTransaksiRincian').modal('toggle');
                                $('#MenampilkanTabelRincian').html("Loading...");
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Transaksi/TabelRincian.php',
                                    data 	    :  {id_mitra: GetIdMitra2},
                                    success     : function(data){
                                        $('#MenampilkanTabelRincian').html(data);
                                        $.ajax({
                                            type 	    : 'POST',
                                            url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
                                            data 	    :  {id_mitra: GetIdMitra2},
                                            success     : function(data){
                                                $('#jumlah_transaksi').val(data);
                                            }
                                        });
                                        swal("Good Job!", "Hapus Rincian Tindakan Berhasil!", "success");
                                    }
                                });
                            }else{
                                location.reload();
                            }
                            
                        }
                    }
                });
            });
        }
    });
});
//Proses Tambah Transaksi
$('#ProsesTambahTransaksi').submit(function(){
    $('#NotifikasiTambahTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahTransaksi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesTambahTransaksi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahTransaksi').html(data);
            var NotifikasiTambahTransaksiBerhasil=$('#NotifikasiTambahTransaksiBerhasil').html();
            if(NotifikasiTambahTransaksiBerhasil=="Success"){
                window.location.href = "index.php?Page=Transaksi";
            }
        }
    });
});
//Proses Edit Transaksi
$('#ProsesEditTransaksi').submit(function(){
    $('#NotifikasiEditTransaksi').html('<div class="alert alert-info text-center" role="alert"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div>');
    var form = $('#ProsesEditTransaksi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesEditTransaksi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditTransaksi').html(data);
            var NotifikasiEditTransaksiBerhasil=$('#NotifikasiEditTransaksiBerhasil').html();
            if(NotifikasiEditTransaksiBerhasil=="Success"){
                var UrlBack=$('#UrlBack').val();
                text = UrlBack.replace('amp;', "");
                text = UrlBack.replace('amp;', "");
                window.location.href = UrlBack;
            }
        }
    });
});

//Detail Transaksi
$('#ModalDetailTransaksi').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_transaksi = pecah[0];
    $('#FormDetailTransaksi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormDetailTransaksi.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormDetailTransaksi').html(data);
        }
    });
});
//Hapus Transaksi
$('#ModalDeleteTransaksi').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_transaksi = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var keyword_by = pecah[6];
    $('#FormDeleteTransaksi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormDeleteTransaksi.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormDeleteTransaksi').html(data);
            //Ketika Konfirmasi Hapus Transaksi Di Click
            $('#KonfirmasiHapusTransaksi').click(function(){
                $('#NotifikasiHapusTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesHapusTransaksi.php',
                    data        : {id_transaksi: id_transaksi},
                    success     : function(data){
                        $('#NotifikasiHapusTransaksi').html(data);
                        var NotifikasiHapusTransaksiBerhasil=$('#NotifikasiHapusTransaksiBerhasil').html();
                        if(NotifikasiHapusTransaksiBerhasil=="Success"){
                            $('#MenampilkanTabelTransaksi').html('Loading...');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TabelTransaksi.php',
                                data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: keyword_by, keyword: keyword},
                                success     : function(data){
                                    $('#MenampilkanTabelTransaksi').html(data);
                                    swal("Good Job!", "Hapus Transaksi Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Batalkan Transaksi
$('#ModalBatalkanTransaksi').on('show.bs.modal', function (e) {
    var GetIdMitra2 = $('#GetIdMitra').val();
    $('#FormBatalkanTransaksi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormBatalkanTransaksi.php',
        success     : function(data){
            $('#FormBatalkanTransaksi').html(data);
            //Ketika Konfirmasi Batalkan Transaksi Di Click
            $('#KonfirmasiBatalkanTransaksi').click(function(){
                $('#NotifikasiBatalkanTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesBatalkanTransaksi.php',
                    data        : {id_mitra: GetIdMitra2},
                    success     : function(data){
                        $('#NotifikasiBatalkanTransaksi').html(data);
                        var NotifikasiBatalkanTransaksiBerhasil=$('#NotifikasiBatalkanTransaksiBerhasil').html();
                        if(NotifikasiBatalkanTransaksiBerhasil=="Success"){
                            $('#ModalBatalkanTransaksi').modal('toggle');
                            $('#MenampilkanTabelRincian').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TabelRincian.php',
                                data 	    :  {id_mitra: GetIdMitra2},
                                success     : function(data){
                                    $('#MenampilkanTabelRincian').html(data);
                                    $.ajax({
                                        type 	    : 'POST',
                                        url 	    : '_Page/Transaksi/HitungJumlahRincian2.php',
                                        data 	    :  {id_mitra: GetIdMitra2},
                                        success     : function(data){
                                            $('#jumlah_transaksi').val(data);
                                        }
                                    });
                                    swal("Good Job!", "Hapus Rincian Tindakan Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
var GetIdTransaksi=$('#GetIdTransaksi').html();
$('#MenampilkanTabelJurnal').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Transaksi/TabelJurnal.php',
    data        : {id_transaksi: GetIdTransaksi},
    success     : function(data){
        $('#MenampilkanTabelJurnal').html(data);
    }
});
$('#MenampilkanTabelPembayaran').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Transaksi/TabelPembayaran.php',
    data        : {id_transaksi: GetIdTransaksi},
    success     : function(data){
        $('#MenampilkanTabelPembayaran').html(data);
    }
});
//Tambah Jurnal
$('#ModalTambahJurnal').on('show.bs.modal', function (e) {
    var id_transaksi = $(e.relatedTarget).data('id');
    $('#FormTambahJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Jurnal/FormTambahJurnal.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormTambahJurnal').html(data);
            //Proses Tambah Jurnal
            $('#ProsesTambahJurnal').submit(function(){
                $('#NotifikasiTambahJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahJurnal')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Jurnal/ProsesTambahJurnal.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahJurnal').html(data);
                        var NotifikasiTambahJurnalBerhasil=$('#NotifikasiTambahJurnalBerhasil').html();
                        if(NotifikasiTambahJurnalBerhasil=="Success"){
                            $('#ModalTambahJurnal').modal('toggle');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TabelJurnal.php',
                                data        : {id_transaksi: id_transaksi},
                                success     : function(data){
                                    $('#MenampilkanTabelJurnal').html(data);
                                    swal("Good Job!", "Tambah Jurnal Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Detail Akun Perkiraan
$('#ModalDetailJurnal').on('show.bs.modal', function (e) {
    var id_jurnal = $(e.relatedTarget).data('id');
    $('#FormDetailJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Jurnal/FormDetailJurnal.php',
        data        : {id_jurnal: id_jurnal},
        success     : function(data){
            $('#FormDetailJurnal').html(data);
        }
    });
    //Edit Jurnal
    $('#ModalEditJurnal').on('show.bs.modal', function (e) {
        $('#FormEditJurnal').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Jurnal/FormEditJurnal.php',
            data        : {id_jurnal: id_jurnal},
            success     : function(data){
                $('#FormEditJurnal').html(data);
                //Proses Edit Akun perkiraan
                $('#ProsesEditJurnal').submit(function(){
                    $('#NotifikasiEditJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                    var form = $('#ProsesEditJurnal')[0];
                    var data = new FormData(form);
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Jurnal/ProsesEditJurnal.php',
                        data 	    :  data,
                        cache       : false,
                        processData : false,
                        contentType : false,
                        enctype     : 'multipart/form-data',
                        success     : function(data){
                            $('#NotifikasiEditJurnal').html(data);
                            var NotifikasiEditJurnalBerhasil=$('#NotifikasiEditJurnalBerhasil').html();
                            if(NotifikasiEditJurnalBerhasil=="Success"){
                                $('#ModalEditJurnal').modal('toggle');
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Transaksi/TabelJurnal.php',
                                    data        : {id_transaksi: GetIdTransaksi},
                                    success     : function(data){
                                        $('#MenampilkanTabelJurnal').html(data);
                                        swal("Good Job!", "Tambah Jurnal Berhasil!", "success");
                                    }
                                });
                            }
                        }
                    });
                });
            }
        });
    });
    //Hapus Jurnal
    $('#ModalHapusJurnal').on('show.bs.modal', function (e) {
        $('#FormhapusJurnal').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Jurnal/FormhapusJurnal.php',
            data        : {id_jurnal: id_jurnal},
            success     : function(data){
                $('#FormhapusJurnal').html(data);
                //Konfirmasi Hapus Jurnal
                $('#KonfirmasiHapusJurnal').click(function(){
                    $('#NotifikasiHapusJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Jurnal/ProsesHapusJurnal.php',
                        data        : {id_jurnal: id_jurnal},
                        success     : function(data){
                            $('#NotifikasiHapusJurnal').html(data);
                            var NotifikasiHapusJurnalBerhasil=$('#NotifikasiHapusJurnalBerhasil').html();
                            if(NotifikasiHapusJurnalBerhasil=="Success"){
                                $('#ModalHapusJurnal').modal('toggle');
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Transaksi/TabelJurnal.php',
                                    data        : {id_transaksi: GetIdTransaksi},
                                    success     : function(data){
                                        $('#MenampilkanTabelJurnal').html(data);
                                        swal("Good Job!", "Hapus Jurnal Berhasil!", "success");
                                    }
                                });
                            }
                        }
                    });
                });
            }
        });
    });
});
//Edit Transaksi
$('#ModalEditTransaksi').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_transaksi = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditTransaksi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormEditTransaksi.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormEditTransaksi').html(data);
            //Kondisi id_mitra dipilih
            $('#id_mitra_edit').change(function(){
                var id_mitra_edit = $('#id_mitra_edit').val();
                if(id_mitra_edit==""){
                    $('#Transaksi_edit').html('<option value="Admin">Admin</option><option value="">More Access Groups</option>');
                }else{
                    $("#grup_Transaksi_edit").val("");
                    $("#grup_Transaksi_edit").prop("disabled", true);
                    $('#Transaksi_edit').load('_Page/Transaksi/PilihTransaksiMitra.php');
                }
            });
            //Kondisi ketika Transaksi dipilih
            $('#Transaksi_edit').change(function(){
                var Transaksi_edit = $('#Transaksi_edit').val();
                if(Transaksi_edit==""){
                    $("#grup_Transaksi_edit").prop("disabled", false);
                }else{
                    $("#grup_Transaksi_edit").prop("disabled", true);
                }
            });
            //Proses Tambah Transaksi
            $('#ProsesEditTransaksi').submit(function(){
                $('#NotifikasiEditTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditTransaksi')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesEditTransaksi.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditTransaksi').html(data);
                        var NotifikasiEditTransaksiBerhasil=$('#NotifikasiEditTransaksiBerhasil').html();
                        if(NotifikasiEditTransaksiBerhasil=="Success"){
                            $('#MenampilkanTabelTransaksi').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TabelTransaksi.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelTransaksi').html(data);
                                    $('#ModalEditTransaksi').modal('hide');
                                    swal("Good Job!", "Edit Access Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus Transaksi
$('#ModalDeleteTransaksi').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_transaksi = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeleteTransaksi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormDeleteTransaksi.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormDeleteTransaksi').html(data);
            //Konfirmasi Hapus Transaksi
            $('#KonfirmasiHapusTransaksi').click(function(){
                $('#NotifikasiHapusTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesHapusTransaksi.php',
                    data        : {id_transaksi: id_transaksi},
                    success     : function(data){
                        $('#NotifikasiHapusTransaksi').html(data);
                        var NotifikasiHapusTransaksiBerhasil=$('#NotifikasiHapusTransaksiBerhasil').html();
                        if(NotifikasiHapusTransaksiBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TabelTransaksi.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelTransaksi').html(data);
                                    $('#ModalDeleteTransaksi').modal('hide');
                                    swal("Good Job!", "Delete Access Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Menampilkan Tombol Auto Jurnal
$('#TombolAutoJurnal').html("Loading...");
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Transaksi/TombolAutoJurnal.php',
    success     : function(data){
        $('#TombolAutoJurnal').html(data);
    }
});
//Form Setting Auto Jurnal
$('#ModalSettingAutoJurnal').on('show.bs.modal', function (e) {
    $('#FormSettingAutoJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormSettingAutoJurnal.php',
        success     : function(data){
            $('#FormSettingAutoJurnal').html(data);
            //Proses Setting Auto Jurnal Di Submit
            $('#ProsesSettingAutoJurnal').submit(function(){
                $('#NotifikasiSettingAutoJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesSettingAutoJurnal')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesSettingAutoJurnal.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiSettingAutoJurnal').html(data);
                        var NotifikasiSettingAutoJurnalBerhasil=$('#NotifikasiSettingAutoJurnalBerhasil').html();
                        if(NotifikasiSettingAutoJurnalBerhasil=="Success"){
                            $('#TombolAutoJurnal').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TombolAutoJurnal.php',
                                success     : function(data){
                                    $('#TombolAutoJurnal').html(data);
                                    $('#ModalSettingAutoJurnal').modal('hide');
                                    $('#TombolAutoJurnal').html("Loading...");
                                    $.ajax({
                                        type 	    : 'POST',
                                        url 	    : '_Page/Transaksi/TombolAutoJurnal.php',
                                        success     : function(data){
                                            $('#TombolAutoJurnal').html(data);
                                        }
                                    });
                                    swal("Good Job!", "Setting Auto Jurnal Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Modal Reset Setting Auto Jurnal
$('#ModalResetSettingAutoJurnal').on('show.bs.modal', function (e) {
    $('#FormResetSettingAutoJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormResetSettingAutoJurnal.php',
        success     : function(data){
            $('#FormResetSettingAutoJurnal').html(data);
            $('#KonfirmasiResetAutoJurnal').click(function(){
                $('#NotifikasiResetAutoJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Transaksi/ProsesResetAutoJurnal.php',
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiResetAutoJurnal').html(data);
                        var NotifikasiResetAutoJurnalBerhasil=$('#NotifikasiResetAutoJurnalBerhasil').html();
                        if(NotifikasiResetAutoJurnalBerhasil=="Success"){
                            $('#TombolAutoJurnal').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Transaksi/TombolAutoJurnal.php',
                                success     : function(data){
                                    $('#TombolAutoJurnal').html(data);
                                    $('#ModalResetSettingAutoJurnal').modal('hide');
                                    $('#TombolAutoJurnal').html("Loading...");
                                    $.ajax({
                                        type 	    : 'POST',
                                        url 	    : '_Page/Transaksi/TombolAutoJurnal.php',
                                        success     : function(data){
                                            $('#TombolAutoJurnal').html(data);
                                        }
                                    });
                                    swal("Good Job!", "Reset Setting Auto Jurnal Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
            
        }
    });
});