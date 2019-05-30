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
    $user=new Teacher();
    $user->find_teacher_by_id($user_id);
    session_start();
    $_SESSION['id'] = $user_id;
    ?>
<!DOCTYPE html>
<html lang="he">
<head> 
<meta charset="utf-8">
  <title>Fitcher-Teacher-My Students</title>
  <link rel="shortcut icon" href="Images/icon.png" type="image/x-icon"/>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link href="CSS/myStudents.css" rel="stylesheet">
</head>
<header>

<div class="topnav container" id="myTopnav" class="container"> <!--check this if not working container-->

      <a href="homePageLoginNew.php" >עמוד בית</a>
      <a href="indexTeacher.php" >אזור אישי</a>
      <a href="#" class="active">התלמידים שלי</a>
      <a href="indexTeacher.php#payment">תשלום</a>
       <a href="indexTeacher.php#footer">צור קשר</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
  <a class="logo" href="homePageNew.php"><img src="Images/logo.png" height=70 width=120></a>
</div>
<a href="#" ><i class="fa fa-arrow-circle-up" style="font-size:50px; position:fixed; bottom:0; right:15;"></i></a>
<a href="indexTeacher.php" ><i class="fa fa-arrow-circle-right" style="font-size:50px; float:right;position:realtive;top:20;right:10;"></i></a>


</header>
<body>
<section id="myStudents"> 
    <div class="container text-center">
        <div class="text-center">
            <div class="col-sm-12">
            <h2 align="center">התלמידים שלי</h2>
            <div class="well clearfix">
            <div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
            <span class="glyphicon glyphicon-plus"></span> הוסף תלמיד</button></div></div>
            <table dir="rtl" id="employee_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
                <thead >
                <tr>
                    <th data-css-class="text-center" data-column-id="id" data-type="numeric" data-identifier="true">תעודת זהות</th>
                    <th data-css-class="text-center" data-column-id="fullName">שם מלא</th>
                    <th data-css-class="text-center" data-column-id="phoneNumber">פלאפון</th>
                    <th data-css-class="text-center" data-column-id="parentPhone">פלאפון הורה</th>
                    <th data-css-class="text-center" data-column-id="email">דואר אלקטרוני</th>
                    <th data-css-class="text-center" data-css-class="text-center" data-column-id="commands" data-formatter="commands" data-sortable="false">ניהול</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
  

    <div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" dir="rtl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">הוסף תלמיד</h4>
            </div>
                <div class="modal-body">
                <form method="post" id="frm_add" dir="rtl">
				          <input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="name" class="control-label">תעודת זהות:</label>
                    <input type="text" class="form-control" id="id" name="id" />
                  </div>
                  <div class="form-group">
                    <label for="name" class="control-label">שם מלא:</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" />
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">מספר פלאפון:</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" />
                  </div>
				          <div class="form-group">
                    <label for="salary" class="control-label">מספר פלאפון הורה:</label>
                    <input type="text" class="form-control" id="parentPhone" name="parentPhone"/>
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">דואר אלקטרוני:</label>
                    <input type="text" class="form-control" id="email" name="email" />
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">עיר מגורים:</label>
                    <input type="text" class="form-control" id="city" name="city" />
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">רחוב:</label>
                    <input type="text" class="form-control" id="street" name="street" />
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">כיתה:</label>
                    <input type="text" class="form-control" id="class" name="class" />
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">סיסמא:</label>
                    <input type="text" class="form-control" id="password" name="password" />
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">תעודת הזהות שלך:</label>
                    <input type="text" class="form-control" id="teacherID" name="teacherID"   />
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
                <button type="button" id="btn_add" class="btn btn-primary">שמור תלמיד במאגר</button>
            </div>
			</form>
        </div>
    </div>
</div>

<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" dir="rtl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ערוך תלמיד</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit" >
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label for="name" class="control-label">שם:</label>
                    <input type="text" class="form-control" id="edit_name" name="edit_name"/>
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">מספר פלאפון:</label>
                    <input type="text" class="form-control" id="edit_phoneNumber" name="edit_phoneNumber"/>
                  </div>
				          <div class="form-group">
                    <label for="salary" class="control-label">מספר פלאפון הורה:</label>
                    <input type="text" class="form-control" id="edit_parentPhone" name="edit_parentPhone"/>
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">דואר אלקטרוני:</label>
                    <input type="text" class="form-control" id="edit_email" name="edit_email"/>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
                <button type="button" id="btn_edit" class="btn btn-primary">שמור תלמיד</button>
            </div>
			</form>
        </div>
    </div>
</div>
</section>
</body>
<footer>

</footer>

    <!-- script for students table -->
    <script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#employee_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "response.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete  \" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        swal("לחצת לערוך את תלמיד בעל תעודת הזהות: " + $(this).data("row-id")); 
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
            var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
console.log(g_id);
                    console.log(g_name);

		//console.log(grid.data());//
		$('#edit_model').modal('show');
					if($(this).data("row-id") >0) {
							
                                // collect the data
                                $('#edit_id').val(ele.siblings(':first').html()); // in case we're changing the key
                                $('#edit_name').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_phoneNumber').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_parentPhone').val(ele.siblings(':nth-of-type(4)').html());
                                $('#edit_email').val(ele.siblings(':nth-of-type(5)').html());
					} else {
					 alert('Now row selected! First select row, then click edit button');
					}
    }).end().find(".command-delete").on("click", function(e)
    {
//         swal('בטוח בטוח למחוק את התלמיד בעל תעודת הזהות:' + $(this).data("row-id"))
// 		.then((value) => {

//         });
		var conf =confirm(' בטוח למחוק את התלמיד בעל תעודת הזהות:' + $(this).data("row-id"));
					alert(conf);
                    if(conf){
                                $.post('response.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
										$("#employee_grid").bootgrid('reload');
                                }); 
								$(this).parent('tr').remove();
								$("#employee_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    });
});

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "response.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#employee_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
});
</script>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
//  function cash() {
//     $.ajax({
//     type:"POST",
//     url: "response.php",
//     data: ({teacherID: <?php echo $user_id ?>}),
//     success: function(){
// }

// });
// }
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>
