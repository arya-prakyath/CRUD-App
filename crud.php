<?php
    session_start();
    unset($_SESSION['reloaded']);
    if(!isset($_SESSION["crudLogged"]))
    {
        echo "<script>window.location='./';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- My CSS -->
    <link rel="shortcut icon" href="favicon.ico">
    <title>THE_ARYA's Crud</title>

    <!-- CSS: Data table -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- CSS: Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Guntur:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">


    <!-- JS: Fonts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src='//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
    <script>
        // To call the DataTable() for #myTable
        // $(document).ready( function () 
        // {
        //     $('#myTable').DataTable();
        // } );

        // To call the DataTable() for #myTable and change 'show entries value'
        $(document).ready(function () {
            $('#myTable').dataTable(
                {
                    "pageLength": 101
                });
        });
    </script>
</head>

<body>

    <a href="index.php"><button title="Logout" id="logout">Logout</button></a>
    <a href="#pageBottom" id='btmBtn'><button title="Goto the bottom of the page">&darr;</button></a>

    <!-- Create the form -->
    <div id="form" class='container'>
        <form action='action.php' method="POST">
            <h1>THE_ARYA's CRUD</h1>
            <div class='box'>
                <input type="text" id='title' name='title' placeholder="Title:">
            </div>
            <br>
            <div class='box'>
                <textarea id='desc' name='desc' placeholder="Description:"></textarea>
            </div>
            <br>

            <div id='sub'>
                <button type="submit" id='submit'>Add</button>
                <button type="reset" name='reset' id="reset">Reset</button>
            </div>
            <br>
        </form>
    </div>

    <!-- Edit form -->
    <div id="editForm" class='container'>
        <form action='action.php' method="POST">
            <h1>EDIT THE NOTE</h1>
            <input id='edtt' name='edtt' style='visibility: hidden;'>
            <div class='box'>
                <input type="text" id='editTitle' name='editTitle' style='color:black;' placeholder="Edit Title:">
            </div>
            <br>
            <div class='box'>
                <textarea id='editDesc' name='editdesc' style='color:black;' placeholder="Edit Description:"></textarea>
            </div>
            <br>

            <div id='sub'>
                <Button type="submit" name='edtsubmit' id='edtsubmit'>Update</Button>
                <button type="reset" name='edtreset' id="edtreset">Reset</button>
            </div>
            <br>
        </form>
    </div>

    <br>
    
    <!-- Start the table -->
    <div style='width:75%; margin: auto;' id='tableDiv'>
        <hr style='border:3px solid  rgba(20, 21, 22, 0.644);'>
        <table id='myTable'>
            <thead style='background-color: rgba(20, 21, 22, 0.644); border:5px solid black;'>
                <tr>
                    <th>Sl no.</th>
                    <th>DATE</th>
                    <th>TITLE.</th>
                    <th>DESCRIPTION</th>
                    <th>Action</th>
                </tr>
            </thead>

            <!-- Add new records to the table -->
            <?php
                require '_connect.php';
                $sqlStat = "SELECT * from `crude`;";
                $ress = mysqli_query($conn, $sqlStat);
                $sl = 1;
                
                // while( $data = mysqli_fetch_assoc($ress) ) //(asAssocArray)
                // {   
                //     echo '<tr>
                //             <td>'.$sl.'</td>
                //             <td>'.$data["Date Added"].'</td>
                //             <td>'.$data["Title"].'</td>
                //             <td>'.$data["Description"].'</td>
                //             <td><button class="editBtn" id='.$data["No"].' style="width:1.8cm;">Edit</button>
                //                 <button class="delBtn" id=x'.$data["No"].' style="width:1.8cm;">Delete</button>
                //             </td>
                //         </tr>';
                //     $sl++;
                // }

                // Aliter
                $data = mysqli_fetch_all($ress); //(asNumericArray)
                foreach ($data as $item) {
                    echo '<tr>
                            <td>'.$sl.'</td>
                            <td>'.$item[1].'</td>
                            <td>'.$item[2].'</td>
                            <td>'.$item[3].'</td>
                            <td><button class="editBtn" id='.$item[0].' style="width:1.8cm;">Edit</button>
                                <button class="delBtn" id=x'.$item[0].' style="width:1.8cm;">Delete</button>
                            </td>
                        </tr>';
                        $sl++;
                }
            ?>
        </table>
    </div>

    <!-- Copy rights -->
    <hr style='border:3px solid  rgba(20, 21, 22, 0.644);'>
    <a href="#form" id='tpBtn'><button title="Goto the top of the page">&uarr;</button></a>
    <div id='pageBottom' style='background-color:#8dabca85; width:100%; height:2cm;'>
        <br>COPY RIGHTS &copy; THE_ARYA. ALL RIGHTS RESERVED - 2020.
    </div>
    <br>

    <!-- Handling edit and delete button -->
    <script>
        // Edit Button Action
        var edt = document.getElementsByClassName("editBtn");
        Array.from(edt).forEach((element) => {
            // console.log(element);
            element.addEventListener("click", (e) => {
                // console.log('working: ', e.target);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[2].innerText;
                desc = tr.getElementsByTagName('td')[3].innerText;
                document.getElementById("form").style.display = "none";
                document.getElementById("editForm").style.display = "block";
                document.getElementById("tableDiv").style.display = "none";
                document.getElementById("editTitle").value = title;
                document.getElementById("editDesc").innerText  = desc;
                document.getElementById("edtt").value = e.target.id;
            });
        });

        // Delete Button Action
        var del = document.getElementsByClassName("delBtn");
        Array.from(del).forEach((element) => {
            // console.log(element);
            element.addEventListener("click", (e) => {
                // var tr = e.target.parentNode.parentNode;
                var sno = e.target.id.substr(1,);

                if (confirm('Do you really want to delete it?')) {
                    // Add to recycleBin
                    tr = e.target.parentNode.parentNode;
                    title = tr.getElementsByTagName('td')[2].innerHTML;
                    desc = tr.getElementsByTagName('td')[3].innerHTML;
                    localStorage.setItem(title, desc);

                    window.location = `action.php?delete=${sno}`;
                }
            });
        }); 
    </script>


    <!-- Shortcut to search (Alt+anyKey or click Esc/Enter to come out of search) -->
    <script>
        function isSearch(event) {
            let srch = document.querySelector('input[type="search"]');

            if (event.key == 'Escape' || event.key == 'Enter') {
                console.log('BLURRED');
                srch.blur();
            }
            else if (event.shiftKey && event.which == 191) {
                srch.focus();
                console.log('done');
                return;
            }
            else {
                return;
            }
        }
        document.addEventListener('keyup', isSearch);

    </script>
    
</body>
</html>

