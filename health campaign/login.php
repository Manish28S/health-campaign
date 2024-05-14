
<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $con = new mysqli("localhost","root","","register");
    if($con->connect_error){
        die('Connection Failed : '.$con->connect_error);
    }else{
        $stmt = $con->prepare("select * from registration where email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data =$stmt_result->fetch_assoc();
            if($data['password'] === $password){
                
                session_start();
                
                $_SESSION['email'] = $email;
                // Redirect to dashboard.html
                header("Location: dashboard.html");
                exit(); 
            }else{
                echo "<script>alert('Invalid Email or Password');</script>";
                echo "<script>window.location = 'login.html';</script>"; // Redirect back to login page
            }
        }else{
            echo "<script>alert('Invalid Email or Password');</script>";
            echo "<script>window.location = 'login.html';</script>"; // Redirect back to login page
        } 
    }
?>
