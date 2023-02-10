<?php
  session_start();

  if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    die("You must be logged in to access this page.");
  }

  // Connect to the database
  include 'db-config.php';
  $conn = mysqli_connect($host, $user, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the list of services and their statuses
  $services = get_services();

  // Start the selected service
  if (isset($_POST['start'])) {
    start_service($_POST['service']);
    $services = get_services();
  }

  // Stop the selected service
  if (isset($_POST['stop'])) {
    stop_service($_POST['service']);
    $services = get_services();
  }
?>
<html>
  <head>
    <title>Zarządzanie usługami</title>
  </head>
  <body>
    <h1>Wybierz usluge z listy</h1>
    <form action="" method="post">
      <label for="services">Select a Service:</label>
        <select name="services" id="services">
          <?php
            $services = array("apache2", "ssh");
            foreach ($services as $service) {
              $output = shell_exec("systemctl is-active $service");
              $status = trim($output);
              if ($status == "active") {
                echo "<option value='$service'>[Running] $service</option>";
              } else {
                echo "<option value='$service'>[Stopped] $service</option>";
              }
            }
          ?>
        </select>
    <input type="submit" value="Start/Stop">
  </form>
  </body>
</html>

<?php
  // Function to get the list of services and their statuses
  function get_services() {
    // Code to retrieve the list of services and their statuses and return an array
    // of service names as keys and statuses as values (e.g. ["Apache2" => "running", "sshd" => "running"])
  }

  // Function to start the selected service
  function start_service($service) {
    // Code to start the selected service
  }

  // Function to stop the selected service
  function stop_service($service) {
    // Code to stop the selected service
  }
?>
