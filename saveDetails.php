<?PHP
	session_start();
    $conn = mysql_connect("localhost:3306", "root", "pwd"); // Establishing Connection with Server

    if(! $conn){
        die("Connection failed: " . mysql_error());
    }
    $name = $_GET['name'];
    $email = $_GET['email'];
    $mobile = $_GET['mobile'];
    $pwd = $_GET['password'];
    
    echo $name,$email,$mobile,$pwd;

    mysql_select_db('carseva');
    $command = "SELECT MAX(id) as maxid FROM login_details";
    $id=0;
    $result = mysql_query($command, $con);
    while ($row = mysql_fetch_assoc($result)){
        $id = $row['maxid'];

    }
    $id++;

    $sql = "INSERT INTO login_details(id,name,email,mobile,password)VALUES('$id','$name','$email','$mobile','$pwd')";
    $insert = mysql_query( $sql, $conn );

    if (! $insert) {
        die('Could not enter data: ' . mysql_error());
    } else {
        mysql_close($conn);
        header('Location: index.php');
    }


?>
