<?php
  require '/home/vboxuser/mysql/scripts/db_conn.php';

  $sql = "SELECT Template.TemplateID,
                 OSType.OSName,
                 OSType.ImagePath,
                 OSType.ImageAlt,
                 Template.CPUS,
                 Template.Memory,
                 Template.Storage
          FROM Template
          JOIN OSType
            ON OSType.OSTypeID = Template.OSTypeID;";

  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  foreach($rows as $row) {
    $VM = $row["OSName"];
    $TemplateID = $row["TemplateID"];
    $Memory = $row["Memory"];
    $CPU = $row["CPUS"];
    $HD = $row["Storage"];
    $imgPath = $row["ImagePath"];
    $imgAlt = $row["ImageAlt"];

    echo "<div class='control-group vm-row'>";
    echo "<div class='controls vm-col vm-logo'><img src=$imgPath class='os-logo' alt=$imgAlt></div>";
    echo "<div class='controls vm-col vm-desc'>";
    echo "<label class='control-label'>{$VM}</label>";
    echo "<p>CPU: {$CPU} | Memory: {$Memory}MB | Storage: {$HD}GB </p>";
    echo "</div>";
    echo "<div class='controls vm-col vm-select'>";
    echo "<input type='radio' name='rdoVM' value=$TemplateID id='rdo{$VM}' onclick='this.form.submit();' style='display: none;'>";
    echo "<label for='rdo{$VM}'><input type='button' class='btn btn-primary' value='Select' /></label>";
    echo "</div>";
    echo "</div>";
  }

  $db = null;
?>
