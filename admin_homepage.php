<?php

$proles = array('Admin');
require_once 'checksession.php';
require_once 'dbinfo.php';
/*
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$Advisor_ID = $_SESSION['user'];
$query = "Select * from Advisor where Advisor_ID = $Advisor_ID";
$result = $conn->query($query);
if (!$result) die($conn->error);
$result->data_seek(0);
$row = $result->fetch_array(MYSQLI_NUM);
$first = $row[2];
$last = $row[1];*/

?>

<!DOCTYPE html>
<html lang="en">

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
        <a class="navbar-brand" href="https://cis.utah.edu">University of Utah</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <?php echo "Welcome Admin"; ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-cog fa-2x"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!------------ ADD/REMOVE/CART/PREVIOUS COURSE BUTTONS ------------>
    <div class="scheduleButtons d-flex justify-content-center admin_buttons admin_button1">
        <a class="btn-lg btn-dangerous button-background left-button" type="button" href="createcourse.php">
            <i class="fas fa-plus-square"></i> Create A Course
        </a>
        <a class="btn-lg btn-dangerous button-background right-button admin_button2" type="button" href="reportPage.php">
            <i class="fas fa-graduation-cap"></i> Report
        </a>
    </div>

    <!--------   STUDENT INFO CONTENT   -------->
    <div class="page-header header container-fluid">
        <div class="form-row">
            <div class="container col-md-4">
                <div class="form-container">
                    <h2>Student</h2>
                    <p>
                        Click "Add a Student" button to add Students to the system<br>

                    </p>

                    <?php
                    require_once 'dbinfo.php';


                    $conn = new mysqli($hn, $un, $pw, $db);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    $query = "SELECT s.Student_ID, s.Fname, s.Lname FROM Student AS s
                JOIN Login AS l ON s.Student_ID = l.User_ID";
                    //JOIN Advisor AS a ON a.Advisor_ID = l.User_ID
                    //JOIN Faculty AS f ON f.Faculty_ID = l.User_ID ORDER BY Roles ASC

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        echo '<table class="table table-striped">';
                        echo '<tr><th>Student ID</th><th>First Name</th><th>Last name</th></tr>';
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody><tr><td>" . $row["Student_ID"] . "</td><td>" . $row["Fname"] . "</td><td>" . $row["Lname"] . "</td></tr></tbody>";
                        }
                        echo "</table>";
                    } else {
                        echo "<span style='color: DodgerBlue;' /><strong>You Do Not Have Any Registered Classes</strong></span>";
                    }
                    $conn->close();
                    ?>
                    <div class="scheduleButtons">
                        <a class="btn-lg btn-dangerous button-background right-button" type="button" href="add_student.php">
                            <i class="fas fa-plus-square"></i> Add a Student
                        </a>
                    </div>
                </div>
            </div>


            <!--------   ADVISOR INFO CONTENT   -------->

            <div class="container col-md-4">
                <div class="form-container">
                    <h2>Advisors</h2>
                    <p>
                        Click "Add an Advisor" button to add Advisors to the system<br>

                    </p>

                    <?php
                    require_once 'dbinfo.php';


                    $conn = new mysqli($hn, $un, $pw, $db);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    $query = "SELECT a.Advisor_ID, a.Fname, a.Lname FROM Advisor AS a
                JOIN Login AS l ON a.Advisor_ID = l.User_ID";
                    //JOIN Advisor AS a ON a.Advisor_ID = l.User_ID
                    //JOIN Faculty AS f ON f.Faculty_ID = l.User_ID ORDER BY Roles ASC

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        echo '<table class="table table-striped">';
                        echo '<tr><th>Advisor ID</th><th>First Name</th><th>Last name</th></tr>';
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody><tr><td>" . $row["Advisor_ID"] . "</td><td>" . $row["Fname"] . "</td><td>" . $row["Lname"] . "</td></tr></tbody>";
                        }
                        echo "</table>";
                    } else {
                        echo "<span style='color: DodgerBlue;' /><strong>You Do Not Have Any Registered Classes</strong></span>";
                    }
                    $conn->close();
                    ?>
                    <div class="scheduleButtons">
                        <a class="btn-lg btn-dangerous button-background right-button" type="button" href="add_advisor.php">
                            <i class="fas fa-plus-square"></i> Add an Advisor
                        </a>
                    </div>
                </div>
            </div>

            <!--------   FACULTY INFO CONTENT   -------->

            <div class="container col-md-4">
                <div class="form-container">
                    <h2>Faculty</h2>
                    <p>
                        Click "Add Faculty" button to add Faculty to the system<br>

                    </p>

                    <?php
                    require_once 'dbinfo.php';


                    $conn = new mysqli($hn, $un, $pw, $db);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    $query = "SELECT f.Faculty_ID, f.Fname, f.Lname FROM Faculty AS f
                JOIN Login AS l ON f.Faculty_ID = l.User_ID";
                    //JOIN Advisor AS a ON a.Advisor_ID = l.User_ID
                    //JOIN Faculty AS f ON f.Faculty_ID = l.User_ID ORDER BY Roles ASC

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        echo '<table class="table table-striped">';
                        echo '<tr><th>Faculty ID</th><th>First Name</th><th>Last name</th></tr>';
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody><tr><td>" . $row["Faculty_ID"] . "</td><td>" . $row["Fname"] . "</td><td>" . $row["Lname"] . "</td></tr></tbody>";
                        }
                        echo "</table>";
                    } else {
                        echo "<span style='color: DodgerBlue;' /><strong>You Do Not Have Any Registered Classes</strong></span>";
                    }
                    $conn->close();
                    ?>
                    <div class="scheduleButtons">
                        <a class="btn-lg btn-dangerous button-background right-button" type="button" href="add_faculty.php">
                            <i class="fas fa-plus-square"></i> Add Faculty
                        </a>
                    </div>
                </div>
            </div>



        </div>
    </div>


    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <script src="main.js"></script>
</body>

</html>