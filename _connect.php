 <!-- Load DataBase -->
    <?php
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'THE_ARYA_CRUDE';
        
        $conn = mysqli_connect($host, $user, $pwd, $db);
        if(!$conn)
        die('Connection was not sucessfull<br>'.mysqli_connect_error());
    ?>







