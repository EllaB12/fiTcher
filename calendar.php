<?php
    require_once('Includes/init.php');

    if (!$session->get_signed_in()){
        header('Location: newLogin.php');
        exit;
    }
 
    $user_id=$session->get_user_id();
    $user=new Teacher();
    $user->find_teacher_by_id($user_id);
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="rtl">
  <head>
  <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="JS/calendar/jquery1.5.1.js"></script>
    <script type="text/javascript" src="JS/calendar/he.js"></script>
    <script type="text/javascript" src="JS/calendar/oCalendar.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/lightBlue.css"/>
    
    <script>
        $(document).ready(function(){           
            $("#calendar").oCalendar({
                height:630,
                url:'calendarAPI.php'
            });
        });

        function removemeeting(e){
            e.preventDefault();
            let mid = document.getElementById("mid").value;
            console.log(mid);
            
            $.ajax({
                url: 'calendarAPI.php',
                type:'POST',
                async: false,
                dataType: 'json',
                data: "function=delete&mid="+mid,
                success: function(resp){
                  if(resp.success){
                    alert('הפגישה נמחקה בהצלחה');
                    location.reload();
                  }else{
                    alert('שגיאה במחיקת הפגישה');
                  }
                },
                error: function(resp){
                  console.log(resp);
                }
            });
            
            return false;
          }
    </script>
  </head>
    <body>            
        <div id="calendar">
            $("#calendar").oCalendar({});
        </div>
    </body>
</html>
