<?php
// begin logged in session 
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'fullsenddb';
// Connect to database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Check if form data exists
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
// run user input through validation to prevent XSS attacks
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// SQL preparation to prevent injection.
if ($stmt = $con->prepare('SELECT username, password, firstname FROM customer WHERE username = ?')) {
    // Bind parameters
    $stmt->bind_param('s', $username);
    $stmt->execute();
    // Store result to check if account exists in database
    $stmt->store_result();

    // Check if query returns results
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $password, $firstname);
        $stmt->fetch();
        // If account exists, verify password
        if ($_POST['password'] === $password) {
            // Create session for user
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $username;
            $_SESSION['firstname'] = $firstname;
            echo "<script>window.location.href='index.php?page=home';
            alert('You have successfully logged in!');
            </script>";
        } else {

            // Incorrect Password
            echo "<script>
			window.location.href='index.php?page=login';
			alert('Your password is incorrect');
			</script>";
        }
    } else {
        //Incorrect Username
        echo "<script>
			window.location.href='index.php?page=login';
			alert('Your username is incorrect');
			</script>";
    }
}