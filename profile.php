<?php session_start();

require_once("connection.php");
if (!isset($_SESSION['valid'])) {
    header('Location: ./login.php');
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $user = mysqli_real_escape_string($mysqli, $_POST['email']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
    $id = $_SESSION['id'];

    if ($user == "" || $pass == "" || $name == "") {
        echo "All fields should be filled. Either one or many fields are empty.";
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM login WHERE id='$id'");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['password'])) {
                mysqli_query($mysqli, "UPDATE login SET name='$name', email='$user' WHERE id='$id'")
                    or die("Could not execute the insert query." . mysqli_error($mysqli));
                $_SESSION['valid'] = $user;
                $_SESSION['name'] = $name;
            }
        }

        header('location: ./profile.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/formPage.css">
    <title>Profile - PHPCRUD</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <form action="" method="POST">
                <div class="row">
                    <label for="name">Naam</label><br>
                    <input required id="name" type="text" name="name" value="<?= htmlentities($_SESSION['name']) ?>">
                </div>
                <div class="row">
                    <label for="email">Email</label><br>
                    <input required id="email" type="email" name="email" value="<?= htmlentities($_SESSION['valid']) ?>">
                </div>
                <div class="row">
                    <label for="password">Wachtwoord ter bevestiging</label><br>
                    <input required id="password" type="password" name="password" minlength="8">
                </div>
                <div class="row">
                    <input name="submit" type="submit" value="Aanpassen">
                </div>
            </form>
            <a href='./dashboard.php'>Naar het dashboard (en daar voorbij)</a>
        </div>
    </div>
</body>

</html>