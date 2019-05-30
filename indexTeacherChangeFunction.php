

 <?php
    require_once('Includes/init.php');
    
    $user_id=$session->get_user_id();
    $user=new Teacher();
    $user->find_teacher_by_id($user_id);
    $price=$user->get_price();
    
    
    
    
    
    
?> 


















?>