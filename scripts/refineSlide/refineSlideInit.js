$(document).ready(function () {
    rsSlide();
    console.log('start');
});

function kenBurnsEffect() {
    return {
        onInit: function () {
            this.slider.$currentSlide.find('img').addClass('kenburns');
        },
        onChange: function () {
            this.slider.$nextSlide.find('img').addClass('kenburns');

        },
        afterChange: function () {
            this.slider.$previousSlide.find('img').removeClass('kenburns');
        }
    };
}

function rsSlide() {

    var $slides = $('.rslide-init');

    $slides.each(function(){

        var $slide = $(this);

        if(!$slide.hasClass('rs-slider')){ //hasn't been initialised

            if($slide.hasClass('kenburns-effect')){
                $slide.refineSlide(kenBurnsEffect());
            }else{
                $slide.refineSlide();
            }
        }
    });
}