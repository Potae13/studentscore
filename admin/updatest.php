<?php 
    require '../conn.php';
    
    if(isset($_GET['noid'])){
    
    
    $noid = $_GET['noid'];
    $sql = "SELECT * FROM students WHERE noid = :noid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':noid',$noid,PDO::PARAM_INT);
    $stmt->execute();
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    
    }else{
        header("location: index.php");


    }

    require '../conn.php';

    if(isset($_POST['btn_update'])){
        $new_noid = $_POST['new_noid'];
        $fname = $_POST['new_fname'];
        $lname = $_POST['new_lname'];

        $sql1 = "UPDATE students SET fname = :fname , lname = :lname WHERE noid = :noid";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bindParam(':fname',$fname, PDO::PARAM_STR);
        $stmt1->bindParam(':lname',$lname, PDO::PARAM_STR);
        $stmt1->bindParam(':noid',$new_noid,PDO::PARAM_INT);

        $result1 = $stmt1->execute();

        if($result1) {
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
</head>
<body>
    <div class="container">
        <h1>หน้าแก้ไขข้อมูลนักเรียน</h1>
        <form action=""method="POST">
            <input type="hidden" value="<?= $fetch['noid']?>"name="new_noid">
            <input type="text"class="form-control"placeholder="ชื่อจริง" value="<?=$fetch['fname']?>"name="new_fname">
            <input type="text"class="form-control"placeholder="ชื่อเล่น" value="<?=$fetch['lname']?>"name="new_lname">
            <button type="submit"class="btn btn-warning"name="btn_update">แก้ไขข้อมูลนักเรียน</button>
            <a href="home.php"class="btn btn-secondary">ย้อนกลับ</a>
        </form>
    </div>
</body>
</html>