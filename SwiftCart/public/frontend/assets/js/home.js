 /** Start Swiper slider**/
 const swiperSlider = new Swiper('.swiper-slider', {
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
    autoplay: {
        delay: 3000
    }

});
/** End Swippr slider **/

/** Start Swiper flash sale**/
const swiperFlashSale = new Swiper('.swiper-flash-sale', {
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
    breakpoints: {
        // when window width is >= 270px
        450: {
            slidesPerView: 2,
            spaceBetween: 5
        },

        // when window width is >= 900px
        800: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        // when window width is >= 1200px
        1220: {
            slidesPerView: 4,
            spaceBetween: 30
        },
    }
});
/** End Swiper flash-sale **/

/** Start Swiper Brand**/
const swiperBrand = new Swiper('.swiper-brand', {
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
    breakpoints: {
        // when window width is >= 270px
        450: {
            slidesPerView: 2,
            spaceBetween: 10
        },

        // when window width is >= 900px
        700: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        // when window width is >= 1200px
        900: {
            slidesPerView: 4,
            spaceBetween: 30
        },
        1100: {
            slidesPerView: 5,
            spaceBetween: 30
        },
    }
});
/** End Swiper Brand **/

