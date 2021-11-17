const cartLightBoxs = document.querySelector('.cart-lightbox');
const cartClose = document.querySelector('.close');
const btnCart = document.querySelectorAll('.btn-cart-nav');
const cartModal = document.querySelector('.cart-modal');
let cartOpen = 0;
//Open
if(btnCart){
btnCart.forEach(e => {
    e.addEventListener ('click', function () {
        cartModal.style.display = "block";
        cartLightBoxs.classList.remove('animate-fade-out');
        cartLightBoxs.classList.add('animate-fade-in');
        cartOpen = 1;
    })
})
}


//Close
if(cartLightBoxs){
cartLightBoxs.addEventListener ('click', function () {
    cartLightBoxs.classList.add('animate-fade-out');
    cartLightBoxs.classList.remove('animate-fade-in');
    cartModal.style.display = "none";
})
}

if(cartClose){
cartClose.addEventListener ('click', function () {
    cartLightBoxs.classList.add('animate-fade-out');
    cartLightBoxs.classList.remove('animate-fade-in');
    cartModal.style.display = "none";
})

}

new SimpleLightbox({elements: '.product-gallery a'});

// const cartclose = document.querySelector(".close");
// cartclose.addEventListener('click', function(){
//     cartclose.style.display = "none";
// })