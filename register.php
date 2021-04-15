    <?php
    include("connection.php");

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($mysqli, $_POST['name']);
        $user = mysqli_real_escape_string($mysqli, $_POST['email']);
        $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        if ($user == "" || $pass == "" || $name == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        } else {
            mysqli_query($mysqli, "INSERT INTO login(name, email, password) VALUES('$name', '$user', '$hash')")
                or die("Could not execute the insert query." . mysqli_error($mysqli));

            header('location: ./login.php');
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
        <title>Registreren</title>
    </head>

    <body>
        <div class="container">
            <div class="content">
                <h1>Registreren</h1>
                <form action="" method="POST">
                    <div class="row">
                        <label for="name">Naam</label><br>
                        <input required id="name" type="text" name="name">
                    </div>
                    <div class="row">
                        <label for="email">Email</label><br>
                        <input required id="email" type="email" name="email">
                    </div>
                    <div class="row">
                        <label for="password">Wachtwoord</label><br>
                        <input required id="password" type="password" name="password" minlength="8">
                    </div>
                    <div class="row">
                        <input name="submit" type="submit" value="Registreren">
                    </div>
                    <div class="row">
                        <p>Al een account? <a href="./login.php">Log in!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>