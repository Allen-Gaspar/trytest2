<?php
include_once 'index.php';
include_once 'conn.php';
$get_cust = mysqli_query($connection,"SELECT * FROM student_table");

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href = "../enrollment/bootstrap-5.0.2-dist/css/bootstrap.min.css">
	<link rel = "stylesheet" href = "../enrollment/fontawesome-free-6.5.1-web/css/all.css"> 
	<script src = "../enrollment/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div style="margin-left:14.8%">
<div class="w3-container w3-teal">
<style>
h1 {
    font-family: 'Georgia', serif; /* Different font for headings */
    font-size: 38px; /* Size for h1 */
	line-height: 1.5;
    font-weight: bold; /* Bold font */
}
</style>
  <h1>Student</h1>
</div>
</body>
<?php
include_once 'database.php';

if (isset($_POST['addstudent'])){
    $last_name = $_POST['last_name']; 
    $first_name = $_POST['first_name']; 
    $middle_name = $_POST['middle_name']; 
    $birthday = $_POST['birthday']; 
    $address = $_POST['address']; 
    $contact_number = $_POST['contact_number']; 
    $program = $_POST['program']; 
    $mother = $_POST['mother']; 
    $father = $_POST['father']; 

    $add_student = mysqli_query($conn, "INSERT INTO student_table (last_name, first_name, middle_name, birthday, address, contact_number, program, mother, father) 
	VALUES ('$last_name', '$first_name', '$middle_name', '$birthday', '$address', '$contact_number', '$program', '$mother', '$father')");

    if ($add_student) {
        echo "<script>alert('Student added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding student!');</script>";
    }
}


?>
<div class="big-box">


</head>
<body>


<div class = "w3-panel">
<p class = "p-10">


<?php
include_once'database.php';
include_once'conn.php';
$get_cust = mysqli_query($connection, "SELECT * FROM student_table");

    ?>

<div class="search-container">
<form method = "POST">
    <div class="main mt-3">

     <div class="row">
        <div class="col-md-4">
            <button id = "myBtn" class="btn w3-teal" data-bs-toggle="modal" data-bs-target="#addStudentModal">
               <i class = "fa-solid"> Add Student </i>
            </button>
        </div>

<!-- Search -->
        <div class="col-md-8">
        <form method="POST" id="studentSearchForm">
            <div class="input-group">
                <input type="text" id="search_student" name="search_term" class="form-control" placeholder="Search students..." required>
                <button class="btn w3-teal" type="submit" name="search">Search</button>
            </div>
        </form>
    </div>
    </div>
    </div>
	</form>
</div>

<script>
$(document).ready(function() {  
    $('#search_student').on('keyup', function() {
        var query = $(this).val();
        
        if (query.length > 0) {
            $.ajax({
                url: 'search_student.php',
                method: 'POST',
                data: { query: query },
                success: function(data) {
                    $('#studentList').fadeIn();
                    $('#studentList').html(data);
                }
            });
        } else {
            $('#studentList').fadeOut();
        }
    });

    $(document).on('click', '.student-suggestion', function() {
        $('#search_student').val($(this).text());
        $('#studentList').fadeOut();
        $('#studentSearchForm').submit();
    });
   
    $(document).on('click', '.student-suggestion', function() {
        $('#search_student').val($(this).text());
        $('#studentList').fadeOut();
        $('#studentSearchForm').submit();
    });
    
    $(document).on('click', '.edit-button', function() {
        const studentData = $(this).data('student');
        $('#editStudentModal input[name="id"]').val(studentData.id);
        $('#editStudentModal input[name="lastname"]').val(studentData.last_name);
        $('#editStudentModal input[name="firstname"]').val(studentData.first_name);
        $('#editStudentModal input[name="middlename"]').val(studentData.middle_name);
        $('#editStudentModal input[name="birthday"]').val(studentData.birthday);
        $('#editStudentModal input[name="address"]').val(studentData.address);
        $('#editStudentModal input[name="contactnumber"]').val(studentData.contact_number);
		$('#editStudentModal select[name="program"]').val(studentData.program_code);
        $('#editStudentModal input[name="mother"]').val(studentData.mother);
        $('#editStudentModal input[name="father"]').val(studentData.father);
        $('#editStudentModal').modal('show');
    });
});
</script>

  <div id="studentList" class="list-group">
		
	<?php

    include_once 'database.php';
        $search_result = null;
        if (isset($_POST['search'])) {
            $search_term = $_POST['search_term'];
            $search_result = mysqli_query($conn, "SELECT * FROM student_table WHERE first_name LIKE '%$search_term%' OR last_name LIKE '%$search_term%'");
        }
    ?>

    <div class="main mt-4">
        
    <?php
    include_once 'database.php';
    $search_result = null;
    if (isset($_POST['search'])) {
        $search_term = $_POST['search_term'];
        $search_result = mysqli_query($conn, "SELECT * FROM student_table WHERE CONCAT(first_name, ' ', last_name) = '$search_term'");
    }
    ?>
	
        <?php if ($search_result && mysqli_num_rows($search_result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($search_result)): ?>
  <div class="col-md-20">
     	<div class="col-6 border-bottom"><strong></strong></div>
                <h4><div class="col-6 border-bottom"><?php echo $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['middle_name']; ?></div></h4>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-6 border-bottom"><strong>Student ID:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['id']; ?></div>
                
                <div class="col-6 border-bottom"><strong>Program:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['program']; ?></div>

                <div class="col-6 border-bottom"><strong>Birthday:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['birthday']; ?></div>

                <div class="col-6 border-bottom"><strong>Address:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['address']; ?></div>

                <div class="col-6 border-bottom"><strong>Contact Number:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['contact_number']; ?></div>

                <div class="col-6 border-bottom"><strong>Mother:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['mother']; ?></div>

                <div class="col-6 border-bottom"><strong>Father:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['father']; ?></div>

                <div class="col-6 border-bottom"><strong>Date Encoded:</strong></div>
                <div class="col-6 border-bottom"><?php echo $row['date_encoded']; ?></div>
            </div>
            <button type="button" class="btn btn-primary edit-button" data-student='<?= json_encode($row) ?>' data-bs-toggle="modal" data-bs-target="#editStudentModal">
                Edit
            </button>
			<button class="btn btn-primary">Enroll</button>
            <button class="btn btn-primary">Prospectus</button>
        </div>
    </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No students found.</p>
<?php endif; ?>
</div>

        </div>
    </div>
</div>

<div class = "container mt-3">
<!-- Add Program Modal -->
   <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel"><strong>Add Student</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class = "row">
                            <div class="col-md-3 mb-3">
                                <label for="studentLastName" class="form-label"><strong>Last Name</strong></label>
                                <input type="text" class="form-control" id="studentLastName" name="last_name" required>
                            </div>
							<div class="col-md-3 mb-3">
                                <label for="studentFirstName" class="form-label"><strong>First Name</strong></label>
                                <input type="text" class="form-control" id="studentFirstName" name="first_name" required>
                            </div>
							<div class="col-md-3 mb-3">
                                <label for="studentMiddleName" class="form-label"><strong>Middle Name</strong></label>
                                <input type="text" class="form-control" id="studentMiddleName" name="middle_name" required>
                            </div>
                            </div>
							<div class = "row">
							<div class="col-md-3 mb-3 mt-3">
                                <label for="studentBirthday" class="form-label"><strong>Birthday</strong></label>
                                <input type="date" class="form-control" id="studentBirthday" name="birthday" required>
                            </div>
							<div class="col-md-6 mb-3 mt-3">
                                <label for="studentAddress" class="form-label"><strong>Address</strong></label>
                                <input type="text" class="form-control" id="studentAddress" name="address" required>
                            </div>
							<div class="col-md-3 mb-3 mt-3">
                                <label for="studentContactNumber" class="form-label"><strong>Contact Number</strong></label>
                                <input type="text" class="form-control" id="studentContactNumber" name="contact_number" required>
                            </div>
                            </div>
							<div class = "row">
							 <div class="col-md-3 mb-3 mt-3">
                                <label><strong>Program</strong></label>
                                <select name="program" class="mt-2 form-control" required>
                                    <option value="">Select a Program</option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT program_code FROM program");
                                    while ($row = mysqli_fetch_assoc($result)): ?>
                                        <option value="<?php echo $row['program_code']; ?>"><?php echo $row['program_code']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
							<div class="col-md-3 mb-3 mt-3">
                                <label for="studentMother" class="form-label"><strong>Mother</strong></label>
                                <input type="text" class="form-control" id="studentMother" name="mother" required>
                            </div>
							<div class="col-md-3 mb-3 mt-3">
                                <label for="studentFather" class="form-label"><strong>Father</strong></label>
                                <input type="text" class="form-control" id="studentFather" name="father" required>
                            </div>
                            </div>
							<div class = "col-md-3 mt-2">
                            <button type="submit" name="addstudent" class="btn w3-teal form"><i class = "fa-solid"> Submit </i></button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
</div>




</body>
</html>
</div>

<style>
.big-box {
    width: 1110px; /* Adjust width as needed */
    height: 550px; /* Adjust height as needed */
    background-color: #f0f0f0; /* Light gray background */
    border: 2px solid #ccc; /* Optional border */
    border-radius: 8px; /* Optional rounded corners */
    margin: 20px; /* Optional margin */
}
</style>


