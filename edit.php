<?php
// Connecting to the database 
include 'connection.php';

//Checking for the session status i.e. true or false
include 'checksession.php';


$data = $firstnameerr = $lastnameerr = $emailerr = $mobilenumbererr = $passworderr = $doberr = $pfperr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validating the data edited by the user
    include 'validation.php';

    if (!$firstnameerr && !$lastnameerr && !$emailerr && !$mobilenumbererr && !$passworderr && !$doberr && !$pfperr) {
        $newfirstname = $_POST["firstname"];
        $newlastname = $_POST["lastname"];
        $newemail = $_POST["email"];
        $newmobileNo = $_POST["mobilenumber"];
        $newpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $newdob = $_POST["dob"];

        // Storing the uploaded photo in the pfps folder
        $newpfp = "pfps/" . $pfpname;
        move_uploaded_file($pfptmp, $newpfp);

        // Updating the record in the database using the sno passed from the sign_in page 
        $id = $_REQUEST["sno"];
        $sql = "UPDATE `registration_form`.`sign_in` SET `firstName` = '$newfirstname', `lastName` = '$newlastname', `email` = '$newemail', `mobileNo` = '$newmobileNo', `password` = '$newpassword', `dob` = '$newdob', `pfp` = '$newpfp' WHERE `sign_in`.`sno` = $id;";

        if ($con->query($sql)) {
            function_alert("User Updated Successfully");
        } else {
            function_alert("ERROR: $sql <br> $con->error");
        }
    }
}

// Showing the existing data in the databse to the user
$sno = $_REQUEST["sno"];
$result = mysqli_query($con, "SELECT * FROM `registration_form`.`sign_in` WHERE `sno` = $sno");

$emparray = array();
while ($row = mysqli_fetch_assoc($result))
    $emparray[] = $row;

$data = json_decode(json_encode($emparray[0]));

$firstName = $data->firstName;
$lastName = $data->lastName;
$email = $data->email;
$mobileNo = $data->mobileNo;
$password = $data->password;
$dob = $data->dob;
if ($data->pfp)
    $pfp = $data->pfp;

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>

    <!-- Redirects to the all sign_in page -->
    <a href="user.php">
        <button class="leftbtn">All sign_in</button>
    </a>

    <!-- Form to collect user info  -->
    <form class="form-container" action="edit.php<?php echo "?sno=" . $sno; ?>" method="post"
        enctype="multipart/form-data">
        <?php
        if ($data->pfp) {
            echo "<img style = 'width: 23vh;
                    height: 23vh;
                    border-radius: 90px;' 
                    src = $pfp >";
        }
        ?>
        <div class="field-class">
            <label for="firstname" style="text-align: center">First Name</label>
            <input type="text" id="firstname" name="firstname" style="text-align: center; margin: auto" value=<?php echo "$firstName" ?>>
            <p>
                <?php echo $firstnameerr; ?>
            </p>
        </div>
        <div class="field-class">
            <label for="lastname" style="text-align: center">Last Name</label>
            <input type="text" id="lastname" name="lastname" style="text-align: center" value=<?php echo "$lastName" ?>>
            <p>
                <?php echo $lastnameerr; ?>
            </p>
        </div>
        <div class="field-class">
            <label for="email" style="text-align: center">Email</label>
            <input type="email" id="email" name="email" style="text-align: center" value=<?php echo "$email" ?>>
            <p>
                <?php echo $emailerr; ?>
            </p>
        </div>
        <div class="field-class">
            <label for="mobilenumber" style="text-align: center">Mobile Number</label>
            <input type="tel" id="mobilenumber" name="mobilenumber" style="text-align: center" value=<?php echo "$mobileNo" ?>>
            <p>
                <?php echo $mobilenumbererr; ?>
            </p>
        </div>
        <div class="field-class">
            <label for="password" style="text-align: center">Password</label>
            <input type="password" id="password" name="password" style="text-align: center" value=<?php echo "$password" ?>>
            <p>
                <?php echo $passworderr; ?>
            </p>
        </div>
        <div class="field-class">
            <label for="dob" style="text-align: center">Date of Birth</label>
            <input type="date" id="dob" name="dob" style="text-align: center" value=<?php echo "$dob" ?>>
            <p>
                <?php echo $doberr; ?>
            </p>
        </div>
        <!-- To upload or update profile picture -->
        <div class="field-class">
            <label for="pfp" style="text-align: center">Change Profile Picture</label>
            <input type="file" id="pfp" name="pfp">
            <p>
                <?php echo $pfperr; ?>
            </p>
        </div>
        <input type="submit" value="Update">

    </form>
</body>

</html>