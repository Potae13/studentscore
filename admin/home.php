<?php

    session_start();
    require '../conn.php';

    if(!isset($_SESSION['key']) && !isset($_SESSION['username'])){
        header("location: home.php");
    }
    $username = $_SESSION['username'];
    try{
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);


    }catch(PDOException $e){
        echo $e->getMessage();
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require '../header.php'; ?>
</head>
<body style="background-color: #e4e4e4;">
    <?php
        require '../alert.php';
    
    ?>

    <div class="container mt-5">
    <div class="col-12 col-md-8 col-lg-6 mx-auto bg-white rounded p-3">
        <h3 class="text-success text-center"><b>ระบบหักคะแนนความประพฤติ </b></h3>
        <hr>
        <p>สวัดดี <?= $fetch['fullname'] ?></p>
        <a href="../remove.php" class="btn btn-danger">ออกจากระบบ</a>
    </div>
    <div class="col-12 col-md-8 col-lg-6 mx-auto bg-white rounded p-3 mt-3">

        <a href="add_event.php" class="btn btn-primary form-control mb-2">หักคะแนนนักเรียน</a>
        <a href="crud_st.php" class="btn btn-warning form-control">เพิ่มลบและแก้ไขข้อมูลนักเรียน</a>
    </div>



    </div>
</body>
</html>