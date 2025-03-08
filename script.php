<?php 
"<script/>


function debounce(func, wait = 20, immediate = true) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

const sliderImages = document.querySelectorAll('.item');

function checkSlide() {
    
    sliderImages.forEach(sliderImage => {
        console.log('height',sliderImage.offsetTop);
        // half way through the image
        const slideInAt = (window.scrollY + window.innerHeight) - sliderImage.offsetHeight / 2;
        // bottom of the image
        const imageBottom = sliderImage.offsetTop + sliderImage.offsetHeight;
        const isHalfShown = slideInAt > sliderImage.offsetTop;
        const isNotScrolledPast = window.scrollY < imageBottom;
        if (isHalfShown && isNotScrolledPast) {
            sliderImage.classList.add('active');
        } else {
            sliderImage.classList.remove('active');
        }
    });
}

window.addEventListener('scroll', debounce(checkSlide));


        var example = ['Římanům 8 18 Soudím totiž, že utrpení nynějšího času se nedají srovnat s budoucí slávou, která má být na nás zjevena.', 'Žalmy 118 8 Lépe utíkat se k Hospodinu, než doufat v člověka.', 'Žalmy 23 4 I když půjdu roklí šeré smrti, nebudu se bát ničeho zlého, vždyť se mnou jsi ty. Tvoje berla a tvá hůl mě potěšují.', 'Kazatel 7 20 Není na zemi člověka spravedlivého, aby konal dobro a nehřešil.'];

       textSequence(0);
       function textSequence(i) {

           if (example.length > i) {
               setTimeout(function() {
                   document.getElementById('sequence').innerHTML = example[i];
                  textSequence(++i);
               }, 5500); // 1 second (in milliseconds)

           } else if (example.length == i) { // Loop
               textSequence(0);
           }

     } 



</script>"
?>