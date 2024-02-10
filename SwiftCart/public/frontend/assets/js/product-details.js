

/** Start Slider **/
const swiperImageGallery = new Swiper('.swiper-image-gallery', {
	loop: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	slidesPerView: 4,
	spaceBetween: 10,
});

var slideImages = document.querySelectorAll('.swiper-image-gallery .swiper-wrapper img');
if (slideImages.length > 0)
{
    var mainImage = document.querySelector(".main-image-container img");
    var arrSrc = [...slideImages].map((e) => {
        return e.src;
    });
    var t = setInterval(() => {
       next.click()
    }, 2000);
    slideImages.forEach(e => e.onmouseover = () => {
        clearInterval(t);
        mainImage.src = e.src;
        slideImages.forEach(img => img.style.border = "none");
        e.style.border = "solid 3px #FFCF17";

        t = setInterval(() => next.click(), 2000);
    });
    slideImages.forEach(e => e.onmouseleave = () => {
        if (mainImage.src != e.src)
            e.style.border = "none";
    });
    var next = document.querySelector(".swiper-image-gallery .swiper-button-next");
    var prev = document.querySelector(".swiper-image-gallery .swiper-button-prev");
    next.onclick = () => {
        clearInterval(t);
        swiperImageGallery.autoplay.start();
        switch_img()
        t = setInterval(() => next.click(), 2000);
        swiperImageGallery.autoplay.stop();
    };
    prev.onclick = () => {
        clearInterval(t);
        switch_img();
        t = setInterval(() => next.click(), 2000);
        swiper.autoplay.stop();
    };


    function switch_img() {

        var currIndex = arrSrc.indexOf(mainImage.src);
        if (currIndex === [...slideImages].length - 1) {
            mainImage.src = arrSrc[0];
            slideImages[0].style.border = "solid 3px #FFCF17";
            slideImages[slideImages.length - 1].style.border = "none";
        } else {
            mainImage.src = arrSrc[currIndex + 1];
            slideImages[currIndex].style.border = "none";
            slideImages[currIndex + 1].style.border = "solid 3px #FFCF17";

        }
    }
}

const swiperReviews = new Swiper('.swiper-reviews', {
	loop: true,
	navigation: {
		nextEl: '.swiper-reviews > .swiper-button-next',
		prevEl: '.swiper-reviews > .swiper-button-prev',
	},
	slidesPerView: 1,
	spaceBetween: 10,
});

const swiperReviewImages = new Swiper('.swiper-review-images', {
	loop: true,
	navigation: {
		nextEl: '.swiper-review-images .swiper-button-next',
		prevEl: '.swiper-review-images .swiper-button-prev',
	},
	slidesPerView: 3,
	spaceBetween: 10,
});
/** End Slider **/

/** Start Zoom **/
var mainImageContainer = document.querySelector(".main-image-container")
var mainImage = mainImageContainer.querySelector('img')
mainImageContainer.onmousemove = (e) => {
	var x = e.clientX - e.target.offsetLeft
	var y = e.clientY - e.target.offsetTop
	mainImage.style.transformOrigin = `${x}px ${y}px`
	mainImage.style.transform = "scale(1.8)"
}
mainImageContainer.onmouseleave = (e) => {
	mainImage.style.transformOrigin = 'center'
	mainImage.style.transform = "scale(1)"
	t = setInterval(() => next.click(), 2000);
}
mainImageContainer.onmouseover = () => clearInterval(t)
/** End Zoom  **/

/** Start Rating  **/
var starsRating = document.querySelectorAll(".write-review .fa-star")
var ratingCount = document.querySelector('.write-review form .rating')
starsRating.forEach((e,id)=>{
    e.onclick = ()=>{
        for (let i = id; i >= 0; i--)
        {

            starsRating[i].classList.remove("far");
            starsRating[i].classList.add("fas");
        }
        for (let i = id + 1; i <= 4; i++)
        {
            if(starsRating[i].classList.contains("fas"))
            {
                starsRating[i].classList.remove("fas");
                starsRating[i].classList.add("far");
            }
        }
        ratingCount.value = id + 1;


    }
})

/** End Rating  **/
