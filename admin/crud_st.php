<?php
    require '../conn.php';
    

    $sql = "SELECT * FROM students LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require '../header.php' ?> ;
</head>
<body>
    
    <div class="container mt-5">
        <div class="col-8 mx-auto p-3 rounded shadow bg-white">
            <a href="addst.php"class="btn btn-outline-primary form-control mb-3">เพิ่มนักเรียน</a>
            <form action="search.php" method="POST">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อนักเรียน">
                <button class="form-control btn btn-success mt-3" type="submit" name="btn_search">ค้นหา<i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="home.php" class="btn btn-warning mt-3">กลับไปหน้าหลัก</a>
        </div>
        </form>
        
       <div class="col-8 mx-auto p-3 rounded shadow bg-white mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">เลขประจำตัวนักเรียน</th>
                        <th scope="col">คำนำหน้า</th>
                        <th scope="col">ชื่อ-สกุล</th>
                        <th scope="col">แก้ไข</th>
                        <th scope="col">ลบ</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?= $row['noid'] ?> </th>
                        <th scope="row"><?= $row['prefix'] ?> </th> 
                        <td><?= $row['fname'],' ',$row['lname'] ?></td>
                        <td><a href="updatest.php?noid=<?= $row['noid']?>" class="btn btn-warning">แก้ไข</a></td>
                        <td><a href="delst.php?del=<?= $row['noid']?>" class="btn btn-danger">ลบ</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
       </div>
    </div>
</body>
</html>