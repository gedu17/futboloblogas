var currentSlider = 1;
var sliderSpeed = 800;
function slider() {
    if(currentSlider === $("#headerImages").children().length)
    {
        $("#headerImage"+currentSlider).fadeOut(sliderSpeed);
        $("#headerImage1").fadeIn(sliderSpeed);                
        currentSlider = 1;
    }
    else
    {
        $("#headerImage"+currentSlider).fadeOut(sliderSpeed);
        $("#headerImage"+(currentSlider+1)).fadeIn(sliderSpeed);
        currentSlider++;
    } 
};
$(document).ready(function(){
    setInterval(slider, 5000);  
});

