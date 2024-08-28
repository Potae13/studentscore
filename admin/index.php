<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require '../header.php'; ?>
</head>
<body>
    <?php
        require '../alert.php';
    
    ?>

    <div class="container mt-5">
        <div class="col-6 p-3 mx-auto shadow rounded">
            <h1 class="text-primary text-center "><b>เข้าสู่ระบบ แอดมิน </b><i class="fa-solid fa-user-shield"></i></h1>
            <form action="ck_admin.php" method="POST">
                <input class="form-control mb-2" type="text" name="username" placeholder="กรอกusername" required>
                <input class="form-control mb-2" type="password" name="password" placeholder="กรอกpassword" required>
                <button class="btn btn-primary form-control mb-2" type="submit" name="btn_login"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</button>
            </form>
            <a class="btn btn-warning form-control " href= "../"><i class="fa-solid fa-user-tie"></i> กลับไปหน้าหลัก</a>

        </div>

</body>
</html>