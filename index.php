<?php
include_once 'db-config.php';

$services = array("sshd", "apache2");

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<table border='1'>";
echo "<tr>";
echo "<th>Service Name</th>";
echo "<th>Status</th>";
echo "</tr>";

foreach ($services as $service) {
    $output = shell_exec("systemctl is-active $service");
    $status = trim($output);

    echo "<tr>";
    echo "<td>" . $service . "</td>";

    if ($status == "active") {
        echo "<td style='background-color: green;'>" . $status . "</td>";
    } else {
        echo "<td style='background-color: red;'>" . $status . "</td>";
    }

    echo "</tr>";
}

echo "</table>";

mysqli_close($conn);
?>
