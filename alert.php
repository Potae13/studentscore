<script> 
            <?php 
            if(isset($_SESSION["login_success"])){
                

            
            ?>
            Swal.fire({
                title: "สำเร็จ",
                text: "เข้าสู่ระบบสำเร็จ",
                icon: "success"
            });
            <?php 
            }
            unset($_SESSION["login_success"]);
            ?>

            <?php 
            if(isset($_SESSION["login_error"])){
                

            
            ?>
            Swal.fire({
                title: "ไม่สำเร็จ",
                text: "ไม่สำเร็จ",
                icon: "error"
            });
            <?php 
            }
            unset($_SESSION["login_error"]);
            ?>
             <?php 
            if(isset($_SESSION["save_success"])){
                

            
            ?>
            Swal.fire({
                title: "บันทึกข้อมูลสำเร็จ",
                text: "หักคะแนนนสำเร็จ",
                icon: "success"
            });
            <?php 
            }
            unset($_SESSION["save_success"]);
            ?>
             <?php 
            if(isset($_SESSION["error"])){
                

            
            ?>
            Swal.fire({
                title: "ไม่สำเร็จ",
                text: "มีบางอย่างผิดพลาด",
                icon: "error"
            });
            <?php 
            }
            unset($_SESSION["error"]);
            ?>

            
            <?php 
            if(isset($_SESSION["delst"])){
                

            
            ?>
            Swal.fire({
                title: "สำเร็จ",
                text: "ลบนักเรียนสำเร็จ",
                icon: "success"
            });
            <?php 
            }
            unset($_SESSION["delst"]);
            ?>

</script>