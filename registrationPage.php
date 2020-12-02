<?php

use function PHPSTORM_META\type;

$proles = array('Student', 'Admin');
require_once 'checksession.php';

include 'DBController.php';

$db_handle = new DBController();
$courseResult = $db_handle->runQuery("SELECT DISTINCT Course_Title FROM Course ORDER BY Course_Title ASC");

if (isset($_POST['user'])) {
    $id = $_POST['Enroll_ID'];
    $sid = $_POST['Student_ID'];
    $courseid = $_POST['Course_ID'];
    $grade = $_POST['Grade'];
    $date_enrolled = $_POST['Date_Enrolled'];
    $date_dropped = $_POST['Date_Dropped'];

    $query = "SELECT Student_ID FROM Enrollment WHERE Student_ID = $Student_ID";

    $result = $conn->query($query);
    if (!$result) die($conn->error);
}

/*$Student_ID = $_SESSION['Student_ID'];
$query = "Select Student_ID from Student where Student_ID = $Student_ID";
$result = $conn->query($query);
if (!$result) die($conn->error);
$result->data_seek(0);
$id = $_POST['Enroll_ID'];
$sid = $_POST['Student_ID'];
$courseid = $_POST['Course_ID'];
$grade = $_POST['Grade'];
$date_enrolled = $_POST['Date_Enrolled'];
$date_dropped = $_POST['Date_Dropped'];*/
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

            <ul class="navbar-nav mr-auto">
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

    <!-- Background Image/Body -->
    <div class="page-header header container-fluid">
        <div class="container">
            <form method="post" name="search" action="registrationPage.php">
                <div id="demo-grid">
                    <!-- Registration/Subject Dropdowns -->
                    <div class="form-container">
                        <div class="form-row">
                            <div class="form-group col-md-6">

								<label for="Subject">Subject</label>

                                <select id="Place" name="course[]" class="form-control ">
                                    <option disabled selected value> -- Select a Subject -- </option>
                                    <?php
                                    if (!empty($courseResult)) {
                                        foreach ($courseResult as $key => $value) {
                                            echo '<option value="' . $courseResult[$key]['Course_Title'] . '">' . $courseResult[$key]['Course_Title'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select><br>
                                <button id="Filter">Search</button>

                            </div>

                            <?php
                            if (!empty($_POST['course'])) {
                            ?>
                                <table class="table table-striped" cellpadding="10" cellspacing="1">

                                    <thead>
                                        <tr>
                                            <th><strong>Course ID</strong></th>
                                            <th><strong>Class</strong></th>
                                            <th><strong>Course Title</strong></th>
                                            <th><strong>Day/Time</strong></th>
                                            <th><strong>Room</strong></th>
                                            <th><strong>Instructor</strong></th>
                                            <th><strong>Units</strong></th>
                                            <th><strong>Select</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT C.Course_ID, C.Course_NUM, C.Course_Title, C.Day_Time, C.Room, C.Credits, Concat(F.Fname, ' ', F.Lname) As Instructor FROM Course as C JOIN Faculty as F on C.Faculty_ID = F.Faculty_ID where Course_Year >= Year(Curdate())";
                                        $i = 0;
                                        $selectedOptionCount = count($_POST['course']);
                                        $selectedOption = "";
                                        while ($i < $selectedOptionCount) {
                                            $selectedOption = $selectedOption . "'" . $_POST['course'][$i] . "'";
                                            if ($i < $selectedOptionCount - 1) {
                                                $selectedOption = $selectedOption . ", ";
                                            }

                                            $i++;
                                        }
                                        $query = $query . " AND Course_Title in (" . $selectedOption . ")";

                                        $result = $db_handle->runQuery($query);
                                    }
                                    if (!empty($result)) {
                                        foreach ($result as $key => $value) {
                                        ?>
                                            <tr name='row[]'>

                                                <td>
                                                    <div class="col" id="user_data_1"><?php echo $result[$key]['Course_ID']; ?></div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_1"><?php echo $result[$key]['Course_NUM']; ?></div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_2"><?php echo $result[$key]['Course_Title']; ?> </div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_3"><?php echo $result[$key]['Day_Time']; ?> </div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_4"><?php echo $result[$key]['Room']; ?> </div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_5"><?php echo $result[$key]['Instructor']; ?> </div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_6"><?php echo $result[$key]['Credits']; ?> </div>
                                                </td>
                                                <td>
                                                    <div class="col" id="user_data_0"><?php $courseid = $result[$key]['Course_ID'];

                                                                                        echo "<input type='checkbox' name='course[]' value='$courseid' ><br/>";

                                                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }

                                        ?>


                                    </tbody>

                                </table>
                                <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                <input type='hidden' value='1234'>
                            <?php
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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



if (
    isset($_POST['submit'])
) {
    $rows = $_POST['course'];

    $Course_ID = $rows[0];
    $Student_ID = $_SESSION['user'];

    $query = "INSERT INTO Enrollment (Student_ID, Course_ID, Grade, Date_Enrolled, Date_Dropped)
              VALUES   ($Student_ID, $Course_ID, NULL, NOW(), NULL)";

    $conn = $db_handle->connectDB();
    $result = $conn->query($query);



    if (!$result) {
        echo "Update failed: $query <br>" .
            $conn->error . "<br><br>";
    }
    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
} else echo "Fill yo fields";

//$conn->close();

?>