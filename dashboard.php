<?php session_start();
if (!isset($_SESSION['valid'])) {
    header('Location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/formPage.css">
    <title>Dasboard - PHPCRUD</title>
</head>

<body>

    <div class="container">
        <div class="content">
            <p>Welkom <?php echo htmlspecialchars($_SESSION['name']) ?></p>
            <p>
                <a href='logout.php'>Uitloggen</a>
                &ThickSpace; | &ThickSpace;
                <a href='profile.php'>Profiel aanpassen</a>
                &ThickSpace; | &ThickSpace;
                <a href='delete.php'>Profiel verwijderen</a>
            </p>
        </div>
    </div>
</body>

</html>