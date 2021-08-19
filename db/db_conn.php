<?php
//mysql connection (hostname, username, password, dbname);
$conn = new mysqli('localhost', 'jay', 'admin', 'assignment-2');

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
