<?php
  require "/home/vboxuser/mysql/scripts/db_conn.php";
  $sql = "SELECT VMID,
                 Name
          FROM   VM
          WHERE  Active=1
            AND  HOUR(TIMEDIFF(NOW(), LaunchTime)) >= 2;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  foreach($rows as $row) {
    $VMName = $row["Name"];
    $result = shell_exec("/media/ViNeL/VMs/poweroffVM.sh {$VMName}");
    $result = shell_exec("/media/ViNeL/VMs/deleteVM.sh {$VMName}");
    $sql = "UPDATE VM SET Active='0' WHERE VMID='{$VMID}';";
    $stmt = $db->prepare($sql);
    $stmt->execute();
  }

  $runningvms = shell_exec("VBoxManage list runningvms");
  $runningvms = explode("\n", $runningvms);
  $running = array();

  $allvms = shell_exec("VBoxManage list vms");
  $allvms = explode("\n", $allvms);
  $vms = array();

  foreach($runningvms as $runningvm) {
  	if(!empty($runningvm)) {
      list($k, $v) = explode(" ", $runningvm);
      $running[trim($k,'"')] = trim($v, "{}");
    }
  }

  foreach($allvms as $allvm) {
  	if(!empty($allvm)) {
      list($VMName, $UUID) = explode(" ", $allvm);
      $VMName = trim($VMName,'"');
      if(!array_key_exists($VMName, $running)) {
      	$result = shell_exec("/media/ViNeL/VMs/deleteVM.sh {$VMName}");
      	$sql = "UPDATE VM SET Active='0' WHERE Name='{$VMName}' AND Active='1';";
	    $stmt = $db->prepare($sql);
	    $stmt->execute();
      }
    }
  }

  $db = null;
?>
