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
$conn->close();
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
    <a class="navbar-brand" href="https://homepage.php/">University of Utah</a> <?php echo "Welcome $first $last"; ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
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


  <!--------   COURSE SCHEDULE CONTENT   -------->
  <div class="page-header header container-fluid">
    <div class="container">
      <div class="form-container">
        <h2>Course Schedule</h2>
        <p>
          To Add course, Drop course, or View Previous Course Schedule click on the respective button below the Course Schedule<br>

        </p>

        <?php
        require_once 'dbinfo.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $Student_ID = $_SESSION['user'];



        $query = "SELECT Course_NUM, Course_Title, Day_Time, Room, Concat(F.Fname, ' ', F.Lname) As Instructor, Credits, e.Status FROM Course AS c JOIN Enrollment AS e ON c.Course_ID = e.Course_ID JOIN Faculty F ON C.Faculty_ID = F.Faculty_ID WHERE e.Student_ID = $Student_ID and e.Status = 'ENROLLED'";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          echo '<table class="table table-striped">';
          echo '<tr><th>Class</th><th>Description</th><th>Day/Time</th><th>Room</th><th>Instructor</th><th>Units</th><th>Status</th></tr>';
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            echo "<tbody><tr><td>" . $row["Course_NUM"] . "</td><td>" . $row["Course_Title"] . "</td><td>" . $row["Day_Time"] . "</td><td>" . $row["Room"] . "</td><td>" . $row["Instructor"] . "</td><td>" . $row["Credits"] . "</td><td>" . $row["Status"] . "</td></tr></tbody>";
          }
          echo "</table>";
        } else {
          echo "<span style='color: DodgerBlue;' /><strong>You Do Not Have Any Registered Classes</strong></span>";
        }
        $conn->close();
        ?>

      </div>
    </div>
    <!------------ ADD/REMOVE/CART/PREVIOUS COURSE BUTTONS ------------>
    <div class="scheduleButtons">

      <a class="btn-lg btn-dangerous button-background left-button" type="button" href="registrationPage.php">
        <i class="far fa-plus-square"></i> Add Course
      </a>

      <a class="btn-lg btn-dangerous button-background middle-button" type="button" href="drop_course.php">
        <i class="far fa-minus-square"></i> Drop Course
      </a>

      <a class="btn-lg btn-dangerous button-background right-button" type="button" href="previous.php">
        <i class="fas fa-graduation-cap"></i> Previous Courses
      </a>

      <!--<a class="btn-lg btn-dangerous button-background right-button" type="button" href="createcourse.php">
        <i class="fas fa-plus-square"></i> Create A Course -->
      </a>
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