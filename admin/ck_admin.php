<?php
    session_start();
    require "../conn.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        $_SESSION["login_error"] = true;
        header("location: index.php");
    
    }else if(empty($password)){
        $_SESSION["login_error"] = true;
        header("location: index.php");
    } else{
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $result = $stmt->execute();

        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            if($fetch['password'] == $password){
                $_SESSION['key'] = Time();
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['login_success'] = true;
                header("location: home.php");
            }else{
                $_SESSION["login_error"] = true;
                header('location: index.php');
            }
        }else {        
            $_SESSION["login_error"] = true;
            header('location: index.php');
        }
    }
?>