<?php
$connect = mysqli_connect("localhost","root", "","isnoyra_fitcher");
$connect->set_charset("utf8");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM teachers 
	WHERE city LIKE '%".$search."%' 
	";
}
else
{
	$query = "
	SELECT * FROM teachers ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Teacher Name</th>
							<th>City</th>
							<th>Description</th>
							<th>Price</th>
							<th>Email</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{

		$output .= '
			<tr>
				<td>'.$row["fullName"].'</td>
				<td>'.$row["city"].'</td>
				<td>'.$row["description"].'</td>
				<td>'.$row["price"].'</td>
				<td>'.$row["email"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>