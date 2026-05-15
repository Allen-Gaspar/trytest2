<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
        <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
        <title> Activity </title>
    </head>
	<body>
		<form method="POST">
		<div class = "container col-md-6 border border-dark p-5 mt-5">
		    <div class="row mt-1">
				<div class="col-md-12">
					<label for=""> Id Number </label>
					<input type="text" name="idnum" placeholder="Enter your ID Number" class="form-control">
				</div>	
			</div>
			<div class="row mt-3">
				<div class="col-md-6">
					<label for=""> First Name </label>
					<input type="text" name="fname" placeholder="Enter your First Name" class="form-control">
				</div>
				<div class="col-md-6">
					<label for=""> Last Name </label>
					<input type="text" name="lname" placeholder="Enter your Last Name" class="form-control">
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-4">
					<label for=""> Course </label>
					<select name="course" class="form-select">
						<option value=""> Select a Course </option>
						<option value="BSCS"> BSCS </option>
						<option value="BSEN"> BSEN </option>
						<option value="BSOA"> BSOA </option>
						<option value="BTVTED"> BTVTED </option>
						<option value="BSAIS"> BSAIS </option>
						<option value="BSCA"> BSCA </option>
					</select>
				</div>
				<div class="col-md-4">
					<label for=""> Gender </label>
					<select name="gender" class="form-select">
						<option value=""> Select a Gender </option>
						<option value="Male"> Male </option>
						<option value="Female"> Female </option>
						<option value="Other"> Other </option>
					</select>
				</div>
				<div class="col-md-4">
					<label for=""> Birthday </label>
					<input type="date" name="birthday" class="form-control">
				</div>
			</div>
				<div class="row mt-3">
					<div class="col-md-12">
						<label for=""> Address </label>
						<input type="text" name="address" placeholder="Enter your Address" class="form-control">
					</div>
				</div>
				
				<div class="row mt-5">
					<div class="col-md-4">
						<input type="submit" name="btnadd" value="Add" class="form-control btn btn-primary">
					</div>
					<div class="col-md-4">
						<input type="submit" name="btnupdate" value="Update" class="form-control btn btn-primary">
					</div>
					<div class="col-md-4">
						<input type="submit" name="btndelete" value="Delete" class="form-control btn btn-primary">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	include_once'Class/class.php';
	$u = new User();
	if(isset($_POST['btnadd'])){
		$userid = $_POST['idnum'];
		$fn = $_POST['fname'];
		$ln = $_POST['lname'];
		$course = $_POST['course'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		$address = $_POST['address'];
		
		echo $u->addstudent($userid,$fn,$ln,$course,$gender,$birthday,$address);
	}
	
	$data = $u->displayall();
	echo '
		<table class = "table table-bordered">
			<tr>
				<th> User Id </th>
				<th> Firstname </th>
				<th> Lastname </th>
				<th> Course </th>
				<th> Gender </th>
				<th> Birthday </th>
				<th> Address </th>
				<th> </th>
			</tr>
			
	';
	while($row = $data->fetch_assoc()){
		echo '
			<tr>
				<td> '.$row['userid'].' </td>
				<td> '.$row['firstname'].' </td>
				<td> '.$row['lastname'].' </td>
				<td> '.$row['course'].' </td>
				<td> '.$row['gender'].' </td>
				<td> '.$row['birthday'].' </td>
				<td> '.$row['address'].' </td>
				<td> <button type="button" class= "btn btn-primary" onclick="viewdata(&quot;'.$row['userid'].'&quot;'.$row['firstname'].'&quot;'.$row['lastname'].'&quot;'.$row['course'].'&quot;'.$row['course'].'&quot;'.$row['gender'].'&quot;'.$row['birthday'].'&quot;'.$row['address'].')"> View </button> </td>
			</tr>
		';
	}
	echo '</table>';
	
	if(isset($_POST['btnupdate'])){
		$userid = $_POST['idnum'];
		$fn = $_POST['fname'];
		$ln = $_POST['lname'];
		$course = $_POST['course'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		$address = $_POST['address'];
		
		echo $u->updatedata($userid,$fn,$ln,$course,$gender,$birthday,$address);
	}
	
	if(isset($_POST['btndelete'])){
		$userid = $_POST['idnum'];
		
		echo $u->deletedata($userid);
	}
?>

<script>
	function viewdata(userid,firstname,lastname,course,gender,birthday,address){
		document.getElementById("userid").value=userid;
		document.getElementById("firstname").value=firstname;
		document.getElementById("lastname").value=lastname;
		document.getElementById("course").value=course;
		document.getElementById("gender").value=gender;
		document.getElementById("birthday").value=birthday;
		document.getElementById("address").value=address;
	}
</script>