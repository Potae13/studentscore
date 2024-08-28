<?php

    session_start();
    require 'conn.php';

    if(!isset($_SESSION['key']) && !isset($_SESSION['noid'])){
        header("location: index.php");
    }
    $noid = $_SESSION["noid"];

    try{
        $sql = "SELECT prefix,fname,lname,class,no FROM students WHERE noid = :noid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('noid',$noid,PDO::PARAM_INT);
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
    <title>คะแนนของคุณ</title>
    <link rel="icon" type="image/x-icon" href="shield.ico">
    <?php require 'header.php'; ?>
</head>
    
<body>
    <?php
        require 'alert.php';
        

    ?>
    <div class="container mt-5">
        <div class="col-12 col-md-8 col-lg-6 mx-auto shadow-lg rounded p-3">
            <h1>ยินดีต้อนรับ <?= $fetch["prefix"].$fetch["fname"].$fetch["lname"]?></h1>
            <p>ห้อง<?= $fetch["class"]?> เลขที่ <?=$fetch["no"]?> </p>
            <a class="btn btn-outline-danger" href="remove.php">ออกจากระบบ</a>
        </div>

        <?php
            $sql1 = "SELECT 100-sum(point) AS now_point FROM history WHERE noid = :noid";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bindParam('noid',$noid,PDO::PARAM_INT);
            $stmt1->execute();
            $fetch = $stmt1->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="col-12 col-md-9 col-lg-9 mx-auto shadow-lg rounded p-3 mt-5">
            <h3 class="text-center">ประวัติ</h3>
            <h5 class="text-center"><b>คะแนนปัจจุบัน <?= $fetch["now_point"] ?></b></h5>
            
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="table-danger">ลำดับ</th>
                        <th class="table-danger" >เรื่อง</th>
                        <th class="table-danger">คะแนน</th>
                        <th class="table-danger">เวลา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $newscore = 100;
                    $sql = "SELECT h.description,h.point,h.date_add FROM students s RIGHT JOIN history h ON s.noid = h.noid WHERE s.noid = :noid";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':noid',$noid,PDO::PARAM_INT);
                    $stmt->execute();
                    $rowcount = $stmt->rowCount();
                    $count = 1;
                    if($rowcount>0){
                        while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $newscore = $newscore - $fetch['point'];
                        ?>    

                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= $fetch["description"] ?></td>
                            <td class="text-danger"><b><?= -$fetch["point"] ?></b></td>
                            <td><?= $fetch["date_add"] ?></td>
                        </tr> 
                    <?php 
                        }
                    
                    ?>
                </tbody> 
                <thead>
                    <tr>
                        <td colspan="2" class="text-center text-Warning	 table-dark"><b>เหลือคะแนน</b></td>
                        <td class="text-Warning table-dark"><b><?=$newscore ?></b></td>
                    </tr>
                </thead>
                <?php
                }else{
                ?>
                <tfoot>
                    <tr>
                        <td colspan="4">ยังไม่มีการหักคะแนน</td>
                    </tr>
                </tfoot><?php
                    }
                    ?>
            </table>
            
        </div>
</div>
</body>
</html>