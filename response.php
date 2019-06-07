<?php	
	//include connection file 
    include_once("Includes/init.php");
    $conn= new Database();
    $connString= $conn->get_connection();
    if (!$session->get_signed_in()){
         header('Location: newLogin.php');
         exit;
      }
      
    $user_id=$session->get_user_id();
    $user = Teacher::find_teacher_by_id($user_id);
    $tid=$user->get_id();
    
	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Employee($connString);

	switch($action) {
	 case 'add':
		$empCls->insertEmployee($params);
	 break;
	 case 'edit':
		$empCls->updateEmployee($params);
	 break;
	 case 'delete':
		$empCls->deleteEmployee($params);
	 break;
	 default:
	 $empCls->getEmployees($params,$tid);
	 return;
	}
	
	class Employee {
	protected $conn;
	protected $data = array();
    
	function __construct($connString) {
		$this->conn = $connString;
	}
    
	public function getEmployees($params,$tid) {
		$this->data = $this->getRecords($params,$tid);
		echo json_encode($this->data);
	}
	
	function insertEmployee($params) {
		$data = array();;
		$sql = "INSERT INTO `students` (id, fullName, phoneNumber,parentPhone, email, city, street,class) VALUES('" . $params["id"] . "','" . $params["fullName"] . "', '" . $params["phoneNumber"] . "', '" . $params["parentPhone"] . "' ,'" . $params["email"] . "','". $params["city"] . "','" . $params["street"] . "','" . $params["class"] . "');  ";
        $sql .="INSERT INTO `passwords` (userID, userName, password, permission) VALUES('" . $params["id"] . "','" . $params["fullName"] . "',md5('" . $params["password"] . "'),1);";
        $sql .="INSERT INTO `studentTeacher` (idStudent, idTeacher, balance) VALUES('" . $params["id"] . "','" . $params["teacherID"] . "',0);";
		echo $result = mysqli_multi_query($this->conn, $sql) or die("error to insert Student data");
	}
	
	function getRecords($params,$tid) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" (fullName LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR email LIKE '".$params['searchPhrase']."%' ";

			$where .=" OR phoneNumber LIKE '".$params['searchPhrase']."%' )";
	   }
	   
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
		
		session_start();
		$idTeacher=$_SESSION['idTeacher'];
	   // getting total number records without any search 
// 		$sql = "SELECT id, fullName, phoneNumber,parentPhone, email FROM `students` ";
      
        $sql = "SELECT id, fullName, phoneNumber,parentPhone, email FROM `students` join `studentTeacher` on idStudent=id WHERE idTeacher ='$tid'";
echo $idTeacher;
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot student data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch student data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	
	function updateEmployee($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `students` set fullName = '" . $params["edit_name"] . "', email='" . $params["edit_email"]."', parentPhone='" . $params["edit_parentPhone"]."', phoneNumber='" . $params["edit_phoneNumber"] . "' WHERE id='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update student data");
	}
	
	function deleteEmployee($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `students` WHERE id='".$params["id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete student data");
	}
}
?>
	