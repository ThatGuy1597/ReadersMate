<?php
    session_start();
    include_once 'database.php';
    if(isset($_POST ['save'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM tbl_login WHERE email = '$email'";

        $run = mysqli_query($conn, $query);

        $ok = $run;

        if(mysqli_num_rows($ok)>0){
            $row = mysqli_fetch_array($run);
            //getting hash from database for the user.
            $hash = $row['password'];

            if (password_verify($password, $hash)) {
              // Set session variables
              $_SESSION["user_id"] = $row['LID'];
              $_SESSION["fname"] = $row['first_name'];
              $_SESSION["lname"] = $row['last_name'];
              $_SESSION["shipping_charges"] = 0;
              $_SESSION["pin_no"] = '';
              echo "<script>window.open('index.php','_self')</script>";
            }
            else {
                echo "not looged in!!";
            }

          }
        }
?>
