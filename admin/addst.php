<?php

    require '../conn.php';

    if(isset($_POST['btn_add'])){
        $noid = $_POST['noid'];
        $prefix = $_POST['prefix'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $class = $_POST['class'];
        $no = $_POST['no'];
        $idcard = $_POST['idcard'];
        

        $sql = "INSERT INTO students(noid,prefix,fname,lname,class,no,idcard) VALUES (:noid,:prefix,:fname,:lname,:class,:no,:idcard)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':noid',$noid, PDO::PARAM_INT);
        $stmt->bindParam(':prefix',$prefix, PDO::PARAM_STR);
        $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
        $stmt->bindParam(':lname',$lname, PDO::PARAM_STR);
        $stmt->bindParam(':class',$class, PDO::PARAM_INT);
        $stmt->bindParam(':no',$no, PDO::PARAM_INT);
        $stmt->bindParam(':idcard',$idcard, PDO::PARAM_INT);

        $result = $stmt->execute();

        if($result) {
            header("location: home.php");
            

        }else {
            echo 'error';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require '../header.php' ?>
</head>
<body>
    
    <div class="container">
        <div class="col-8 shadow bg-white mb-3 mx-auto p-3 mt-3 ">
            <h1>หน้าเพิ่มนักเรียน</h1>
            <form action="" method='POST'>
                <input type="number"class="form-control mb-3"placeholder="เลขประจำตัวนักเรียน" name='noid' required>
                <input type="text"class="form-control mb-3"placeholder="คำนำหน้า" name='prefix' required>
                <input type="text"class="form-control mb-3"placeholder="ชื่อจริง" name='fname' required>
                <input type="text"class="form-control mb-3"placeholder="นานสกุล" name='lname' required>
                <input type="number"class="form-control mb-3"placeholder="ห้อง" name='class' required>
                <input type="number"class="form-control mb-3"placeholder="เลขที่" name='no' required>
                <input type="number"class="form-control mb-3"placeholder="เลขบัตรประชาชน" name='idcard' required>
            
                <button type="submit"class="btn btn-success mb-3" name="btn_add">เพิ่มนักเรียน</button>
                <a href="home.php"class="btn btn-secondary">ย้อนกลับ</a>
            </form>
        </div>
    </div>
</body>
</html>