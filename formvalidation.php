<?php
require_once 'db.php';
$fname = $sname = $email = $password = '';
$nameError = $snameError = $emailError = $passwordError = '';
$dataReceived = false;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    empty($_POST['fname']) ? $nameError = "Name is required" : $name = test_data($_POST['fname']);
    empty($_POST['sname']) ? $snameError = "SurnName is required" : $sname = test_data($_POST['sname']);
    empty($_POST['email']) ? $emailError = "Email is required" : $email = test_data($_POST['email']);
    empty($_POST['password']) ? $passwordError = "Password is required" : $password = test_data($_POST['password']);
    $fname = $_REQUEST['fname'];
    $sname = $_REQUEST['sname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
}

// Check if the name only contains /,letters, apostrophes and whitespace
if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
    $nameError = 'Only letters allowed';
}

if (!preg_match("/^[a-zA-Z-' ]*$/", $sname)) {
    $surnameError = 'Only letters allowed';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = "Invalid email format";
}

// Insert data into database
$dataFromForm = "INSERT INTO info (name, sname, email, password) values('$fname', '$sname', '$email', '$password')";
$result = mysqli_query($conn, $dataFromForm);

if ($result) {
    $dataReceived = true;
} else {
    echo "ERROR" . mysqli_error($conn);
}


// Test data and remove special characters
function test_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Display data in form

$result = mysqli_query($conn, "SELECT * FROM info");

echo "<table border='1'>";

$i = 0;
while ($row = $result->fetch_assoc()) {
    if ($i == 0) {
        $i++;
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<th>" . $key . "</th>";
        }
        echo "</tr>";
    }
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

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