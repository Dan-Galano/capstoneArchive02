<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/login1.css">
    <title>Student Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo">
            <label class="text-header"><b>PANGASINAN</b> <span class="text-header2">STATE UNIVERSITY</span></label>
        </div>

        <div class="title">
            <label for="">STUDENT LOGIN</label>
        </div>

        <form action="student-login.php" method="post" class="field-input">
            <label for="">ID Number</label>
            <input type="text" name="idNumber" placeholder="21-UR-0183">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="********">
            <?php
            require "..\config.php";
            session_start();

            if (isset($_POST['btnLogin'])) {
                $idNumber = $_POST['idNumber'];
                $password = $_POST['password'];

                if (!empty($idNumber) && !empty($password)) {
                    $sql = "SELECT `userID`, `password` FROM user WHERE user.userID = '$idNumber' AND user.password = '$password'";
                    $result = mysqli_query($connect, $sql);

                    if (mysqli_num_rows($result) >= 1) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['userID'] == $idNumber && $row['password'] == $password) { 
                            // echo "<script>alert('Logged in successfully!')</script>";
                            $_SESSION['userID'] = $row['userID'];
                            $_SESSION['password'] = $row['password'];
                            echo "<p style='color: green;'>Logged in.</p>";
                            header("Refresh: 1; url='../user/user_home.php'");
                        } else {
                            echo "<p style='color: red;'>Invalid credentials.</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>Invalid credentials.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Invalid credentials.</p>";
                }
            } else if (isset($_POST['btnRegister'])) {
                header("Refresh: 0, url='registration.php'");
            }
            ?>
            <input type="submit" name="btnLogin" value="LOGIN" id="login">
        </form>
            <a href="register.php">Register</a>
            <a href="login-type.php">Back to Login Type</a>
    </div>
</body>

</html>

