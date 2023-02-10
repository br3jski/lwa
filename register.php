<?php
session_start();

// Connect to the database
$db = mysqli_connect('localhost', 'username', 'password', 'service_management');

// Check for database connection errors
if (mysqli_connect_errno($db)) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo 'You must be logged in to add new users.';
} else if (isset($_POST['submit'])) {
    // Get the user-submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the insert statement
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    // Execute the insert statement
    if (!mysqli_query($db, $query)) {
        echo 'Failed to insert user: ' . mysqli_error($db);
    } else {
        echo 'User ' . $username . ' was successfully created.';
    }
} else {
    // Display the form
    ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" name="submit" value="Create User">
    </form>
    <?php
}

// Close the database connection
mysqli_close($db);
?>
