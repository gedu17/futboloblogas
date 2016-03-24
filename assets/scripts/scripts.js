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

function managePollAnswers()
{
    $('#answersCount').change(function(){
        var number = $('#answersCount').val();
        var oldnumber = $('#pollAnswers').children('input').length;
        if(number < oldnumber)
        {
            for(var i = oldnumber; i > number; i--)
            {
                $('#pollAnswer_'+i).remove();
            }
        }
        else if(number > oldnumber)
        {
           var from = parseInt(oldnumber) + 1;
           var to = parseInt(number) + 1;
           for(var i = from; i < to; i++)
           {
                $('#pollAnswers').append('<input type="text" class="form-control \n\
                    inputSpacing" required id="pollAnswer_'+i+'" name="pollAnswer_'+i+'" />');
           }
        }
    });
}

function vote()
{
    $('#voteButton').click(function(){
        $.post("/poll/vote", { "poll": $('input[name=poll]:checked').val()}).done(function(){
           $.ajax("/poll/view").done(function(data){
                $('#pollItems').remove();
                $('#pollVote').remove();
                $('#pollBar').append(data);
           });
        });
    });
}

function fixHeight()
{    
    var tmp = $( window ).height() - $('#header').height() - 
            parseInt($('#content').css('margin-top'));
            
    $('#content').height(tmp);
    $('#mainContent').height(tmp);
}

$(document).ready(function(){
    setInterval(slider, 5000); 
    
    managePollAnswers();
    vote();
    fixHeight();
});

