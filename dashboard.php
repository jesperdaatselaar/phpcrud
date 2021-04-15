<!-- If session isn't valid, redirect to login-->
<?php session_start();
if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
$valid = $_SESSION['valid'];
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - phpcrud</title>
</head>

<body>
    <p>Welcome <strong><?php echo $valid['name'] ?></strong> <br> <a href='logout.php'>Logout</a><br /></p>
</body>

</html>