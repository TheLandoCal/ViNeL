<?php
  $result = preg_split('/\s+/', shell_exec("df -hBM | grep '/media/ViNeL/VMs'"));
  $storage = array("total" => substr($result[1], 0, -1), "used" => substr($result[2], 0, -1), "available" => substr($result[3],0,-1));
  echo json_encode($storage);
?>
