<?php

require_once 'dbinfo.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

?>

<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Font Awesome 6 -->
    <script src="https://kit.fontawesome.com/b9b2b271de.js" crossorigin="anonymous"></script>

    <!-- Link to CSS File -->
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Registration</title>
</head>

<body>
    <!---------    NAVBAR    --------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="https://homepage.php/">University of Utah</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <!--<li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li> -->
            </ul>
            <ul class="navbar-nav">

            </ul>
        </div>
    </nav>
    <div class="loginbox">
        <h1>Student Login</h1>
        <form method='post' action='index.php'>
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" class="loginPassword" placeholder="Enter Password">
            <button type="submit" name="submit" class="btn btn-primary">Login</button>

        </form>

    </div>

</body>

<?php

if (isset($_POST['username']) && isset($_POST['password'])) {

    $un_temp = mysql_entities_fix_string($conn, $_POST['username']);
    //because our usernames were already integers when we read the requirement of using bsmith/pjones,
    //the following ifs replaces their logins
    if ($un_temp == 'bsmith') $un_temp = 1111;
    if ($un_temp == 'pjones')    $un_temp = 2222;

    $pw_temp = mysql_entities_fix_string($conn, $_POST['password']);

    $query = "SELECT * from login where User_ID='$un_temp' ";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    elseif ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $correct_pw = $row['Password'];
        $result->close();

        $salt1 = 'group2';
        $salt2 = 'rocks';
        $token = hash('ripemd128', "$salt1$pw_temp$salt2");

        //security nightmare for manually changing passwords
        //echo "<script>alert('$token');</script>";

        if ($token == $correct_pw) {
            $username = $row['User_ID'];
            $role = $row['Roles'];

            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['password'] = $correct_pw;

            header("Location: homepage.php");
        } else {
            echo "<script>alert('Login Failed');</script>";
            exit();
        }
    } else {
        exit();
    }
} else {
    exit();
}

$conn->close();


function mysql_entities_fix_string($conn, $string)
{
    return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $conn->real_escape_string($string);
}

?>

</html>