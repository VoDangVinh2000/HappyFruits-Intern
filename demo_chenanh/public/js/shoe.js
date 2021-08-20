$(document).ready(function(){
    $('button[name=btnDetail]').each(function(index,element){
        $(this).click(function(){
            let id = $('input[name=idGiayDep]').eq(index).val();
            $.ajax({
                url : 'controllers/getIDGiayDep.php?id=' + id,
                type : 'GET',
                data : id,
                success : function(data){
                    $('#modal-body-detail').append(data);
                }
            });
            $('#modal-body-detail').html("");
        });
    });
});