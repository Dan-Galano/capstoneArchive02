<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Manager Login</title>
</head>

<body>
    <form action="manager-login.php" method="post" class="field-input">
        <label for="">Professor ID</label>
        <input type="text" name="professorID" placeholder="prof2023_01">
        <label for="">Password</label>
        <input type="password" name="password" placeholder="********">
        <?php
        require "..\config.php";
        session_start();

        if (isset($_POST['btnLogin'])) {
            $professorID = $_POST['professorID'];
            $password = $_POST['password'];

            if (!empty($professorID) && !empty($password)) {
                $sql = "SELECT `professorID`, `password` FROM professor WHERE professor.professorID = '$professorID' AND professor.password = '$password'";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) >= 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['professorID'] == $professorID && $row['password'] == $password) {
                        // echo "<script>alert('Logged in successfully!')</script>";
                        $_SESSION['professorID'] = $row['professorID'];
                        $_SESSION['profPassword'] = $row['password'];
                        echo "<p style='color: green;'>Logged in.</p>";
                        header("Refresh: 1; url='../manager/professor_home.php'");
                    } else {
                        echo "<p style='color: red;'>Invalid credentials.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Invalid credentials.</p>";
                }
            } else {
                echo "<p style='color: red;'>Invalid credentials.</p>";
            }
        }
        ?>
        <input type="submit" name="btnLogin" value="LOGIN" id="login">
    </form>
    <a href="login-type.php">Back to Login Type</a>
</body>

</html>