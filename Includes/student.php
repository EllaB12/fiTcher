<?php
  
require_once('init.php');

class Student{
     // Attributes
    private $id;
    public $fullName;
    private $email;
    private $phoneNumber;
    private $parentPhone;
    private $city;
    private $street;
    private $picture;
    private $class;
    //private $grouping;
    //private $units;
    
    // Methods
    public static function fetch_students(){
        global $database;
        $result_set=$database->query("select * from students");
        $students=null;
        if (isset($result_set)){
            $i=0;
            if ($result_set->num_rows>0){ 
                while($row=$result_set->fetch_assoc()){ 
                    $student=new Student();
                    $student->instantation($row);
                    $students[$i]=$student;
                    $i+=1;
                }
            }
        }
        return $students;
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
	 
	 
    public function find_student_by_id($id){
        global $database;
        $error=null;
        $result=$database->query("select * from students where id='".$id."'");
          if (!$result)
            $error='Can not find the student.  Error is:'.$database->get_connection()->error;
        else if ($result->num_rows>0){
            $found_student=$result->fetch_assoc();
            $this->instantation($found_student);
        }
         else
             $error="Can not find student by this ID";
        echo $error;
    }
    
    
    public static function find_by_id($id){
        global $database;
        $error=null;
        $result=$database->query("select * from students where id='".$id."'");
        if (!$result)
            return null;
        else if ($result->num_rows>0){
            $found_teacher=$result->fetch_assoc();
            $t = new Student;
            $t->instantation($found_teacher);
            return $t;
        }
        return null;
    }
    
    
    public function find_student_by_email($email){
        global $database;
        $error=null;
        $result=$database->query("select * from students where email='".$email."'");
          if (!$result)
            $error='Can not find the student.  Error is:'.$database->get_connection()->error;
        else if ($result->num_rows>0){
            $found_student=$result->fetch_assoc();
            $this->instantation($found_student);
        }
         else
             $error="Can not find student by this email";
        return $error;
        
    }
	
	
    public static function add_student($id,$fullName,$email,$phoneNumber,$parentPhone,$city,$street,$picture,$class){
        global $database;
        $error=null;
        //checking if the Id is available in DB
        $sql="SELECT * FROM students WHERE id='$id'";
        $check = $database->query($sql);
        $count_row = $check->num_rows;
        //if the Id is not in DB then insert into students
        if ($count_row == 0){
        $sql="INSERT INTO students(id,fullName,email,phoneNumber,parentPhone,city,street,picture,class) VALUES ('$id','$fullName','$email','$phoneNumber','$parentPhone','$city','$street','$picture','$class')";
        $result=$database->query($sql);
        }
        if (!$result)
            $error='Can not add student.  Error is:'.$database->get_connection()->error;
        return $error;
    }
    
    
    public function check_email_validation($email){
        global $database;
        $valid=null;
        $result=$database->query("select * from students where email='".$email."'");
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
        $result=$database->query("select * from students where id='".$id."'");
          if ($result->num_rows>0){
            $valid= true;
          }
          else
            $valid=false;
        return $valid;
    }
    

    public function get_picture(){
        return $this->picture;
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

    public function get_parentPhone(){
        return $this->parentPhone;
    }

    public function get_city(){
        return $this->city;
    }

    public function get_street(){
        return $this->street;
    }

    public function get_class(){
        return $this->class;
    }

    public function get_grouping(){
        return $this->grouping;
    }

    public function get_units(){
        return $this->units;
    }

}

?>