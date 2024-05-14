<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $company = $_POST['company'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'register');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    } else {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO registration(firstname, lastname, phonenumber, email, gender, company, password, cpassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $firstname, $lastname, $phonenumber, $email, $gender, $company, $password, $cpassword);
        
        // Execute the statement
        if($stmt->execute()) {
            // Registration successful
            echo "<script>alert('Registration Successful');</script>";
            // Redirect to login page
            echo "<script>window.location='login.html';</script>";
        } else {
            // Registration failed
            echo "<script>alert('Registration Failed');</script>";
            // Redirect back to registration page
            echo "<script>window.location='register.html';</script>";
        }
        
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>
