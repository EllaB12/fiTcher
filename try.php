<?php
include_once('Includes/init.php');
  $mid = 54;
  
  $m = TeacherMeeting::find_by_id($mid);
 echo $m->sid;
  $tid = $m->tid;
  $date = $m->date;
  $stime = $m->stime;
  
  TeacherMeeting::remove_meeting_from_payment($sid,$tid,$date,$stime);
  $error = TeacherMeeting::delete($mid);
  echo '{"success": true}';
  
?>