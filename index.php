<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="shield.ico">
    <?php require 'header.php'; ?>
    
</head>

<body>
    <?php
        require 'alert.php';
    
    ?>
    <div class="container mt-5">
        <div class="col-12 col-md-4 col-lg-4 p-3 mx-auto shadow rounded bg-white">
            <h1 class="text-primary text-center "><b>เข้าสู่ระบบ<i class="fa-solid fa-shield-halved"></i></b></h1>
            <form action="ck.php" method="POST">
                <input class="form-control mb-2" type="number" name="idcard" placeholder="กรอกเลข13หลัก" required>
                <input class="form-control mb-2" type="password" name="password" placeholder="วันเกิด" required>
                <button class="btn btn-primary form-control mb-2" type="submit" name="btn_login"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</button>
            </form>
            <a class="btn btn-success form-control " href= "admin/"><i class="fa-solid fa-user-tie"></i> ไปยังหน้าแอดมิน</a>
            <style>
        body {
            background-image: url('DSC00041.JPG');
            background-repeat: no-repeat ;
            background-attachment: fixed ; 
            background-size: cover;
        }
</style>
        </div>

    </div>

</body>

</html>