<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
        <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
        <title>Document</title>
    
    <body> 
    <div class="container">
        <form method="POST"> <!-- ✅ Added method="POST" -->
        <div class="row align-items-center justify-content-center vh-100">
            <div class="row justify-content-center col-md-5 p-5 bg-warning">
                <!-- form content as-is -->
                <div class="row">	
                    <div class="col-md-12">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">Select a Role</option>
                            <option value="admin">Admin</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <button type="submit" name="btnlogin" class="form-control bg-secondary">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form> <!-- ✅ close form -->

        <?php
            include_once 'Class/class.php';
            $u = new User();

            if(isset($_POST['btnlogin'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $data = $u->login($username, $password); // ✅ FIXED: added $ sign

                if($row = $data->fetch_assoc()){
                    if($row['role'] == 'admin'){ // ✅ role should match too
                        echo '
                        <script>
                        window.open("allen.php","_self");
                        </script>
                        ';
                    } else {
                        echo 'Invalid role';
                    }
                } else {
                    echo 'Invalid login';
                }
            }
        ?>
	</body>

</html>
