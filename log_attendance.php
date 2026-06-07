<?php
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id']; $today = date("Y-m-d");
    $res = mysqli_query($conn, "SELECT * FROM students WHERE student_id='$id'");
    if(mysqli_num_rows($res) > 0){
        $check = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='$id' AND DATE(arrival_time)='$today'");
        if(mysqli_num_rows($check) == 0){
            mysqli_query($conn, "INSERT INTO attendance (student_id) VALUES ('$id')");
            echo "<span class='text-success'>✅ Attendance Marked for $id</span>";
        } else { echo "<span class='text-warning'>⚠️ Already Marked for Today</span>"; }
    } else { echo "<span class='text-danger'>❌ Invalid QR Code</span>"; }
}
?>