  <?php session_start();

    /** @var mysqli $db */
    require_once "includes/db.php";

    if (isset($_SESSION['valid'])) {
        header("Location: dashboard.php");
        exit;
    }

    print_r("HELP");

    //If form is posted, lets validate!
    if (isset($_POST['submit'])) {
        $mail = mysqli_escape_string($db, $_POST['mail']);
        $pwd = $_POST['pwd'];

        $err = [];

        $query = "SELECT * FROM users WHERE email = '$mail'";
        $result = mysqli_query($db, $query) or die($err['db'] = mysqli_error($db));
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($pwd =  $user['pwd']) { // DONT FORGET THE HASHING
                // Create session
                $_SESSION['valid'] = [
                    'name' => $user['name'],
                    'id' => $user['id']
                ];

                header("Location: dashboard.php");
                exit;
            } else {
                $err['fields'] = 'Uw logingegevens zijn onjuist';
                print_r("HELP");
            }
        } else {
            $err['fields'] = 'Uw logingegevens zijn onjuist';
            print_r("HELP");
        }
    }
    ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login - phpcrud</title>
  </head>

  <body>
      <h1>Login</h1>
      <span><?= isset($err['db']) ? "<strong>Foutmelding: </strong>" . $err['db'] : ''; ?></span>
      <span><?= isset($err['fields']) ? "<strong>Foutmelding: </strong>" . $err['fields'] : ''; ?></span>
      <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
          <div class="field">
              <input name="mail" type="email" placeholder="Mail">
              <input name="pwd" type="password" placeholder="Wachtwoord">
              <input type="submit" value="Login">
          </div>
      </form>
  </body>

  </html>