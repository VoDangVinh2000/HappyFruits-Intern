/* 21-01-2016 nth */

window.handleSelectedImage = function(imageUrl, imageID){
    $('#image').val(imageUrl);
    $('#image').trigger('change');
}
$(document).ready(function(){
    $('#select_image').click(function(e){
        e.preventDefault();
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });
    
    $('#image').change(function(){
        var image_url = $(this).val();
        if (image_url.length)
            $('#preview_image').html('<img src="'+image_url+'" height=100 />');
        else
            $('#preview_image').html('');
    });
    $('#image').trigger('change');
});