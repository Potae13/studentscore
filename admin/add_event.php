<?php

    session_start();
    require '../conn.php';

    if(!isset($_SESSION['key']) && !isset($_SESSION['username'])){
        header("location: index.php");
    }

    if(isset($_POST['st1'])){
        $noid = $_POST['noid'];
        try{
            $sql = "SELECT * FROM students WHERE noid = :noid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':noid',$noid,PDO::PARAM_INT);
            $stmt->execute();
            $fetch=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() < 1){
                echo 'ไม่มีข้อมูลนักเรียน';
                $fetch = ['prefix'=>'', 'fname'=>'', 'lname'=>'', 'class'=>'', 'no'=>''];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
       
    }else{
        $fetch = ['prefix'=>'', 'fname'=>'', 'lname'=>'', 'class'=>'', 'no'=>''];
    }

    if(isset($_POST['save_data'])){
        $noid = $_POST['noid'];
        $point = $_POST['point'];
        $dcs =$_POST['dcs'];

        date_default_timezone_set('Asia/Bangkok');
        $date_add = date('d/m/Y H:i:s');

        try{
            $sql = "INSERT INTO history(noid,description,point,date_add)
                    VALUES(:noid,:description,:point,:date_add)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':noid',$noid,PDO::PARAM_INT);
            $stmt->bindParam(':description',$dcs,PDO::PARAM_STR);
            $stmt->bindParam(':point',$point,PDO::PARAM_STR);
            $stmt->bindParam(':date_add',$date_add,PDO::PARAM_STR);
            $result = $stmt->execute();
           
            if($result){
                $_SESSION['save_success' ] = true;
                header("Refresh: 2");
            }else{
                $_SESSION['error'] = true;
                header("Refresh: 2");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน</title>
    <?php require '../header.php' ?>
</head>
<body style="background-color: #e4e4e4;">
    <div class="container mt-5">

        <div class="col-12 col-md-8 col-lg-6 mx-auto p-3 rounded shadow bg-white">
            <h3 class="text-center text-danger"><b>หักคะแนน</b></h3>
            <hr>
            <?php require '../alert.php' ?>
            <form action="" method="POST">
                <input class="form-control mb-2" type="number" name='noid' placeholder="กรอกเลขประจำตัว" value="<?= $noid?>">
                <button class="form-control btn btn-success " type="submit" name='st1'>ดึงข้อมูลนักเรียน</button>

            </form>
        </div>

       <div class="col-12 col-md-8 col-lg-6 mx-auto p-3 rounded shadow bg-white mt-3">
            <label for="">ชื่อ-สกุล</label>
            <input class="form-control" type="text" readonly value="<?= $fetch['prefix'].$fetch['fname'].' '.$fetch['lname']?>">
            <label for="">ห้อง</label>
            <input class="form-control" type="text" readonly value="<?= $fetch['class']?>">
            <label for="">เลขที่</label>
            <input class="form-control" type="text" readonly value="<?= $fetch['no']?>">

            <div class="">
                <form action="" method="POST">
                    <input type="hidden" name="noid" value="<?= $noid ?>">
                    <label for="">เหตุผลทีหัก</label>
                    <textarea class="form-control mb-2" name="dcs" id=""></textarea>
                    <input class="form-control mb-2" type="number" placeholder="คะแนนที่หัก" name="point">
                    <button class="form-control btn btn-success mb-2" type="submit" name="save_data">บันทึกข้อมูล</button>
                </form>
                <a class="form-control btn btn-primary" href="home.php">ย้อนกลับ</a>
        </div>
    </div>
</body>


    </div>
</html>