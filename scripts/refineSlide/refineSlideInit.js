$(document).ready(function () {

});

function refinSlideInit() {
    return {
        onInit: function () {
            this.slider.$currentSlide.find('img').addClass('kenburns');

            var _this = this.slider;

            $('.rs-link').on('click', function () {
                var cl = $(this).data('class').split('-')[3];
                _this.transition(cl - 1);
            });
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
    $('#rs-1').refineSlide(refinSlideInit());
}