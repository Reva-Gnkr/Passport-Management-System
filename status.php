

<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is empty
$dbname = "your_database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//include 'connection.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the applicant number from the form
    $userid = $_POST["userid"];

    // Check if applicant number is provided
    if (!empty($applicant_number)) {
        // Query to check the status in the database
        $sql = "SELECT FROM users WHERE user_id = ?";
        
        // Prepare statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $stmt->store_result();
        $status=rand("pending","done","almost done","reviewed")
        // Check if a record is found
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($status);
            $stmt->fetch();
            echo "<h3>Status for Applicant Number $userid: $status</h3>";
        } else {
            echo "<h3>No application found with Applicant Number $userid</h3>";
        }
        $stmt->close();
    } else {
        echo "<h3>Please provide an Applicant Number</h3>";
    }
}

$conn->close();
?>

