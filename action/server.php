<?php
    session_start();
    // initializing variables
    $username = "";
    $email    = "";
    $errors = array();
    // connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'easeassist');
    if(mysqli_connect_errno()){
        die("ERROR in connection". mysqli_connect_error());
    }

    // REGISTER USER
    if (isset($_POST['reg_user'])) 
    {
        // receive all input values from the form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password_1)) { array_push($errors, "Password is required"); }
        
        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
            }
            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password_1);//encrypt the password before saving in the database
            // echo $password ;
            $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
            // if(mysqli_query($conn, $query)){alert("registration successfull");}
            if (!mysqli_query($conn,$query)) {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['reg_success'] = "You are now logged in";
                echo "<script>alert('New record created successfully');
                window.location.href='../login.php';</script>";
            }
            // header('location: login.php');
        }
    }
    // ...
    // LOGIN USER
    if (isset($_POST['login_user'])) 
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if (empty($username)) 
        {
            array_push($errors, "Username is required");
        }
        if (empty($password)) 
        {
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0) 
        {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) 
            {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: ../dashboard.php');
            }
            else 
            {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>