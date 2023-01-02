<?php
require_once 'db.php';
$name = $sname = $email = $password = '';
$nameError = $snameError = $emailError = $passwordError = '';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    empty($_POST['fname']) ? $nameError = "Name is required" : $name = test_data($_POST['fname']);
    empty($_POST['sname']) ? $snameError = "SurnName is required" : $sname = test_data($_POST['sname']);
    empty($_POST['email']) ? $emailError = "Email is required" : $email = test_data($_POST['email']);
    empty($_POST['password']) ? $passwordError = "Password is required" : $password = test_data($_POST['password']);

    $name = $_REQUEST['fname'];
    $sname = $_REQUEST['sname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
}

// Test data and remove special characters
function test_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the name only contains /,letters, apostrophes and whitespace
if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $nameError = 'Only letters allowed';
}
// Check if the sname only contains /,letters, apostrophes and whitespace
if (!preg_match("/^[a-zA-Z-' ]*$/", $sname)) {
    $surnameError = 'Only letters allowed';
}
// Check if the email address is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = "Invalid email format";
}

/*
 *Query the database to check if the data is present if not add the data from the form
 *else display error
 *Close connection
 */
$dataFromForm = "INSERT INTO info (name, sname, email, password )values('$name', '$sname', '$email', '$password')";

if (mysqli_query($conn, $dataFromForm)) {
    // echo "<h3>Data Stored</h3>";
    echo nl2br("\n$name\n $sname\n "
        . "$email\n $password\n");
} else {
    echo "ERROR" . mysqli_error($conn);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles.css" type="text/css" />
    <title>COntact form</title>
</head>

<body>
    <!-- Form -->
    <section>
        <form action="" method="post" class="form" name="myForm">
            <label for="fname">First Name</label>
            <input type="text" " data-key=" fname" name="fname" />
            <span class='error'>
                <?php echo $nameError; ?>
            </span>

            <label for="sname">Surname</label>
            <input type="text" data-key="sname" name="sname" />
            <span class='error'><?php echo $snameError; ?></span>

            <label for="email">Email</label>
            <input type="email" data-key="email" name="email" />
            <span class='error'>
                <?php echo $emailError; ?>
            </span>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" data-key="password" />
            <span class='error'>
                <?php echo $passwordError; ?>
            </span>


            <label for="cpassword">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" data-key="cpassword" />

            <input type="submit" class="submit-button" value="Login" data-key="submit" />
        </form>
    </section>
    <script src="./app.js"></script>
</body>

</html>