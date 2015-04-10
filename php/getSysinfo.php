<?php
  require "/home/vboxuser/mysql/scripts/db_conn.php";

  $result = preg_split('/\s+/', shell_exec("df -hBM | grep '/media/ViNeL/VMs'"));
  $storage = array("Total" => substr($result[1], 0, -1), "Used" => substr($result[2], 0, -1), "Free" => substr($result[3],0, -1));
  $result = explode("\n", shell_exec("cat /proc/meminfo | grep '^Mem'"));
  $memory = array();
  foreach($result as $row) {
    if(!empty($row)) {
      list($k, $v) = preg_split('/\s+/', $row);
      $memory[substr(trim($k, ":"), 3)] = (int)$v;
     }
  }
  $memory['Used'] = $memory['Total'] - $memory['Free'];

  $result = preg_split('/\s+/', shell_exec("mpstat | grep all"));

  $cpu = array("Total" => 100,"Free" => floatval($result[11]), "Used" => 100 - floatval($result[11]));

  $sql = "SELECT COUNT(*) AS Count FROM Template;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  $vms = array("Total" => $result[0]["Count"]);

  $db = null;

  $sysinfo = array(
                   'Storage' => $storage,
                   'Memory' => $memory,
                   'CPU' => $cpu,
                   'VM' => $vms
             );
  echo json_encode($sysinfo);
?>
