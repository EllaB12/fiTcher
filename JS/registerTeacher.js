$(document).ready(function() {
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    

    //Next button 1
    $(".next").click(function(){
        
        //ID validation
        if( document.getElementsByName("id")[0].value == ""){
            document.getElementById('empty-id-alert').style.display="block";
            }
            else{
            document.getElementById('empty-id-alert').style.display="none";            
            }

        if(($("#ID").val().length > 0 && $("#ID").val().length < 9) || $("#ID").val().length > 9){
            document.getElementById('invalid-id-alert').style.display="block";
            }
            else{
                document.getElementById('invalid-id-alert').style.display="none";
            }
        
         //Email validation
        if( $("input[name='email'").val() == ""){
            document.getElementById('empty-email-alert').style.display="block";
            }
            else{
            document.getElementById('empty-email-alert').style.display="none";

            if ($('input[name=email]').val().indexOf("@", 0) < 0){
                document.getElementById('invalid-email-alert').style.display="block";
                }
                else{
                document.getElementById('invalid-email-alert').style.display="none";
                }
    
            if ($('input[name=email]').val().indexOf(".", 0) < 0){
              document.getElementById('invalid-email-alert').style.display="block";
              }
              else{
               document.getElementById('invalid-email-alert').style.display="none";
            }
          }
        
        //User password validation
        if( $("#userPass").val() == "" || $("#userPass").val().length < 6){
          document.getElementById('pw-msg').style.display="block"; 
          } 
          else{
            document.getElementById('pw-msg').style.display="none";
          }

        if( $("#confirm_pass").val() != $("#userPass").val()){
          document.getElementById('pw-equal').style.display="block";
          } 
          else{
            document.getElementById('pw-equal').style.display="none";
          }
    });
    

    $(".next").click(function(){
    if (
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


     //Next button 2
    $(".next2").click(function(){
         //Full name validation
        if( document.getElementsByName("fullName")[0].value == ""){
            document.getElementById('empty-fullName-alert').style.display="block";
            }
            else{
            document.getElementById('empty-fullName-alert').style.display="none";            
            }

        if(($("#fullName").val().length > 0 && $("#fullName").val().length < 4)){
            document.getElementById('invalid-fullName-alert').style.display="block";
            }
            else{
                document.getElementById('invalid-fullName-alert').style.display="none";
            }
        
        //Street address validation
        if($("#street").val() == ""){
            document.getElementById('empty-street-alert').style.display="block";
            }
            else{
            document.getElementById('empty-street-alert').style.display="none";
            }
        
        if($("#street").val().length > 0 && $("#street").val().length < 5){
            document.getElementById('invalid-street-alert').style.display="block";
            }
            else{
             document.getElementById('invalid-street-alert').style.display="none";
            }

        // if(/\d/.test($("#street").val())){
        //     document.getElementById('invalid-numStreet-alert').style.display="block";
        //     }
        //     else{
        //      document.getElementById('invalid-numStreet-alert').style.display="none";
        //     }

        //City name validation
        if($("#cityText").val() == ""){
          document.getElementById('empty-city-alert').style.display="block";
          }
          else{
          document.getElementById('empty-city-alert').style.display="none";
          }
        
        //Phone number validation
        if( $("#phone").val() == ""){
            document.getElementById('empty-phone-alert').style.display="block";
            }
            else{
             document.getElementById('empty-phone-alert').style.display="none";
            }

        if($("#phone").val().length > 0 && $("#phone").val().length < 8 || $('input[name=phone]').val().indexOf("-", 0) > 0){
            document.getElementById('invalid-phone-alert').style.display="block";
            }
            else{
             document.getElementById('invalid-phone-alert').style.display="none";
            }
    });


    $(".next2").click(function(){
        if (document.getElementsByName("fullName")[0].value == "" || $("#fullName").val().length > 0 && $("#fullName").val().length < 4){
                //invalid or blank full name
             } 
        
             else if($("#street").val() == ""|| $("#street").val().length > 0 && $("#street").val().length < 5){
              //invalid or blank street address
                }
                else if($("#cityText").val() == ""){
                    //blank city name
                }
                else if($("#phone").val() == ""||
                 $("#phone").val().length > 0 && $("#phone").val().length < 8 || $('input[name=phone]').val().indexOf("-", 0) > 0){
                    //invalid or blank phone number
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

      
/*            $(".next3").click(function(){
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
     
    });*/

});