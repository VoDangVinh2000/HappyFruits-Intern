/* 21-01-2016 nth */

window.handleSelectedImage = function(imageUrl, imageID){
    $('#image').val(imageUrl);
    $('#image').trigger('change');
}

window.handleSelectedImage_sub1 = function(imageUrl, imageID){
    $('#image_sub1').val(imageUrl);
    $('#image_sub1').trigger('change');
}

window.handleSelectedImage_sub2 = function(imageUrl, imageID){
    $('#image_sub2').val(imageUrl);
    $('#image_sub2').trigger('change');
}
$(document).ready(function(){
    $('#select_image').click(function(e){
        e.preventDefault();
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });

    $('#select_image_sub1').click(function(e){
        e.preventDefault();
        window.open(base_url + 'quan-ly-anh?type=select_sub1', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });

    $('#select_image_sub2').click(function(e){
        e.preventDefault();
        window.open(base_url + 'quan-ly-anh?type=select_sub2', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });
    
    $('#image').change(function(){
        var image_url = $(this).val();
        if (image_url.length)
            $('#preview_image').html('<img src="'+image_url+'" height=100 />');
        else
            $('#preview_image').html('');
    });
    $('#image').trigger('change');

    $('#image_sub1').change(function(){
        var image_url = $(this).val();
        if (image_url.length)
            $('#preview_image_sub1').html('<img src="'+image_url+'" height=100 />');
        else
            $('#preview_image_sub1').html('');
    });
    $('#image_sub1').trigger('change');

    $('#image_sub2').change(function(){
        var image_url = $(this).val();
        if (image_url.length)
            $('#preview_image_sub2').html('<img src="'+image_url+'" height=100 />');
        else
            $('#preview_image_sub2').html('');
    });
    $('#image_sub2').trigger('change');
});