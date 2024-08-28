<?php
    require '../conn.php';
    session_start();
    if(isset($_GET['del'])){
 
        $noid = $_GET['del'];
        $sql = "DELETE FROM students WHERE noid = :noid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':noid',$noid,PDO::PARAM_INT);
    
        $result = $stmt->execute();
    
        if ($result){
            $_SESSION['delst'] =true;
            header("location: home.php");
        }else{
            echo 'error';
        }
    }else{
        header("location: home.php");
    }


?>