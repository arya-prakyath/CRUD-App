<?php
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="shortcut icon" href="favicon.ico">
    <title>Notes | THE_ARYA</title>
</head>

<body>
    <!-- Add the filled form to DataBase -->
    <?php
        require '_connect.php';

        if(isset($_SESSION['reloaded'])){
            unset($_SESSION['reloaded']);
            echo "<script>window.location='crud.php'</script>";
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["edtt"])) {
                $edtt = $_POST["edtt"];
                $title = $_POST["editTitle"];
                $desc = $_POST["editdesc"];

                if ($title == '' and $desc == '') {
                    echo "<script>alert('Empty Note cannot be updated');</script>";
                    echo "<script>window.location='crud.php'</script>";
                    exit;
                } 
                else if ($title == '') {
                    echo "<script>alert('Note without Title cannot be updated');</script>";
                    echo "<script>window.location='crud.php'</script>";
                    exit;
                } 
                else {
                    $sqlStat = "UPDATE `crude` SET `Title` = '$title', `Description` = '$desc' WHERE `crude`.`No` = $edtt;";
                    $res = mysqli_query($conn, $sqlStat);
                    if ($res)
                        echo '<div class="pl-5 m-0 jumbotron jumbotron-fluid bg-secondary">
                        <h1 class="display-4">Note was successfully updated</h1>
                        <p class="lead mt-5">
                            <a class="btn btn-outline-dark btn-lg" href="crud.php" role="button">Go Back</a>
                        </p>
                        </div>';
                    else
                        echo '<div class="pl-5 m-0 jumbotron jumbotron-fluid bg-danger">
                        <h1 class="display-4">Note was not updated due to server error</h1>
                        <p class="lead mt-5">
                            <a class="btn btn-outline-warning btn-lg" href="crud.php" role="button">Go Back</a>
                        </p>
                        </div>';
                }
            } 
                
            else {
                $title = $_POST["title"];
                $desc = $_POST["desc"];

                if ($title == '' and $desc == '') {
                    echo "<script>alert('Empty Note cannot be added');</script>";
                    echo "<script>window.location='crud.php'</script>";
                    exit;
                } 
                else if ($title == '') {
                    echo "<script>alert('Note without Title cannot be added');</script>";
                    echo "<script>window.location='crud.php'</script>";
                    exit;
                } 
                else {
                    $sqlStat = "INSERT INTO `crude` (`Title`, `Description`) VALUES ('$title', '$desc');";
                    $res = mysqli_query($conn, $sqlStat);
                    if ($res)
                        echo '<div class="pl-5 m-0 jumbotron jumbotron-fluid bg-secondary">
                        <h1 class="display-4">Note was successfully added</h1>
                        <p class="lead mt-5">
                            <a class="btn btn-outline-dark btn-lg" href="crud.php" role="button">Go Back</a>
                        </p>
                        </div>';
                    else
                        echo '<div class="pl-5 m-0 jumbotron jumbotron-fluid bg-danger">
                        <h1 class="display-4">Note was not added due to server error</h1>
                        <p class="lead mt-5">
                            <a class="btn btn-outline-warning btn-lg" href="crud.php" role="button">Go Back</a>
                        </p>
                        </div>';
                }
            }

        } 

        else {
            if (isset($_GET["delete"])) {
                $sno = $_GET["delete"];
                $sqlStat = "DELETE FROM `crude` WHERE `crude`.`No` = '$sno'";
                $res = mysqli_query($conn, $sqlStat);
                if ($res)
                    echo "<script>alert('Sucessfully deleted');window.location = 'crud.php';</script>";
                else
                    echo 'The Note was not deleted because of ----> ' . mysqli_error($conn);
            }
        }

        $_SESSION['reloaded'] = true;
    ?>

    <!-- Copy rights -->
    <hr class='m-0'style='border:3px solid  rgba(20, 21, 22, 0.644);'>
    <div id='pageBottom' style='background-color:#8dabca85; width:100%; height:2cm; text-align:center'>
        <br>COPY RIGHTS &copy; THE_ARYA. ALL RIGHTS RESERVED - 2020.
    </div>
    <hr class='m-0' style='border:3px solid  rgba(20, 21, 22, 0.644);'>
    <br>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>