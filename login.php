<?php session_start();
if (isset($_SESSION['valid'])) {
    header('Location: ./dashboard.php');
}

include("connection.php");

if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['email']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    if ($user == "" || $pass == "") {
        echo "Either username or password field is empty.";
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM login WHERE email='$user'")
            or die("Could not execute the select query.");
        $row = mysqli_fetch_assoc($result);

        if (is_array($row) && !empty($row) && password_verify($pass, $row['password'])) {
            $validuser = $row['email'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
        } else {
            echo "Wat kun je wel he?";
            // header("Location: ./login.php");
        }

        if (isset($_SESSION['valid'])) {
            header('Location: ./dashboard.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style//formPage.css">
    <title>Inloggen</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1>Inloggen</h1>
            <form action="" method="POST">
                <div class="row">
                    <label for="email">Email</label> <br>
                    <input required id="email" type="email" name="email" maxlength="64">
                </div>
                <div class="row">
                    <label for="password">Wachtwoord</label> <br>
                    <input required id="password" type="password" name="password" minlength="8">
                </div>
                <div class="row">
                    <input name="submit" type="submit" value="Inloggen">
                </div>
                <div class="row">
                    <p>Nog geen account? <a href="./register.php">Registreer!</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>