<?php
  
require_once('init.php');

class Teacher{
    // Attributes
    public $id;
    public $fullName;
    public $email;
    public $phoneNumber;
    public $city;
    public $street;
    public $picture;
    public $experience;
    public $description;
    public $price;
    public $cutPrice;
    public $gender;
    public $likes;
    
    // Methods
    public static function fetch_teachers(){
        global $database;
        $result_set=$database->query("select * from teachers");
        $teachers=null;
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $teacher=new Teacher();
                    $teacher->instantation($row);
                    $teachers[$i]=$teacher;
                    $i+=1;
                }
            }
        }
        header('Content-Type: application/json');
        $myArray = (array)$teachers; 
        var_dump($myArray);
        
    }

    public static function get_of_student($sid){
        
        global $database;
        $result_set=$database->query("select * from studentTeacher where idStudent = '".$sid."'");
        $teachers=array();
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $teacher=Teacher::find_teacher_by_id($row['idTeacher']);
                    $teachers[$i]=$teacher;
                    $i+=1;
                }
            }
        }
        return $teachers;
    }
    

    public static function matching($city,$subject,$grade){
        global $database;
        $result_set=$database->query("select * from teachers join qualifications on teachers.id = qualifications.teacherID where qualifications.educationGroup='".$grade."' and qualifications.subjectID=('". $subject."') and teachers.city='".$city."' ");
        //$teachers=array();
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $teachers[]=array("id" => $row["id"],"fullName" => $row["fullName"], "email" => $row["email"],"phoneNumber" => $row["phoneNumber"],"city" => $row["city"],"experience" => $row["experience"],"picture" => $row["picture"],"description" => $row["description"],"price" => $row["price"],"cutPrice" => $row["cutPrice"],"likes" => $row["likes"]);
                }
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($teachers);
    }


    public static function matching_with_gender($city,$subject,$grade,$gender){
        global $database;
        $result_set=$database->query("select * from teachers join qualifications on teachers.id = qualifications.teacherID where qualifications.educationGroup='".$grade."' and qualifications.subjectID=('". $subject."') and teachers.city='".$city."' and teachers.gender='".$gender."'");
        //$teachers=array();
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $teachers[]=array("id" => $row["id"],"fullName" => $row["fullName"], "email" => $row["email"],"phoneNumber" => $row["phoneNumber"],"city" => $row["city"],"experience" => $row["experience"],"picture" => $row["picture"],"description" => $row["description"],"price" => $row["price"],"cutPrice" => $row["cutPrice"],"likes" => $row["likes"]);
                }
            }
        }
        header('Content-Type: application/json');
        
        echo json_encode($teachers);
    }

        
    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
    
     private function  instantation($student_array){
        foreach ($student_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
	 
	 
    public static function find_teacher_by_id($id){
        global $database;
        $error=null;
        $result=$database->query("select * from teachers where id='".$id."'");
        if (!$result)
            return null;
        else if ($result->num_rows>0){
            $found_teacher=$result->fetch_assoc();
            $t = new Teacher;
            $t->instantation($found_teacher);
            return $t;
        }
        return null;
    }
	
	
    public static function add_teacher($id,$fullName,$email,$phoneNumber,$city,$street,$picture,$experience,$description,$price,$cutPrice,$gender){
        global $database;
        $error=null;
        //checking if the Id is available in DB
        $sql="SELECT * FROM teachers WHERE id='$id'";
        $check = $database->query($sql);
        $count_row = $check->num_rows;
        //if the Id is not in DB then insert into teachers
        if ($count_row == 0){
        $sql="INSERT INTO teachers(id,fullName,email,phoneNumber,city,street,picture,experience,description,price,cutPrice,gender) values ('$id','$fullName','$email','$phoneNumber','$city','$street','$picture','$experience','$description','$price','$cutPrice','$gender')";
        $result=$database->query($sql);
        }
        if (!$result)
            $error='Can not add teacher.  Error is:'.$database->get_connection()->error;
        return $error;
    }
    
    
    public static function fetch_teachers_home(){
        
        global $database;
        $result_set=$database->query("SELECT fullName, picture, description, experience FROM teachers");
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $teacher=new Teacher();
                    $teacher->instantation($row);
                    $teachers[$i]=$teacher;
                    $i+=1;
                }
            }
        }
        
        $myArray = (array)$teachers; 
        return $teachers;
    }
    
    
    public function get_teacher_by_id($id,$tid){
        global $database;
        $error=null;
        $result=$database->query("Select teachers.fullName From studentTeacher join teachers on studentTeacher.idTeacher=teachers.id Where studentTeacher.idStudent ='".$id."' AND studentTeacher.idTeacher='".$tid."'");
        // $row = $result->fetch_assoc();
        // echo ($row['fullName']);

        foreach($result as $row)
        {
            echo   "<B>".$row['fullName']."<br>";
        }
    }
    
    
    public function get_price_by_id($id, $tid){
    global $database;
        $error=null;
        $result=$database->query("Select teachers.price From studentTeacher join teachers on studentTeacher.idTeacher=teachers.id Where studentTeacher.idStudent ='".$id."' AND studentTeacher.idTeacher='".$tid."'");
        foreach($result as $row){
            echo $row['price'];
            }    
    }
    
    
    public function get_price_by_id2($id){
    global $database;
        $error=null;
        $result=$database->query("Select teachers.price From studentTeacher join teachers on studentTeacher.idTeacher=teachers.id Where studentTeacher.idStudent ='".$id."' limit 1");
        foreach($result as $row){
            echo $row['price'];
            }    
    }

    
    public function check_email_validation($email){
        global $database;
        $valid=null;
        $result=$database->query("select * from teachers where email='".$email."'");
          if ($result->num_rows>0){
            $valid= true;
          }
          else
            $valid=false;
        return $valid;
    }


    public function check_id_validation($id){
        global $database;
        $valid=null;
        $result=$database->query("select * from teachers where id='".$id."'");
          if ($result->num_rows>0){
            $valid= true;
          }
          else
            $valid=false;
        return $valid;
    }


    public function addLike($teacherID){
        global $database;
        $sql="UPDATE teachers SET likes=likes+1 WHERE id='".$teacherID."'";
        $result=$database->query($sql);
    }
    
    
    public function get_id(){
        return $this->id;
    }
    
    public function get_fullName(){
        return $this->fullName;
    }

    public function get_email(){
        return $this->email;
    }

	 public function get_phoneNumber(){
        return $this->phoneNumber;
    }

    public function get_city(){
        return $this->city;
    }

    public function get_street(){
        return $this->street;
    }

    public function get_experience(){
        return $this->experience;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_price(){
        return $this->price;
    }
    
    public function get_cutPrice(){
        return $this->cutPrice;
    }
    public function get_picture(){
    return $this->picture;
    }

}

?>
