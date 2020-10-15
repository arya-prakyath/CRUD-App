<?php
    session_start();
    session_unset();
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="shortcut icon" href="favicon.ico">
    <title>THE_ARYA's Crude</title>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Guntur:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">

<body>
    <div id="form" class='container'>
        <form action='./' method="POST">
            <h1>THE_ARYA's CRUD</h1>
            <div class='box'>
                <input class='inp' type="text" id='username' name='username' placeholder="Username">
            </div>
            <br>
            <div class='box'>
                <input class='inp' type="password" id='password' name='password' placeholder="Password">
            </div>
            <br>

            <div id='sub'>
                <button type="submit" id='submit'>Login</button>
                <button type="reset" name='reset' id="reset">Reset</button>
            </div>
            <br>
        </form>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            
            if(!($username=='arya' and $password=='crud101'))
            {
                echo "<script>alert('F*** you. You are not authorized');</script>";
                exit();
            }
            else{
                $_SESSION["crudLogged"] = true;
                echo "<script>window.location='crud.php';</script>";
                exit();
            }
        }
    ?>
</body>
</html>