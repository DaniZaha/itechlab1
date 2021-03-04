<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LAB 1</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>

  <?php
    $dsn = "mysql:host=localhost;dbname=itech_lab1";
    $user = "root";
    $pass = "";

    $dbh = new PDO($dsn, $user, $pass);

    $sqlPlayers = "SELECT player.ID_Player, player.name FROM player";
    $sqlLeagues = "SELECT DISTINCT team.league FROM team";
  ?>
<div class="forms">

  <form action="output.php" method="get" id="getDates">
    <label for="datetime1"> Matches from </label>
    <input type="date" name="datetime1" value="">
    <label for="datetime2"> to </label>
    <input type="date" name="datetime2" value="">
    <input type="submit" value="Matches from this interval" name="button">
  </form>

  <form action="output.php" method="get" id="getPlayer">
    <label for="player">Matches with</label>
    <select name="player">
      <?php
      foreach ($dbh->query($sqlPlayers) as $row) {
        echo "<option value=\"".$row['ID_Player']."\">".$row['name']."</option>";
      }
      ?>
    </select>
    <input type="submit" value="Matches with this player" name="button">
  </form>

  <form action="output.php" method="get" id="getLeague">
    <label for="league">Matches for</label>
    <select name="league">
      <?php
      foreach ($dbh->query($sqlLeagues) as $row) {
        echo "<option value=\"".$row['league']."\">".$row['league']."</option>";
      }
      ?>
    </select>
    <input type="submit" value="Matches for this league" name="button">
  </form>

</div>

</body>
</html>
