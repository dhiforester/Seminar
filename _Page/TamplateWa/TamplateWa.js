$('#MenampilkanTabelPartnership').html("Loading...");
$('#MenampilkanTabelPartnership').load("_Page/TamplateWa/TabelPartnership.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelPartnership').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/TamplateWa/TabelPartnership.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelPartnership').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelPartnership').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/TamplateWa/TabelPartnership.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelPartnership').html(data);
        }
    });
});
$('#ProsesSimpanTamplate').submit(function(){
    var ProsesSimpanTamplate = $('#ProsesSimpanTamplate').serialize();
    $('#NotifikasiTamplateWa').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/TamplateWa/ProsesSimpanTamplate.php',
        data 	    :  ProsesSimpanTamplate,
        success     : function(data){
            $('#NotifikasiTamplateWa').html(data);
            var NotifikasiTamplateWaBerhasil=$('#NotifikasiTamplateWaBerhasil').html();
            if(NotifikasiTamplateWaBerhasil=="Success"){
                window.location.href = "index.php?Page=TamplateWa";
            }
        }
    });
});
