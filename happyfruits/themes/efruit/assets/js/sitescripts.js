const cartLightBox = document.querySelector('.cart-lightbox');
const cartClose = document.querySelector('.offcanvas-close');
const btnCart = document.querySelectorAll('.btn-cart-nav');
const cartModal = document.querySelector('.cart-modal');
let cartOpen = 0;
//Open
if(btnCart){
btnCart.forEach(e => {
    e.addEventListener ('click', function () {
        cartModal.style.display = "block";
        cartLightBox.classList.remove('animate-fade-out');
        cartLightBox.classList.add('animate-fade-in');
        cartOpen = 1;
    })
})
}


//Close
if(cartLightBox){
cartLightBox.addEventListener ('click', function () {
    cartLightBox.classList.add('animate-fade-out');
    cartLightBox.classList.remove('animate-fade-in');
    cartModal.style.display = "none";
})
}

if(cartClose){
cartClose.addEventListener ('click', function () {
    cartLightBox.classList.add('animate-fade-out');
    cartLightBox.classList.remove('animate-fade-in');
    cartModal.style.display = "none";
})

}

new SimpleLightbox({elements: '.product-gallery a'});

// const cartclose = document.querySelector(".close");
// cartclose.addEventListener('click', function(){
//     cartclose.style.display = "none";
// })