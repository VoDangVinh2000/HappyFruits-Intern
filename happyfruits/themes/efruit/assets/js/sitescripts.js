const cartLightBox = document.querySelector('.cart-lightbox');
const cartClose = document.querySelector('.offcanvas-close');
const btnCart = document.querySelectorAll('.btn-cart-nav');
const cartModal = document.querySelector('.cart-modal');
let cartOpen = 0;
// Open
btnCart.forEach(e => {
    e.addEventListener ('click', function () {
        cartModal.style.display = "block";
        cartLightBox.classList.remove('animate-fade-out');
        cartLightBox.classList.add('animate-fade-in');
        cartOpen = 1;
    })
})

// Close
cartLightBox.addEventListener ('click', function () {
    cartLightBox.classList.add('animate-fade-out');
    cartLightBox.classList.remove('animate-fade-in');
    cartModal.style.display = "none";
})
cartClose.addEventListener ('click', function () {
    cartLightBox.classList.add('animate-fade-out');
    cartLightBox.classList.remove('animate-fade-in');
    cartModal.style.display = "none";
})

new SimpleLightbox({elements: '.product-gallery a'});


const carouselCate = document.querySelectorAll('.carousel.carousel-category');

carouselCate.forEach(cat => {
    const items = cat.querySelectorAll('.carousel-item');
    items.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    })
});

