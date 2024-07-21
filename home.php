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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Home | Student Information System</title>
</head>

<body>
    <?php
    include_once("include/navbar.php");
    ?>
    <div class="container">
        <h1 class="display-4 border-bottom">Welcome <?php echo $printData['full_name']; ?></h1>
        <div class="py-3">
            <img src="pictures/<?php echo $prD['profile_photo'];?>" class="img-thumbnail" width="200">
        </div>
        <table class="display-6 table" style="font-size:24px;">
            <tr>
                <th colspan="2">Student Details</th>
            </tr>
            <tr>
                <td>Full Name: </td>
                <td> <?php echo $printData['full_name']; ?></th>
            </tr>
            <tr>
                <td>Email: </td>
                <td> <?php echo $printData['email']; ?></th>
            </tr>
            <tr>
                <td>Address: </td>
                <td> <?php echo $printData['address']; ?></th>
            </tr>
            <tr>
                <td>Date of Birth: </td>
                <td> <?php echo $printData['dob']; ?></th>
            </tr>
            <tr>
                <th colspan="2">Academic Details</th>
            </tr>
            <tr>
                <td>Roll No.: </td>
                <td> <?php echo $prD['roll_no']; ?></th>
            </tr>
            <tr>
                <td>Branch </td>
                <td> <?php echo $prD['branch']; ?></th>
            </tr>
            <tr>
                <td>Semester </td>
                <td> <?php echo $prD['sem']; ?></th>
            </tr>
            <tr>
                <td>Section </td>
                <td> <?php echo $prD['section']; ?></th>
            </tr>
            <tr>
                <td>Sports </td>
                <td> <?php echo $prD['sports']; ?></th>
            </tr>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>