<?php 
session_start();
require "db_Connect.php";
    $password=$userName="";
    $passwordError=$usernameError=$errorMsg="";

if($_SERVER['REQUEST_METHOD'] == "POST"){


    if (isset($_POST['login']))
    {
        $add=0;
        $userName=mysqli_real_escape_string($conn, $_POST['userName']);
        $password=mysqli_real_escape_string($conn, $_POST['password']);
    

        if(empty($_POST['userName'])) {
            $usernameError = "Please fill up the username"; $add=1;
        }
       
        if(empty($_POST['password'])) {
            $passwordError = "Please fill up the password"; $add=1;
        }
  
        if ($add==0)
        {
            $sql_login = "SELECT * FROM info WHERE userName='$userName' AND password='$password'";
            $sql_login_result = mysqli_query($conn, $sql_login);
            if($row=mysqli_fetch_array($sql_login_result))
            {
                if ($row['userName']=$userName && $row['password']=$password)
                {
                    $_SESSION['userName'] = $userName;
                    setcookie ('userName', $email, time()+86400);
                    /* setcookie ('password', $password, time()+86400); */
                }
                header ("location: sucess.php");
            }
            else
            {
                $_SESSION["message"]="Invalid Email or Password!";
            }
        }
    }
}	?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <label for="username">User Name</label>
        <input type="text" id="username" name="userName" value="<?php echo $userName ?>">
        <p><?php echo $usernameError; ?></p>
        <br>
        <label for="passworde">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $password ?>">
        <p><?php echo $passwordError; ?></p>
        <br>
        <br>
        <p><?php 
                if (isset($_SESSION['message']))
                    {
                        echo "<span style='color:red ; font-family: Courier, monospace;font-size:15px'>{$_SESSION['message']}</span>";
                        unset ($_SESSION['message']);
                    }; 
            ?>
        </p>
        <input
            style="width: 10%; height: 30px;  margin-top:15px; margin-bottom:15px;font-family:Courier, monospace; font-size:17px"
            type="submit" name="login" value="Submit">
    </form>

</body>

</html>