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

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            width: auto;
            height: auto;
        }
    </style>
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

                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!---------- FORM CONTENT ------------->
    <div class="page-header header container-fluid">
        <div class="form-row">
            <div class="container col-md-4">
                <div class="form-container report">
                    <h4 class="modal-title">Enrollment Info</h4>

                    <?php
                    session_start();
                    require_once 'dbInfo.php';

                    $proles = array('Admin', 'Advisor');


                    //require_once'checksession.php';

                    // Create connection
                    $conn = new mysqli($hn, $un, $pw, $db);
                    if ($conn->connect_error) die($conn->connect_error);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $query = "SELECT CONCAT(S.Fname, ' ', S.Lname) AS Student, C.Course_NUM, Concat(F.Fname, ' ', F.Lname) AS Faculty, CONCAT(C.Semester, ' ', C.Course_Year) As Semester, E.Grade  
								FROM Enrollment AS E 
								JOIN Student AS S ON E.Student_ID = S.Student_ID
								JOIN Course AS C on E.Course_ID = C.Course_ID
								JOIN faculty AS F ON F.Faculty_ID = C.Faculty_ID";
                    $result = $conn->query($query);
                    if (!$result) die($conn->error);

                    $rows = $result->num_rows;
                    for ($j = 0; $j < $rows; $j++) {
                        $result->data_seek($j);
                        $row = $result->fetch_array(MYSQLI_NUM);

                        echo <<<_END
    <table class="table table-striped">
		<tr>
			<th>Student</th>
			<th>Course</th>
			<th>Instructor</th>
            <th>Semester</th>
            <th>Grade</th>
		</tr>
	<p>
		<tr>
			<td>$row[0]</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
		</tr>
	</p>
	</table>


_END;
                    }

                    $result->close();
                    $conn->close();

                    function get_post($conn, $var)
                    {
                        return $conn->real_escape_string($_POST[$var]);
                    }
                    ?>

                </div>
            </div>
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