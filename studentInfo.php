<?php

$proles = array('Student', 'Admin');
require_once 'checksession.php';

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$Student_ID = $_SESSION['user'];
$query = "Select * from Student where Student_ID = $Student_ID";
$result = $conn->query($query);
if(!$result) die ($conn->error);
$result->data_seek(0);
$row = $result->fetch_array(MYSQLI_NUM);
$first = $row[1];
$last = $row[2];
$email = $row[3];
$address = $row[4];
$city = $row[5];
$state = $row[6];
$zip = $row[7];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

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
                        <a class="dropdown-item" href="studentInfo.php">Update Student Information</a>
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
          <div class="student-info-container"><?php echo "$first $last";?></div>
          <hr style="width: 99%; color: white; height: 1px;;background-color:white;" />

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal Content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;
                  </button>
                  <h4 class="modal-title">Upload A Profile Picture</h4>
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
		<form method='post' action='studentInfo.php'>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="Email">Email</label>
              <input type="email" class="form-control" name="Email" id="Email" Value="<?php echo $email;?>" />
            </div>
            <div class="form-group col-md-6">
              <label for="Password">Password</label>
              <input type="password" class="form-control" name="Password" id="Password" Value="Under Construction" />
            </div>
          </div>
          <div class="form-group">
            <label for="Address">Address</label>
            <input type="text" class="form-control" name="Address" id="Address" Value="<?php echo $address;?>" />
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="City">City</label>
              <input type="text" class="form-control" name="City" id="City" Value="<?php echo $city;?>" />
            </div>
            <div class="form-group col-md-4">
              <label for="State">State</label>
              <select name="State" id="State" class="form-control">
                <option selected placeholder> <?php echo $state; ?> </option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="Zip">Zip</label>
              <input type="text" class="form-control" name="Zip" id="Zip" Value="84101" />
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

if(isset($_POST['Email']) &&
	isset($_POST['Address']) &&
	isset($_POST['City']) &&
	isset($_POST['State']) &&
	isset($_POST['Zip'])) {
		$email=$_POST['Email'];
		$address=$_POST['Address'];
		$city=$_POST['City'];
		$state=$_POST['State'];
		$zip=$_POST['Zip'];
		echo $state;
		$query="UPDATE Student SET 
			Email = '$email',
			Address = '$address',
			City = '$city',
			Addr_state = '$state',
			ZIP = '$zip'
			WHERE Student_ID = $Student_ID;";
		$result=$conn->query($query);
		
		echo "Success!";

		if(!$result) {
			echo "Update failed: $query <br>" .
			$conn->error . "<br><br>";
		}
		$conn->close();
		echo "<meta http-equiv='refresh' content='0'>";
	}else echo "Fill yo fields";

$conn->close();	

?>