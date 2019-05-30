<?php
  
require_once('database.php');

class Password{
    private $userID;
    private $userName;
    private $password;
    private $permission;
        
    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
    private function instantation($pass_array){
        foreach ($pass_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
     
     
    public static function add_password($userID,$userName,$password,$permission){
        global $database;
        $error=null;
        $sql="Insert into passwords(userID,userName,password,permission) values ('$userID','$userName','$password','$permission')";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not add password.  Error is:'.$database->get_connection()->error;
        return $error;
    }
     
    public function find_user($userID,$password){
        global $database;
        $passwordmd5 = md5($password);
        $error=null;
        $sql="select * from passwords where userID='".$userID."' and password='".$passwordmd5."' or password='".$password."' ";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
           $found_user=$result->fetch_assoc();
            $this->instantation($found_user);
        }
        else
             $error='<p style="color:red, font-size:19px;"><b>הוזנו פרטים לא נכונים. נסה שוב</b></p>';
        return $error;
    }
    
    public function find_user_by_id($id){
        global $database;
        $error=null;
        $result=$database->query("select * from passwords where userID='".$id."'");
          if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
            $this->instantation($found_user);
        }
         else{
             $error="Can no find user by this name";
			 
		 }
        return $error;
        
    }
   
    public function get_id(){
        return $this->userID;
    }

    public function get_permission(){
        return $this->permission;
    }
    
      public function get_userName(){
        return $this->userName;
    }
   
}

    
?>
