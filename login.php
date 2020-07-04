<?php
include("connect.php");
session_start();
$username = $_POST['username'];
$roll_no = $_POST['roll_no'];
$contact_no = $_POST['contact_no'];
$pass = $_POST['pass'];

if(!empty($username) || !empty($roll_no) || !empty($contact_no) || !empty($pass)){

        $SELECT = "SELECT roll_no From login Where roll_no = ? Limit 1";
        $INSERT = "INSERT Into login(roll_no,username,pass,contact_no) values (?,?,?,?)";

        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$roll_no);
        $stmt->execute();
        $stmt->bind_result($roll_no);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssi",$roll_no,$username,$pass,$contact_no);
            $stmt->execute();
            $_SESSION['user_name']=$username;
            $_SESSION['roll_no']=$roll_no;
            header('location:page_2.php');
        
        $stmt->close();
        $conn->close();
    
}else{
    echo "All field are required";
    die();
}
?>