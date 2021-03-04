<?php

$dsn = "mysql:host=localhost;dbname=itech_lab1";
$user = "root";
$pass = "";

try {

  $dbh = new PDO($dsn, $user, $pass);


  $sqlSelect = "SELECT player.ID_Player, player.name FROM player";

  echo "<select>";
  foreach ($dbh->query($sqlSelect) as $row) {
    echo $row['ID_Player']." ".$row['name']."<br>";
    echo "<option value=\"".$row['ID_Player']."\">".$row['name']."</option>";
  }
  echo "</select>";

} catch (PDOException $ex) {

  echo $ex->GetMessage();

}
$dbh = null;

?>

<!--
<select name="player">
  <option value="null">-SELECT-</option>

</select>
-->

            <select Emp Name='NEW'>
            <option value="">--- Select ---</option>
            <?
                mysql_connect ("localhost","root","");
                mysql_select_db ("company");
                $select="company";
                if (isset ($select)&&$select!=""){
                $select=$_POST ['NEW'];
            }
            ?>
            <?
                $list=mysql_query("select * from employee order by emp_id asc");
            while($row_list=mysql_fetch_assoc($list)){
            ?>
            <option value="<? echo $row_list['emp_id']; ?>">  <?echo $row_list['emp_name'];?></option>
                <?
                }
                ?>
            </select>
