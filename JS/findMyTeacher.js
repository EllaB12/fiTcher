$(document).ready(function() {
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    

    //Next button 1
    $(".next").click(function(){
        //gender radio validation
       
        var option=document.getElementsByName('gender');

        if ((option[0].checked || option[1].checked ||option[2].checked)) {
            document.getElementById('empty-gender-alert').style.display="none";
        }     
        else{
            document.getElementById('empty-gender-alert').style.display="block";
        }
            
    
       /* var gender = document.getElementsByName('gender');
        var genValue = false;

        for(var i=0; i<gender.length;i++){
            if(gender[i].checked == true){
                genValue = true;    
            }
        }
        if(!genValue){
            genValue= false;
            document.getElementById('empty-gender-alert').style.display="block";
        }*/
        
    });
    

    $(".next").click(function(){
   /* if (
        $("input[name='email'").is(':invalid') ||
        $("input[name='email'").val() == "" ||($("#ID").val().length >= 0 && $("#ID").val().length < 9)||
        $("#ID").val().length > 9
        ){
            //invalid or blank email and id
    
         } else if(
        $("#confirm_pass").val() != $("#userPass").val() ||
        $("#userPass").val() =="" ||
        $("#userPass").val().length < 6
        ){
          //passwords dont match
      }
      else{*/
      
      if(animating) return false;
      animating = true;
      
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
     
      //activate next step on progressbar using the index of next_fs
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      
      //show the next fieldset
      next_fs.show(); 
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale current_fs down to 80%
          scale = 1 - (1 - now) * 0.2;
          //2. bring next_fs from the right(50%)
          left = (now * 50)+"%";
          //3. increase opacity of next_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            'transform': 'scale('+scale+')',
            'position': 'absolute'
          });
          next_fs.css({'left': left, 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
          current_fs.hide();
          animating = false;
        }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
      });
     
    });


     //Next button 2
    $(".next2").click(function(){
        
        //City name validation
        if($("#cityText").val() == ""){
          document.getElementById('empty-city-alert').style.display="block";
          }
          else{
          document.getElementById('empty-city-alert').style.display="none";
          }
      
    });


    $(".next2").click(function(){
                if($("#cityText").val() == ""){
                    //blank city name
                }
                else{
                    if(animating) return false;
                    animating = true;
                    
                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();
                    
                    //activate next step on progressbar using the index of next_fs
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    
                    //show the next fieldset
                    next_fs.show(); 
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50)+"%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                            'transform': 'scale('+scale+')',
                            'position': 'absolute'
                        });
                        next_fs.css({'left': left, 'opacity': opacity});
                        }, 
                        duration: 800, 
                        complete: function(){
                        current_fs.hide();
                        animating = false;
                        }, 
                        //this comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    });
                }
         
        });
        
        $(".next3").click(function(){
            //subject name validation
            if($("#subjectText").val() == ""){
              document.getElementById('empty-subject-alert').style.display="block";
              }
              else{
              document.getElementById('empty-subject-alert').style.display="none";
              }
          
        });
        
        $(".next3").click(function(){
            
                if($("#subjectText").val() == ""){
                    //blank subject text
                }
                else{
                  if(animating) return false;
                  animating = true;
                  
                  current_fs = $(this).parent();
                  next_fs = $(this).parent().next();
                  
                  //activate next step on progressbar using the index of next_fs
                  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                  
                  //show the next fieldset
                  next_fs.show(); 
                  //hide the current fieldset with style
                  current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                      //as the opacity of current_fs reduces to 0 - stored in "now"
                      //1. scale current_fs down to 80%
                      scale = 1 - (1 - now) * 0.2;
                      //2. bring next_fs from the right(50%)
                      left = (now * 50)+"%";
                      //3. increase opacity of next_fs to 1 as it moves in
                      opacity = 1 - now;
                      current_fs.css({
                        'transform': 'scale('+scale+')',
                        'position': 'absolute'
                      });
                      next_fs.css({'left': left, 'opacity': opacity});
                    }, 
                    duration: 800, 
                    complete: function(){
                      current_fs.hide();
                      animating = false;
                    }, 
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                  });
            }
      });

  
});