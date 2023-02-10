<?php

include_once 'db-config.php';

$servers = [
  "google.com",
  "wp.pl",
  "lowendtalk.com"
];

$status = [];

foreach ($servers as $server) {
  $pingresult = exec("ping -n 1 $server", $outcome, $status);
  if (0 == $status) {
    $status[$server] = [
      'status' => 'UP',
      'color' => 'green'
    ];
  } else {
    $status[$server] = [
      'status' => 'DOWN',
      'color' => 'red'
    ];
  }
}

?>

<html>
<head>
  <style>
    .status_up {
      color: green;
    }
    
    .status_down {
      color: red;
    }
  </style>
</head>
<body>
  <table>
    <tr>
      <th>Server</th>
      <th>Status</th>
    </tr>
    <?php foreach ($status as $server => $data): ?>
      <tr>
        <td><?php echo $server; ?></td>
        <td class="status_<?php echo strtolower($data['status']); ?>"><?php echo $data['status']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
