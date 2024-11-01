
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
// Database configuration
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//include 'connection.php';
// Get the form data


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_POST['name'];
$dob = $_POST['dob'];
$address = $_POST['addres']; // Make sure this matches the form's name attribute
$email = $_POST['email'];
$appointment_date = $_POST['appointment-date'];
$appointment_time = $_POST['time'];
$appointment_type = $_POST['appointment-type'];

// SQL query to insert form data into the database
$sql = "INSERT INTO appointments (user_id,name, dob, address, email, appointment_date, appointment_time, appointment_type) 
        VALUES ('$user_id','$name', '$dob', '$address', '$email', '$appointment_date', '$appointment_time', '$appointment_type')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Appointment</title>
	<link rel="stylesheet" type="text/css" href="appointment.css">
    <script src="appointment.js"></script>
</head>
<body>
	<!-- Applicant Number -->
	<h2>Your User ID: <?php echo htmlspecialchars($user_id); ?></h2>
	
	<!-- Form -->
	<form id="appointmentForm" action="appointment.php" method="post" >
		<!-- Left Side -->
		<div class="left-side">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" ><br><br>
			<label for="dob">Date of Birth:</label>
			<input type="date" id="dob" name="dob" ><br><br>
			<label for="address">Address:</label>
			<input type="text" id="address" name="addres" ><br><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email"><br><br>
		</div>
		
		<!-- Right Side -->
		<div class="right-side">
			<label for="appointment-date">Appointment Date:</label>
			<input type="date" id="appointment-date" name="appointment-date"><br><br>
			<label for="time">Time:</label>
			<select id="time" name="time">
				<option value="">Select Time</option>
				<option value="9:00 AM">9:00 AM</option>
				<option value="10:00 AM">10:00 AM</option>
				<option value="11:00 AM">11:00 AM</option>
				<option value="1:00 PM">1:00 PM</option>
				<option value="2:00 PM">2:00 PM</option>
				<option value="3:00 PM">3:00 PM</option>
			</select><br><br>
			<label for="appointment-type">Appointment Type:</label>
			<select id="appointment-type" name="appointment-type">
				<option value="">Select Type</option>
				<option value="Fresh Passport">Fresh Passport</option>
				<option value="Renewal">Renewal</option>
				<!-- Add more options -->
			</select>
		</div>
		
		<!-- Submit Button -->
		<input type="submit" value="Book Appointment">
	</form>
	
	
</body>
</html>
