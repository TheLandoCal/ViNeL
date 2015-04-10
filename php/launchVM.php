<?php
  $ImageID = (int)$_POST['rdoVM'];
  require '/home/vinel/mysql/scripts/db_conn.php';

  $sql = "SELECT Image.ImageName
          FROM   Image
          WHERE  ImageID='{$ImageID}';";

  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  $ImageName = $rows[0]["ImageName"];
  $CloneName = $rows[0]["ImageName"];

  $sql = "SELECT COUNT(*) AS 'Count' FROM VM WHERE VM.ImageID='{$ImageID}' AND VM.Active=1;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();
  $count = $rows[0]['Count'];

  if ($count != 0) {
      $CloneName .= "_{$count}";
  }

  $result = shell_exec("/vinel/scripts/cloneVM.sh {$ImageName} {$CloneName}");

  $result = shell_exec("VBoxManage showvminfo {$CloneName} | grep '^UUID'");
  $UUID = trim(substr($result, 17));
  $result = shell_exec("VBoxManage showvminfo {$CloneName} | grep 'VRDE port'");
  $port = substr($result, -5);

  echo "<h1 class='page-header'>Launch Single VM</h1>";
  echo "<p>Launch Complete!</p>";
  echo "<label class='control-label'>Use an RDP client to connect to 10.10.10.100:{$port}</label>";

  $sql = "INSERT INTO VM (VMImageID, UUID, Name, Port, Active) VALUES ('{$ImageID}','{$UUID}','{$CloneName}','{$port}','1');";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  $db = null;
?>
