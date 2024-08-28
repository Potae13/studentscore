<?php
    session_start();
    require "conn.php";
    echo $idcard = $_POST['idcard'];
    echo $password = $_POST['password'];

    if(empty($idcard) || empty($password) ){
        $_SESSION["login_error"] = true;
        header("location: index.php");
    
    } else{

        // $day = substr($password,0,2);
        // $month = substr($password,2,2);
        // $year = substr($password,4,4);

        // $new_password = $day.'/'.$month.'/'.$year;

        try{
            $sql = "SELECT noid,idcard FROM students WHERE idcard = :idcard";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idcard',$idcard,PDO::PARAM_INT);
            $result = $stmt->execute();
    
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if($result){
                if($fetch['noid'] == $password){
                    $_SESSION['key'] = Time();
                    $_SESSION['noid'] = $fetch['noid'];
                    $_SESSION['login_success'] = true;
                    
                    header("location: home.php");
                }else{
                    $_SESSION["login_error"] = true;
                }
            }else {        
                $_SESSION["login_error"] = true;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>