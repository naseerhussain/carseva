<?php

	session_start();
    $conn = mysql_connect("localhost:3306", "root", "pwd"); // Establishing Connection with Server

    if(! $conn){
        die("Connection failed: " . mysql_error());
    }

    $mobile = $_GET['mobile'];

    mysql_select_db('carseva');

    $sql = 'SELECT name,mobile,password FROM login_details where mobile="'. $mobile .'"';

    $ret = mysql_query( $sql, $conn );

    if(! $ret )
    {
        die('Could not get data: ' . mysql_error());
    }
    $arr = array();
    while($row = mysql_fetch_array($ret, MYSQL_ASSOC))
    {
        $arr[] = $row;
    }
    $details = json_encode($arr);
    echo $details;
    mysql_close($conn);


?>