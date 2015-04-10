<?php
  $TemplateID = (int)$_POST['rdoVM'];
  require '/home/vboxuser/mysql/scripts/db_conn.php';
  $sql = "SELECT OSType.OSName,
                 Template.Storage,
                 Template.CPUS,
                 Template.Memory
          FROM Template
          JOIN OSType
            ON Template.OSTypeID = OSType.OSTypeID
          WHERE Template.TemplateID = {$TemplateID};";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  echo "<div class='table-responsive'>";
  echo "<table class='table table-striped'><thead><tr>";
  echo "<th>Operating System</th><th>Storage (GB)</th><th>CPU</th><th>Memory (MB)</th><th></th></tr></thead>";
  echo "<tbody><tr style='height: 65px;'><td>{$result[0]['OSName']}</td><td>{$result[0]['Storage']}</td><td>{$result[0]['CPUS']}</td><td>{$result[0]['Memory']}</td>";
  echo "<td><div class='spinner' id='spinner'></div></td>";
  echo "</tr></tbody></table>";
  $db = null;

  echo "<input type='radio' name='rdoVM' value=$TemplateID id='rdoConfirm' style='display: none; '>";
  echo "<label for='rdoConfirm'><input type='button' id='btnConfirm' class='btn btn-primary' value='Confirm' /></label>";
  echo "<input type='radio' name='rdoVM' value=0 id='rdoCancel' style='display: none;'>";
  echo "<label for='rdoCancel'><input type='button' id='btnCancel' class='btn btn-primary' value='Cancel' style='margin-left: 5px' /></label>";
?>
