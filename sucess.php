<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <?php
    session_start();
    echo "Welcome, ";
    echo $_SESSION['userName']."!";
    unset ($_SESSION['userName']);
    unset ($_SESSION['message']);
?>

</body>

</html>