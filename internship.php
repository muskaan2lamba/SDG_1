<?php
include("connect.php");
$roll_no = $_POST['roll_no'];
$topic = $_POST['topic'];
$year = $_POST['year'];
$duration = $_POST['duration'];
$starting_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$myfile = $_POST['myfile'];

if(!empty($roll_no) || !empty($topic) || !empty($year) || !empty($duration) || !empty($start_date) || !empty($end_date)){
        
        $INSERT = "INSERT Into internship_data(roll_no,topic,year_new,starting_date,end_date,approval_status,completion_status,certificate,duration,myfile,comment) values (?,?,?,?,?,'Pending','in-progress','Not Uploaded Yet',?,?,'No comment')";


        //Prepare statement
        $stmt = $conn->prepare("SELECT topic,roll_no From internship_data Where topic = ? AND roll_no = ? Limit 1");
        $stmt->bind_param("ss",$topic,$roll_no);
        $stmt->execute();
        
        $stmt->store_result();
        
        $rnum = $stmt->num_rows;
        
        if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssissis",$roll_no,$topic,$year,$starting_date,$end_date,$duration,$myfile);
            $stmt->execute();
            header('location:page_2.php');
            echo "Applied Successfully";
        }else{
            echo "Already Applied for this internship";
        }
        $stmt->close();
        $conn->close();
        
    
}
else{
    echo "All field are required";
    die();
}
?>