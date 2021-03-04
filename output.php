<?php

$dsn = "mysql:host=localhost;dbname=itech_lab1";
$user = "root";
$pass = "";

$button = $_GET['button'];

try {

  $dbh = new PDO($dsn, $user, $pass);

  switch ($button) {

    case 'Matches with this player':
        $player = $_GET['player'];

        $sqlSelect = "SELECT * FROM game
                      WHERE game.FID_Team1 IN (SELECT FID_Team FROM player WHERE player.ID_Player = :player)
                      OR game.FID_Team2 IN (SELECT FID_Team FROM player WHERE player.ID_Player = :player)";

        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(":player" => $player));
        $res = $sth->fetchAll();

        echo "<table>";
        echo "<tr><th>ID</th><th>DATE</th><th>PLACE</th><th>SCORE</th><th>T1</th><th>T2</th></tr>";
        foreach ($res as $row) {
          echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
        }
        echo "</table>";
      break;

    case 'Matches for this league':
        $league = $_GET['league'];

        $sqlSelect = "SELECT * FROM game
                      WHERE game.FID_Team1 IN(SELECT ID_TEAM FROM team WHERE team.league = :league)
                      OR game.FID_Team2 IN(SELECT ID_TEAM FROM team WHERE team.league = :league)";

        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(":league" => $league));
        $res = $sth->fetchAll();

        echo "<table>";
        echo "<tr><th>ID</th><th>DATE</th><th>PLACE</th><th>SCORE</th><th>T1</th><th>T2</th></tr>";
        foreach ($res as $row) {
          echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
        }
        echo "</table>";
      break;

    case 'Matches from this interval':
        $date1 = str_replace("-", "/", $_GET['datetime1']);
        $date2 = str_replace("-", "/", $_GET['datetime2']);

        if (isset($date1) && isset($date2)) {
          if ($date1 > $date2) {
            echo "First date must come before the second one";
          }else {
              echo "Matches from $date1 to $date2";
          }
        }else {
          echo "Dates are not defined";
        }


        $sqlSelect = "SELECT * FROM game
                      WHERE game.date BETWEEN ? and ? ";

        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array($date1, $date2));
        $res = $sth->fetchAll();

        echo "<table>";
        echo "<tr><th>ID</th><th>DATE</th><th>PLACE</th><th>SCORE</th><th>T1</th><th>T2</th></tr>";
        foreach ($res as $row) {
          echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
        }
        echo "</table>";


      break;
  }

} catch (PDOException $ex) {

  echo $ex->GetMessage();

}
$dbh = null;

 ?>

<style media="screen">
  table, th, td {
    border: 1px solid white;
    color: white;
    background-color: black;
  }

  td{
    padding: 5px;
  }
</style>

<!-- МАТЧИ МЕЖДУ ДАТАМИ
 SELECT * FROM game
 WHERE game.date BETWEEN '2020/12/17' and '2021/02/10'
 -->

<!-- ЧЕМПИОНАТЫ ПО ЛИГЕ
SELECT * FROM game
WHERE game.FID_Team1 IN(SELECT ID_TEAM FROM team WHERE team.league = 'Premier-league')
OR game.FID_Team2 IN(SELECT ID_TEAM FROM team WHERE team.league = 'Premier-league')
 -->

<!-- МАТЧИ В КОТОРЫХ БЫЛ ИГРОК
SELECT * FROM game
WHERE game.FID_Team1 IN (SELECT FID_Team FROM player WHERE player.ID_Player = 1)
OR game.FID_Team2 IN (SELECT FID_Team FROM player WHERE player.ID_Player = 1)
-->
