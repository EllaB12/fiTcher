<?php  

require_once('./Includes/teachermeetings.php');

if($_POST['function'] == "load"){
  $start = DateTime::createFromFormat('d-m-Y', DateTime::createFromFormat("d-m-Y G:i", $_POST['start'])->format("d-m-Y"));
  $end = DateTime::createFromFormat('d-m-Y',DateTime::createFromFormat("d-m-Y G:i", $_POST['end'])->format("d-m-Y"));
 
  $tid = $session->get_user_id();
  $meetings=TeacherMeeting::fetch_meetings();
  $s="";
  for($i=0;$i<count($meetings);$i+=1){
    $m=$meetings[$i];
    $ds = DateTime::createFromFormat('d-m-Y',$m->date);
    if($start > $ds || $ds > $end || $m->tid != $tid){
      continue;
    }
    $s=$s.'{';
      $s=$s.'"id":"'.$m->id.'",';
      if($m->sid == null){
        $s=$s.'"ack":"פגישה פנויה",';
      }else{
        $s=$s.'"ack":"פגישה עם: '.$m->sid.'",';
      }
      $s=$s.'"time":"'.$m->stime.'",';
      $s=$s.'"date":"'.$m->date.'",';
      $s=$s.'"etime":"'.$m->etime.'"';
      
      $s=$s.'},';
  }  
  if($s!="")
  {
    $s=substr($s, 0, strlen($s)-1);

  }
  echo "[".$s."]";
}
else if($_POST['function'] == "add"){
  $date = $_POST['date'];
  $stime = $_POST['stime'];
  $etime = $_POST['etime'];
  $tid = $_POST['tid'];

  $error = TeacherMeeting::add_meeting($date,$stime,$etime,$tid);
  if($error == ""){
    echo '{"success": true}';
  }else{
    echo '{"success": false}';
  }
}
else if($_POST['function'] == "get"){
  $tid = $_POST['tid'];
  $meetings=TeacherMeeting::fetch_meetings();
  $s="";
  for($i=0;$i<count($meetings);$i+=1){
    $m=$meetings[$i];
      if($m->sid != null || $m->tid != $tid){
        continue;
      }
      $s=$s.'{';
      $s=$s.'"id":"'.$m->id.'",';
      $s=$s.'"date":"'.$m->date.'",';
      $s=$s.'"stime":"'.$m->stime.'",';
      $s=$s.'"etime":"'.$m->etime.'"';
      $s=$s.'},';
  }
  if($s!="")
  {
    $s=substr($s, 0, strlen($s)-1);
  }
  echo "[".$s."]";
}
else if($_POST['function'] == "set"){
  $sid = $_POST['sid'];
  $mid = $_POST['mid'];
  $date = $_POST['date'];
  $stime = $_POST['stime'];
  $tid = $_POST['tid'];
  TeacherMeeting::add_meeting_to_payment($sid,$tid,$date,$stime);
  $error = TeacherMeeting::set_sid($mid,$sid);
  echo '{"success": true}';
}
else if($_POST['function'] == "delete"){
  $mid = $_POST['mid'];
  
  $error = TeacherMeeting::delete($mid);
  echo '{"success": true}';
}

?>
