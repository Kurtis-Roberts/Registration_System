<?php

$proles = array('Admin');
require_once 'checksession.php';

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

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

    <div class="page-header header container-fluid">


        <!-- Form Container -->
        <div class="container">
            <div class="form-container">

                <!-- Trigger the modal with a button -->
                <button button type="button" class="btn user-button">
                    <i class="fas fa-user-edit fa-5x fa-border" data-toggle="modal" data-target="#myModal">
                </button></i>
                <div class="student-info-container">
                    <h3 class="modal-title">Add a Faculty Member</h3>
                </div>
                <hr style="width: 99%; color: white; height: 1px;;background-color:white;" />

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal Content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;
                                </button>

                            </div>

                            <!-- Modal Form -->
                            <div class="modal-body">
                                <form method='' action='' enctype="multipart/form-data">
                                    Select image : <input type='file' name='file' id='file' class='form-control form-box'><br>
                                    <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
                                </form>
                                <!-- Preview-->
                                <div id='preview'></div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Student Info Form -->
                <form method='post' action='add_faculty.php'>
                    <div class="form-row">

                        <label for="Faculty_ID"></label>
                        <?php $Faculty_ID = rand(10001, 32768); ?>
                        <input type="hidden" class="form-control" name="Faculty_ID" Value="<?php echo $Faculty_ID; ?>" />

                        <div class="form-group col-md-6">
                            <label for="Fname">First Name</label>
                            <input type="text" class="form-control" name="Fname" id="Fname" Value="John" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Lname">Last Name</label>
                            <input type="text" class="form-control" name="Lname" id="Lname" Value="Smith" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Title">Title</label>
                            <input type="text" class="form-control" name="Title" id="Title" Value="Adjunct" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Program">Program</label>
                            <select name="Program" id="Program" class="form-control">
                                <option selected placeholder> Select One </option>
                                <option value="1">Information Systems</option>
                                <option value="2">Biomedical Engineering</option>
                            </select>
                        </div>

                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php

if (
    isset($_POST['Fname']) &&
    isset($_POST['Lname'])
) {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $title = $_POST['Title'];
    $program = $_POST['Program'];
    echo $state;
    $query = "INSERT into Faculty (Faculty_ID, Fname, Lname, Title, Program_ID)
				VALUES ($Faculty_ID, '$fname', '$lname', '$title', $program);";
    $result = $conn->query($query);

    echo "Success!";

    if (!$result) {
        echo "Update failed: $query <br>" .
            $conn->error . "<br><br>";
    }
    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
} else echo "Fill yo fields";

$conn->close();

?>