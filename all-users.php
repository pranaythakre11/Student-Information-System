<?php
require_once("config.php");

// Check Session 
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
$email = $_SESSION['email'];
// Fetch Student Records
$sql = mysqli_query($auth, "SELECT * FROM students WHERE email = '$email'");
$printData = mysqli_fetch_array($sql);

// Fetch Academic Details
$aD = mysqli_query($auth, "SELECT * FROM academic_details WHERE email = '$email'");
$prD = mysqli_fetch_array($aD);
$lastUpdate = $prD['last_update'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>All Users | Student Information System</title>
</head>

<body>
    <?php
    include_once("include/navbar.php");
    ?>
    <div class="container">
        <h1 class="display-4 border-bottom">All Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">DP</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Address</th>
                    <th scope="col">Time</th>
                    <th scope="col">Date</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sr = 1;
                $fetchAll = mysqli_query($auth,"SELECT * FROM students ORDER BY id DESC");
                while($row = mysqli_fetch_array($fetchAll))
                {
                    $emailID = $row['email'];
                    $dpQR = mysqli_query($auth,"SELECT profile_photo FROM academic_details WHERE email = '$emailID'");
                    $dpFe = mysqli_fetch_array($dpQR);
                    $dp = $dpFe['profile_photo'];
            ?>
                <tr>
                    <th scope="row"><?php echo $sr++;?></th>
                    <td><img src="pictures/<?php echo $dp;?>" height="25" width="25"></td>
                    <td><?php echo $row['full_name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['gender'];?></td>
                    <td><?php echo $row['dob'];?></td>
                    <td><?php echo $row['address'];?></td>
                    <td><?php echo $row['time'];?></td>
                    <td><?php echo $row['date'];?></td>
                    <td><a href="delete.php?key=<?php echo $row['hash_code'];?>" class="btn btn-sm btn-danger">Delete</a></td>
                </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>