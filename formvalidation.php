<?php
require_once 'db.php';
$firstname = $surname = $email = $password = '';
$nameError = $snameError = $emailError = $passwordError = '';
$dataReceived = false;

// Test data and remove special characters
function test_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Test data
    $firstname = test_data($_POST['firstname']);
    $surname = test_data($_POST['surname']);
    $password = test_data($_POST['password']);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email = test_data($_POST['email']);
} else {
    $emailError = "Invalid email format";
}

$dataFromForm = "INSERT INTO info (name, sname, email, password) values('$firstname', '$surname', '$email', '$password')";
$result = mysqli_query($conn, $dataFromForm);

if ($result) {
    $dataReceived = true;
} else {
    echo "ERROR" . mysqli_error($conn);
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
            <label for="firstname">First Name</label>
            <input type="text" " data-key=" firstname" name="firstname" />
            <span class='error'>
                <?php echo $nameError; ?>
            </span>

            <label for="surname">Surname</label>
            <input type="text" data-key="surname" name="surname" />
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

            <input type="submit" class="submit-button" value="Login" id="submitBtn" />
        </form>
    </section>
    <script src="./app.js"></script>
</body>

</html>