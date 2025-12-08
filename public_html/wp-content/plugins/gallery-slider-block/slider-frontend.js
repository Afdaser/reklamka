// Логіка фронтенду слайдера галереї.
( function () {
// Допоміжна функція ініціалізації одного слайдера.
const initSlider = ( root ) => {
const thumbs = Array.from( root.querySelectorAll( '.gsb-thumb' ) );
const mainImage = root.querySelector( '.gsb-active-image' );
const prevBtn = root.querySelector( '.gsb-prev' );
const nextBtn = root.querySelector( '.gsb-next' );
const autoplay = root.dataset.autoplay === 'true' || root.dataset.autoplay === true;
const interval = parseInt( root.dataset.interval, 10 ) || 5000;
let current = 0;
let timer = null;

if ( ! thumbs.length || ! mainImage ) {
return;
}

// Показ певного слайду.
const showSlide = ( index ) => {
current = ( index + thumbs.length ) % thumbs.length;
thumbs.forEach( ( thumb, i ) => {
const isActive = i === current;
thumb.classList.toggle( 'active', isActive );
if ( isActive ) {
mainImage.src = thumb.getAttribute( 'data-full' );
mainImage.alt = thumb.alt || '';
}
} );
};

// Автопрокрутка з оновленням таймера.
const startAutoplay = () => {
if ( ! autoplay || thumbs.length < 2 ) {
return;
}
stopAutoplay();
timer = setInterval( () => {
showSlide( current + 1 );
}, interval );
};

const stopAutoplay = () => {
if ( timer ) {
clearInterval( timer );
timer = null;
}
};

// Події навігації.
if ( prevBtn ) {
prevBtn.addEventListener( 'click', () => {
showSlide( current - 1 );
startAutoplay();
} );
}

if ( nextBtn ) {
nextBtn.addEventListener( 'click', () => {
showSlide( current + 1 );
startAutoplay();
} );
}

thumbs.forEach( ( thumb, index ) => {
thumb.addEventListener( 'click', () => {
showSlide( index );
startAutoplay();
} );
} );

showSlide( current );
startAutoplay();
};

// Запуск після готовності DOM.
document.addEventListener( 'DOMContentLoaded', () => {
document.querySelectorAll( '.gsb-slider' ).forEach( ( slider ) => initSlider( slider ) );
} );
}() );
