<?php

$proles = array('Student', 'Admin');
require_once 'checksession.php';
require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$Student_ID = $_SESSION['user'];
$query = "Select * from Student where Student_ID = $Student_ID";
$result = $conn->query($query);
if (!$result) die($conn->error);
$result->data_seek(0);
$row = $result->fetch_array(MYSQLI_NUM);
$first = $row[1];
$last = $row[2];

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
        <a class="navbar-brand" href="https://homepage.php/">University of Utah</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="homepage.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-cog fa-2x"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="studentInfo.php">Update Student Information</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!--------   COURSE SCHEDULE CONTENT   -------->

    <div class="page-header header container-fluid">
        <div class="container">
            <form method="post" action="drop_course.php">
                <div class="form-container">
                    <h2>Course Schedule</h2>
                    <p>
                        Please select the course you would like to drop<br>
                    </p>


                    <!-- Record list -->
                    <table class="table table-striped">
                        <tr>
                            <!--<th>Course ID</th>-->
                            <th>Course ID</th>
                            <th>Class</th>
                            <th>Description</th>
                            <th>Day/Time</th>
                            <th>Room</th>
                            <th>Instructor</th>
                            <th>Credits</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php
                        $query = "SELECT c.Course_ID, e.Enroll_ID, Course_NUM, Course_Title, Day_Time, Room, Concat(F.Fname, ' ', F.Lname) As Instructor, Credits, e.Status FROM Course AS c JOIN Enrollment AS e ON c.Course_ID = e.Course_ID Join Faculty F on c.Faculty_ID = F.Faculty_ID WHERE e.Student_ID = $Student_ID and e.Status = 'ENROLLED'";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($result)) {

                            $id = $row['Enroll_ID'];
                            $cNum = $row['Course_NUM'];
                            $cTitle = $row['Course_Title'];
                            $dayTime = $row['Day_Time'];
                            $room = $row['Room'];
                            $instructor = $row['Instructor'];
                            $credits = $row['Credits'];
                            $status = $row['Status'];

                        ?>
                            <tr id='tr_<?= $id ?>'>

                                <td><?= $cNum ?></td>
                                <td><?= $cTitle ?></td>
                                <td><?= $dayTime ?></td>
                                <td><?= $room ?></td>
                                <td><?= $instructor ?></td>
                                <td><?= $credits ?></td>
                                <td><?= $status ?></td>

                                <!-- Checkbox -->
                                <td><input type='checkbox' name='delete[]' value='<?= $id ?>'></td>

                            </tr>
                        <?php
                        }
                        ?>

                        <?php

                        ?>
                    </table>
                    <button type="submit" name="but_delete" class="btn btn-primary">Drop</button>
                    <br><br>

                </div>

            </form>

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

<?php
require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);



if (isset($_POST['but_delete'])) {

    if (isset($_POST['delete'])) {
        foreach ($_POST['delete'] as $deleteid) {
            $deleteUser = "UPDATE Enrollment SET Status = 'DROP', Date_Dropped = Now() WHERE Enroll_ID=" . $deleteid;

            mysqli_query($conn, $deleteUser);

            if (!$result) {
                echo "Update failed: $query <br>" .
                    $conn->error . "<br><br>";
            }

            $conn->close();

            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
} else echo "";

?>