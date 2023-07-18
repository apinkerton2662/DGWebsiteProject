<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'fullsenddb';
// Try and connect using the info above.
$pdo = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check to see if all fields are submitted, prompt user if not
if (!isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	exit('Could not get data!');
}


// Make sure the submitted registration values are not empty.
if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['username']) || empty($_POST['password'])) {
	// One or more values are empty.
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('You must fill out the required fields');
	</script>";
}
$firstName = test_input($_POST['firstname']);
$lastName = test_input($_POST['lastname']);
$email = test_input($_POST['email']);
$address = test_input($_POST['address']);
$city = test_input($_POST['city']);
$state = test_input($_POST['state']);
$zipcode = test_input($_POST['zipcode']);
$phone = test_input($_POST['phone']);
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// PHP Validation
if (!preg_match("/\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+/", $firstName)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('We could not recognize your first name');
	</script>";
}

elseif (!preg_match("/\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+/", $lastName)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('We could not recognize your last name');
	</script>";
}

elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('Your e-mail address is invalid');
	</script>";
}

if (!preg_match("/^((A[AEKLPRSZ])|(C[AOT])|(D[EC])|(F[LM])|(G[AU])|(HI)|(I[ADLN])|(K[SY])|(LA)|(M[ADEHINOST])|(N[CDEHJMVY])|(MP)|(O[HKR])|(P[ARW])|(RI)|(S[CD])|(T[NX])|(UT)|(V[AIT])|(W[AIVY]))$/", $state)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('Please use 2 letter abbreviations for the state');
	</script>";
}

if (!preg_match("/\d{5}([ \-]\d{4})?/", $zipcode)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('Please enter a 5 digit zip code');
	</script>";
}

if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('Your username must be alphanumeric without spaces');
	</script>";
}

if (!preg_match("/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/", $password)) {
	echo "<script>
	window.location.href='index.php?page=signup';
	alert('Passwords must contain 1 uppercase, 1 lowercase, 1 number, and be at least 8 characters long.');
	</script>";
}



// We need to check if the account with that username exists.
if ($stmt = $pdo->prepare('SELECT * FROM customer WHERE Username = ?')) {
	// Bind parameters 
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo "<script>
	window.location.href='index.php?page=signup';
	alert('This username is already taken.');
	</script>";
	} else {
		// Create new account
        if ($stmt = $pdo->prepare('INSERT INTO customer (FirstName, LastName, Email, Address, City, State, ZipCode, Phone, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)' )) {
            $stmt->bind_param('ssssssssss', $firstName, $lastName, $email, $address, $city, $state, $zipcode, $phone, $username, $password);
            $stmt->execute();
            echo "<script>
			window.location.href='index.php?page=login';
			alert('You have successfully registered. You can now login');
			</script>";
        } else {
            // Something is wrong
            echo 'Could not prepare statement!';
        }
	}
	$stmt->close();
} else {
	// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
	echo 'Undefined SQL error, please try again.';
}
$pdo->close();
?>
