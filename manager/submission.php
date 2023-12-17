<?php
include "../config.php";
session_start();
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/homepage.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .center {
                text-align: center;
            }

            th,
            td {
                text-align: center;
            }

            #logout {
                border: none;
                background-color: white;
                margin-top: 2%;
            }
        </style>
        <title>Professor Approval</title>
    </head>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Refresh: 1; url='../login/manager-login.php'");
        echo "<script>alert('Logged out successfully.')</script>";
    }
    ?>

    <body>

        <header>
            <div class="top-section">
                <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo">
                <label><b>PANGASINAN</b><span class="university-name"> STATE UNIVERSITY</span></label>

            </div>
            <label for="" id="sys-name"><b>IT CAPSTONE PROJECT INVENTORY</b></label>
            <form action="" method="post" class="system-name">
                <button type="submit" name="logout" id="logout"> <img src="../images/power.png" style=" width: 40px; border-radius: 50px; border: none;"></button>
            </form>
        </header>
        <nav class="navi">
            <ul>
                <li id="left-nav">
                    <a href="professor_home.php" id="selected">Class</a>
                    <a href="submission.php">Submission</a>
                </li>
            </ul>

            <ul>
                <li id="project">
                    <a href="inventory.php"><i class="fa-solid fa-user fa"></i>&nbsp&nbspInventory</a>
                </li>
            </ul>

        </nav>

        <?php
        if (isset($_POST['approve'])) {
            $UpCapstoneID = $_POST['capstoneID'];

            $select = "UPDATE uploaded_capstones SET status = 'approved' WHERE capstoneID = '$UpCapstoneID'";
            $result = mysqli_query($connect, $select);

            echo "<script>alert('Capstone Approved!')</script>";
            header("Refresh: 1; url='submission.php'");
        }
        if (isset($_POST['reject'])) {
            $UpCapstoneID = $_POST['capstoneID'];

            //delete file from folder
            $query = "SELECT * FROM uploaded_capstones WHERE capstoneID = '$UpCapstoneID'";
            $res = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($res)) {
                // echo $row['FileContent'];
                unlink('capstones/' . $row['fileContent']);
            }

            $select = "DELETE FROM uploaded_capstones WHERE capstoneID = '$UpCapstoneID'";
            $result = mysqli_query($connect, $select);
            echo "<script>alert('Capstone Rejected.')</script>";


            header("Refresh: 1; url='submission.php'");
        }
        ?>
        <div class="container">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date Created</th>
                        <th>File Name</th>
                        <th>Date File Uploaded</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM uploaded_capstones WHERE status = 'pending' ORDER BY capstoneID ASC";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['capstoneID']; ?></td>
                            <td><?php echo $row['capstoneTitle']; ?></td>
                            <td><?php echo $row['dateCreated']; ?></td>
                            <td><?php echo $row['fileContent']; ?></td>
                            <td><?php echo $row['dateFileUploaded']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="capstoneID" value="<?php echo $row['capstoneID']; ?>">
                                    <div class="btn-group" role="group">
                                        <button type='submit' name="approve" value="Approve" class='btn btn-success btn-sm mx-2'>Accept</button>
                                        <button type='submit' name="reject" value="Reject" class='btn btn-danger btn-sm'>Reject</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/manager-login.php'");
}
?>