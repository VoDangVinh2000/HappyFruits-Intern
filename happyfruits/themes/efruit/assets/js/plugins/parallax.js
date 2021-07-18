/**
 * My Parallax v1.0
 *
 */
$(document).ready(function(){
    // cache the window object
    $window = $(window);
    $('div[data-type="background"]').each(function(){
        var self = $(this);
        var image_src = self.attr('data-image');
        self.css('background', 'url('+image_src+') 50% 0 fixed no-repeat');
        self.css('margin', '0 auto');
        self.css('width', '100%');
        self.css('position', 'relative');
        self.css('box-shadow', '0 0 50px rgba(0,0,0,0.8)');
        
        // declare the variable to affect the defined data-type
        var $scroll = $(this);
                     
        $(window).scroll(function() {
            // HTML5 proves useful for helping with creating JS functions!
            // also, negative value because we're scrolling upwards                             
            var yPos = -($window.scrollTop() / $scroll.data('speed')); 
            
            // background position
            var coords = '50% '+ yPos + 'px';
            
            // move the background
            $scroll.css({ backgroundPosition: coords });    
        }); // end window scroll
    });  // end section function
});