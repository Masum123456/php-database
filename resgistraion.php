<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
</head>

<body>

    <?php 
    session_start();
    require "db_Connect.php";

		$fname = $lname = $email=  $remail=$gender=$password=$userName="";
		$firstNameErr = $lastNameErr = $emailErr = $remailErr=$genderErr=$passwordErr=$userNameErr="";

		if($_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['submit']))
            {
                $temp=0;
                $fname= mysqli_real_escape_string($conn, $_POST['fname']);
                $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $remail = mysqli_real_escape_string($conn, $_POST["remail"]);
                $gender= mysqli_real_escape_string($conn, $_POST["gender"]);
                $password = mysqli_real_escape_string($conn, $_POST["password"]);
                $userName = mysqli_real_escape_string($conn, $_POST["userName"]);
            }

			if(empty($_POST['fname'])) {
				$firstNameErr = "Please fill up the firstname"; $temp=1;
			}

			if(empty($_POST['lname'])) {
				$lastNameErr = "Please fill up the lastname"; $temp=1;
			}

			if(empty($_POST['email'])) {
				$emailErr = "Please fill up the email"; $temp=1;
			}

            if(empty($_POST['userName'])) {
				$userNameErr = "Please fill up the username"; $temp=1;
			}
			
            if(empty($_POST['password'])) {
                $passwordErr = "Please fill up the password"; $temp=1;
            }
        
            if(empty($_POST['remail'])) {
                $remailErr = "Please fill up the email"; $temp=1;
            }


            if ($temp==0)
           {
            
               $sql_insert = "INSERT INTO info (fname, lname, email, gender, password, userName) VALUES ('".$fname."','".$lname."','".$email."','".$gender."','".$password."','".$userName."')";
               if (mysqli_query($conn, $sql_insert)==TRUE)
               {
                 echo "inserted successfully";
                 $_SESSION['message']="Successfully signed up!";
                 header ('location: login.php');
               }
               else{
                    $_SESSION['message']="Could not signed up!";
                    header('location: $_SERVER["PHP_SELF"]');
                 }
            }
			
		}
    
	?>

    <h1>Registration Form Self</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="fname" value="<?php echo $fname ?>">
        <p><?php echo $firstNameErr; ?></p>

        <br>

        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lname" value="<?php echo $lname ?>">
        <p><?php echo $lastNameErr; ?></p>

        <br>
        <br>

        <label for="gender">Gender</label>
        <input type="radio" name="gender" id="male" value="male">
        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="female">
        <label for="female">Female</label>
        <p><?php echo $genderErr; ?></p>
        <br>
        <br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email ?>">
        <p><?php echo $emailErr; ?></p>

        <br>


        <label for="userName">User Name</label>
        <input type="text" id="userName" name="userName" value="<?php echo $userName ?>">
        <p><?php echo $userNameErr; ?></p>

        <br>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $password ?>">
        <p><?php echo $passwordErr; ?></p>

        <br>

        <label for="remail">Email</label>
        <input type="email" id="remail" name="remail" value="<?php echo $remail ?>">
        <p><?php echo $remailErr; ?></p>

        <br>

        <input
            style="width: 10%; height: 30px;  margin-top:15px; margin-bottom:15px;font-family:Courier, monospace; font-size:17px"
            type="submit" name="submit" value="Sign up">

    </form>

</body>

</html>