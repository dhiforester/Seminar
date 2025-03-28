$('#MenampilkanTabelAktivitasUmum').html("Loading...");
$('#MenampilkanTabelAktivitasUmum').load("_Page/Aktivitas/TabelAktivitasUmum.php");
$('#BatasAktivitasUmum').change(function(){
    var BatasAktivitasUmum = $('#BatasAktivitasUmum').serialize();
    $('#MenampilkanTabelAktivitasUmum').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasUmum.php',
        data 	    :  BatasAktivitasUmum,
        success     : function(data){
            $('#MenampilkanTabelAktivitasUmum').html(data);
        }
    });
});
$('#ProsesBatasAktivitasUmum').submit(function(){
    var ProsesBatasAktivitasUmum = $('#ProsesBatasAktivitasUmum').serialize();
    $('#MenampilkanTabelAktivitasUmum').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasUmum.php',
        data 	    :  ProsesBatasAktivitasUmum,
        success     : function(data){
            $('#MenampilkanTabelAktivitasUmum').html(data);
        }
    });
});
$('#ProsesFilterAktivitasUmum').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelAktivitasUmum').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasUmum.php',
        data 	    :  {BatasAktivitasUmum: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, KeywordAktivitasUmum: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelAktivitasUmum').html(data);
            $('#ModalFilterAkses').modal('hide');
        }
    });
});

$('#MenampilkanTabelAktivitasEmail').html("Loading...");
$('#MenampilkanTabelAktivitasEmail').load("_Page/Aktivitas/TabelAktivitasEmail.php");
$('#BatasAktivitasEmail').change(function(){
    var BatasAktivitasEmail = $('#BatasAktivitasEmail').serialize();
    $('#MenampilkanTabelAktivitasEmail').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasEmail.php',
        data 	    :  BatasAktivitasEmail,
        success     : function(data){
            $('#MenampilkanTabelAktivitasEmail').html(data);
        }
    });
});
$('#ProsesBatasAktivitasEmail').submit(function(){
    var ProsesBatasAktivitasEmail = $('#ProsesBatasAktivitasEmail').serialize();
    $('#MenampilkanTabelAktivitasEmail').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasEmail.php',
        data 	    :  ProsesBatasAktivitasEmail,
        success     : function(data){
            $('#MenampilkanTabelAktivitasEmail').html(data);
        }
    });
});
$('#ModalFilterAktivitasEmail').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelAktivitasEmail').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasEmail.php',
        data 	    :  {BatasAktivitasEmail: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, KeywordAktivitasEmail: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelAktivitasEmail').html(data);
            $('#ModalFilterAkses').modal('hide');
        }
    });
});

$('#MenampilkanTabelAktivitasApis').html("Loading...");
$('#MenampilkanTabelAktivitasApis').load("_Page/Aktivitas/TabelAktivitasApis.php");
$('#BatasAktivitasApis').change(function(){
    var BatasAktivitasApis = $('#BatasAktivitasApis').serialize();
    $('#MenampilkanTabelAktivitasApis').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasApis.php',
        data 	    :  BatasAktivitasApis,
        success     : function(data){
            $('#MenampilkanTabelAktivitasApis').html(data);
        }
    });
});
$('#ProsesBatasAktivitasApis').submit(function(){
    var ProsesBatasAktivitasApis = $('#ProsesBatasAktivitasApis').serialize();
    $('#MenampilkanTabelAktivitasApis').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasApis.php',
        data 	    :  ProsesBatasAktivitasApis,
        success     : function(data){
            $('#MenampilkanTabelAktivitasApis').html(data);
        }
    });
});
$('#ProsesFilterAktivitasApis').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelAktivitasApis').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasApis.php',
        data 	    :  {BatasAktivitasApis: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, KeywordAktivitasApis: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelAktivitasApis').html(data);
            $('#ModalFilterAkses').modal('hide');
        }
    });
});

$('#MenampilkanTabelAktivitasPayment').html("Loading...");
var ProsesBatasAktivitasPayment = $('#ProsesBatasAktivitasPayment').serialize();
$('#MenampilkanTabelAktivitasPayment').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Aktivitas/TabelAktivitasPayment.php',
    data 	    :  ProsesBatasAktivitasPayment,
    success     : function(data){
        $('#MenampilkanTabelAktivitasPayment').html(data);
    }
});
$('#ProsesBatasAktivitasPayment').submit(function(){
    var ProsesBatasAktivitasPayment = $('#ProsesBatasAktivitasPayment').serialize();
    $('#MenampilkanTabelAktivitasPayment').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Aktivitas/TabelAktivitasPayment.php',
        data 	    :  ProsesBatasAktivitasPayment,
        success     : function(data){
            $('#MenampilkanTabelAktivitasPayment').html(data);
        }
    });
});
//Ketika dasar pencarian diganti
$('#DasarPencarianPayment').change(function(){
    $('#KeywordFormTransaksi').html('Loading...');
    var DasarPencarian = $('#DasarPencarianPayment').val();
    if(DasarPencarian=="Tanggal"){
        $('#KeywordFormTransaksi').html('<input type="date" name="KeywordAktivitasPayment" id="KeywordAktivitasPayment" class="form-control"><small>Pencarian</small>');
    }
    if(DasarPencarian=="Kode Transaksi"){
        $('#KeywordFormTransaksi').html('<input type="text" name="KeywordAktivitasPayment" id="KeywordAktivitasPayment" class="form-control"><small>Pencarian</small>');
    }
});