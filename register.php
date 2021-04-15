<?php
session_start();
print_r('Ik lees deze code wel');

$name = '';
$mail = '';
$pwd = '';

if (isset($_SESSION['value'])) {
    print_r('Ik lees deze inlog wel');
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['submit'])) {
    print_r('Ik lees deze submit wel');
    /** @var mysqli $db */
    require_once "includes/db.php";

    $name = mysqli_escape_string($db, $_POST['name']);
    $mail = mysqli_escape_string($db, $_POST['mail']);
    $pwd = $_POST['pwd'];

    $err = [];

    if ($name == '' || $mail == '' || $pwd == '') {
        $err['fields'] = 'One or more fields are empty';
    }

    if (empty($err)) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, mail, pwd) VALUES('$name', '$mail', '$pwd')";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        if ($result) {
            header('Location: login.php');
            exit;
        } else {
            $err['db'] = mysqli_error($db);
        }
        mysqli_close($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - phpcrud</title>
</head>

<body>
    <h1>Registreren</h1>
    <span><?= isset($err['db']) ? $err['db'] : ''; ?></span>
    <span><?= isset($err['fields']) ? $err['fields'] : ''; ?></span>
    <form action="./register.php" method="post">
        <div class="field">
            <input name="name" type="text" placeholder="Volledige naam" value="<?= htmlentities($name); ?>">
            <input name="mail" type="email" placeholder="Mail" value="<?= htmlentities($mail); ?>">
            <input name="pwd" type="password" placeholder="Wachtwoord">
            <input type="submit" value="Registreren">
        </div>
    </form>
</body>

</html>