<?php

  $configData = json_decode(file_get_contents('config.json'),true);

  $conn = new mysqli($configData['host'], $configData['root'], $configData['password'], $configData['database']) or die(mysqli_error());

?>
