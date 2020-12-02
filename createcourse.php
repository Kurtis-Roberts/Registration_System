<?php

$proles = array('Advisor', 'Admin');
require_once 'checksession.php';

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
    <title>Create Course</title>
</head>

<body>
    <!---------    NAVBAR    --------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="https://cis.utah.edu/">University of Utah</a>
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
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Background Image/Body -->
    <div class="page-header header container-fluid">
        <div class="container">
            <form method="post" action="createcourse.php">
                <!-- Registration/Course Dropdowns -->
                <div class="form-container">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Subject">Subject</label>
                            <select id="Subject" name="Subject" class="form-control ">
                                <option disabled selected value> -- Select a Subject --</option>
                                <option value="1">Information Systems</option>
                                <option value="2">Biomedical Engineering</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Class ID">Class</label>
                            <input type="text" class="form-control" name="Class" id="Class" Placeholder="eg. IS 4410" />
                        </div>
                    </div>
                    <!--END OF TABLE ROW-->

                    <!-- CLASS DESCRIPTION  -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Title ID">Course Description</label>
                            <input type="text" class="form-control" name="Title" id="Title" Placeholder="Information Systems" />
                        </div>



                        <!-- DAY/TIME DESCRIPTION DROPDOWN LIST -->
                        <div class="form-group col-md-3">
                            <label for="IS">Day/Time</label>

                            <select name="day_time" class="form-control">
                                <option disabled selected value> -- Select Day/Time --</option>
                                <option value="M,W; 9:00-11:30">M,W; 9:00-11:30</option>
                                <option value="M,W; 1:00-3:30">M,W; 1:00-3:30</option>
                                <option value="T,TH 9:00-11:30">T,TH 9:00-11:30</option>
                                <option value="T,TH 1:00-3:30">T,TH 1:00-3:30</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>


                        <!-- ROOM DROPDOWN LIST -->
                        <div class="form-group col-md-3">
                            <label for="Room ID">Room</label>
                            <input type="text" class="form-control" name="Room" id="Room" Placeholder="Building+Room" />
                        </div>
                    </div><!-- END OF TABLE ROW-->


                    <!-- PROFESSOR DROPDOWN LIST -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Course">Professor</label>

                            <select name="instructor" class="form-control">
                                <option disabled selected value> -- Select Instructor --</option>
                                <?php
                                require_once 'dbinfo.php';
                                $conn = new mysqli($hn, $un, $pw, $db);
                                if ($conn->connect_error) die($conn->connect_error);

                                $fac_query = "SELECT * FROM Faculty;";
                                $result = $conn->query($fac_query);

                                while ($row = $result->fetch_assoc()) {
                                    unset($id, $name);
                                    $id = $row['Faculty_ID'];
                                    $fname = $row['Fname'];
                                    $lname = $row['Lname'];
                                    echo '<option value="' . $id . '">' . $fname . ' ' . $lname . '</option>';
                                }

                                $conn->close();
                                ?>
                            </select>

                        </div>

                        <!-- UNITS DROPDOWN LIST -->
                        <div class="form-group col-md-2">
                            <label for="units">Units</label>

                            <select id="units" name="units" class="form-control">
                                <option disabled selected value> -- Select Number of Units --
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <!-- YEAR DROPDOWN LIST -->
                        <div class="form-group col-md-2">
                            <label for="year">Year</label>

                            <select id="year" name="year" class="form-control">
                                <option disabled selected value> -- Select Year --
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>

                        <!-- Semester DROPDOWN LIST -->
                        <div class="form-group col-md-2">
                            <label for="semester">Semester</label>

                            <select id="semester" name="semester" class="form-control">
                                <option disabled selected value> -- Select Semester --
                                <option value="Spring">Spring</option>
                                <option value="Summer">Summer</option>
                                <option value="Fall">Fall</option>
                            </select>
                        </div>

                        <input type="submit" name="submit" value="Submit" class="btn btn-primary form-group col-md-3"></input>
                    </div><!-- END OF TABLE ROW-->
                </div>
            </form>
        </div>
    </div>

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

require_once 'dbInfo.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['submit'])) {
    $class = $_POST['Class'];
    $class_description = $_POST['Title'];
    $day_time = $_POST['day_time'];
    $room = $_POST['Room'];
    $instructor = $_POST['instructor'];
    $units = $_POST['units'];
    $program = $_POST['Subject'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];

    $query = "INSERT INTO Course (Course_NUM, Course_Title, Day_Time, Room, Faculty_ID, Credits, Semester, Course_Year, Program_ID) 
		VALUES ('$class', '$class_description', '$day_time', '$room', '$instructor', $units, '$semester', $year, $program)";

    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $query);
    fclose($myfile);

    if ($result = mysqli_query($conn, $query)) {
        $success = "Successful!";
    } else {
        $failure = "Unable to INSERT into DB: " . mysqli_error($conn);
    }

    //header("Location: createcourse.php");
}

$conn->close();


?>