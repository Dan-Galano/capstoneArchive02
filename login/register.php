<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <form action="" onSubmit="return validate();" method="post">
        <input type="text" name="userID" placeholder="ID Number" required>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="text" name="middleName" placeholder="Middle Name" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>

        <select name="program" id=""> <!-- program -->
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
            <option value="Software Engineering">Software Engineering</option>
        </select>

        <select name="major" id=""> <!-- major -->
            <?php
            include('../config.php');
            $program = mysqli_query($connect, "SELECT * FROM major");
            while ($result = mysqli_fetch_array($program)) {
            ?>
                <option value="<?php echo $result['majorID'] ?>"><?php echo $result['majorName'] ?></option>
            <?php } ?>
        </select>

        <input type="submit" name="btnRegister" value="REGISTER" id="register">
        <label for="login">Already Have an Account? <a href="student-login.php">Log in</a></label>
    </form>
    <script>
        function validate() { //password validation
            var a = document.getElementById("password").value;
            var b = document.getElementById("confirmPassword").value;
            if (a != b) {
                alert("Passwords does not match");
                return false;
            }
        }
    </script>
</body>

</html>

<?php
require "../config.php";
if (isset($_POST['btnRegister'])) {
    $userID = $_POST['userID'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $major = $_POST['major'];

    $select = "SELECT * FROM user WHERE userID = '$userID'";
    $result = mysqli_query($connect, $select);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("ID Number is already registered!")</script>';
    } else {
        $sql = "INSERT INTO `user`(`userID`, `majorID`, `password`, `lastName`, `firstName`, `middleName`) VALUES ('$userID','$major','$password','$lastName','$firstName','$middleName')";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo "<script>alert('Registered succesfully!')</script>";
            header("Refresh: 1; url='student-login.php'");
        } else {
            echo "<script>alert('Error!')</script>";
        }
    }
} else if (isset($_POST['btnLogin'])) {
    header("Refresh: 0, url='student-login.php'");
}
?>