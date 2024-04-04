<?php
session_start();

include 'dbinfo.php';

$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con) {
    die("Connection failed!" . mysqli_connect_error());
}

$login_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            
            $_SESSION['username'] = $username;
            header("Location: admin-index.php");
            exit();
        } else {
            
            $login_message = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Readers' Area</title>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        font-family: Arial, sans-serif;
    }

    .image-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('image1.jpg'); 
        background-size: cover;
        background-position: center;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .login-box {
        text-align: center;
        border: none; 
        padding: 40px; 
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 20px; 
        box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2); 
        max-width: 400px;
        width: 90%; 
    }
    h2 {
        margin-top: 0;
        color: #333;
        font-size: 24px; 
    }
    label {
        display: block;
        margin-bottom: 10px; 
        color: #666;
        font-weight: bold;
    }
    input[type="text"],
    input[type="password"] {
        width: calc(100% - 20px); 
        padding: 12px; 
        margin-bottom: 20px; 
        border: none; 
        border-radius: 10px; 
        box-sizing: border-box;
        background-color: #f9f9f9; 
    }
    input[type="submit"] {
        width: calc(100% - 20px); 
        padding: 12px; 
        border: none;
        background-color: #400b0d;
        color: #fff;
        border-radius: 10px; 
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #600e12; 
    }
    .error-message {
        color: #ff0000;
        margin-top: 20px; 
        font-size: 14px; 
    }
</style>
</head>
<body>

<div class="image-container">
    <div class="login-container">
        <div class="login-box">
            <h2>Bank's Logbook</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">User Name</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Passcode</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" value="Login">
            </form>
            <div class="error-message"><?php echo $login_message; ?></div>
        </div>
    </div>
</div>

</body>
</html>
