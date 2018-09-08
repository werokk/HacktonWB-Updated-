<!DOCTYPE HTML>  
<html>
            <link rel="stylesheet" type="text/css" href="style.css">

<body> 
<head> 
     <title>Sport</title>

<style>
table, th, td {
    border: 2px solid white;
    border-collapse: collapse;
    margin-top: 50px;
}
input[type=submit] {
    width: 200px;
    height: 62px;
    font-size:2em;
    background-color: yellow;
    border-radius: 4px;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<head>

<?php

// define variables and set to empty values
$teamIn  = "";
$homeLosses = 0;
$awayLosses = 0;
$totalLosses = 0;
$winningTeams = []; 

if ( !($_SERVER["REQUEST_METHOD"] == "POST") )
{  // we reach here only if form was not submitted yet
        $teamIn  = "None";
        $homeLosses = 0;
        $awayLosses = 0;
        $totalLosses = 0;
        $winningTeams = []; 
} 
else
{   

    $teamIn = ucfirst($_POST["teamName"]);  // make first char of teamname a capital

    //---------------------------------------------------------------------------
    // read csv and make an array
    //------------------------------------------------------------------------------
    $fileName = "Results.csv";    // CSV File name changed to "Results.csv" 
    $teams = $fields = array(); $i = 0;
    $handle = fopen($fileName, "r");
    if ($handle) {
        while (($row = fgetcsv($handle, 4096)) !== false) {
            if (empty($fields)) {
                $fields = $row;
                continue;
            }
            foreach ($row as $k=>$value) {
                $teams[$i][$fields[$k]] = $value;
            }
            $i++;
        }
        if (!feof($handle)) {
            die("Error: unexpected fgets() fail\n");
        }
        fclose($handle);
    }
    else{
        die("Did not open file: ".$fileName.PHP_EOL);
    }    


    //---------------------------------------------------------------------------
    // list of team who have beaten the input team
    //------------------------------------------------------------------------------
    $n = 0;
    foreach ($teams as $team){
        if ( $team['HomeTeam'] == $teamIn ){
            if ($team['FTR'] == "A" ) {
                 $homeLosses++;
                 $winningTeams[$n]['date'] = $team['Date'];
                 $winningTeams[$n]['name'] = $team['AwayTeam'];
                 $winningTeams[$n]['location'] = "at Home";
                 $winningTeams[$n]['goalsFor'] = $team['FTAG'];
                 $winningTeams[$n]['goalsAgainst'] = $team['FTHG'];
                 $n++;
            }
        }
        else if  ($team['AwayTeam']== $teamIn){
            if ($team['FTR'] == "H" ) {
                $awayLosses++;
                $winningTeams[$n]['date'] = $team['Date'];
                $winningTeams[$n]['name'] = $team['HomeTeam'];
                $winningTeams[$n]['location'] = "away";
                $winningTeams[$n]['goalsFor'] = $team['FTHG'];
                $winningTeams[$n]['goalsAgainst'] = $team['FTAG'];
                $n++;
            }    
        }
      }
      $totalLosses = $homeLosses+$awayLosses;

}
?>

<!–- This part is the form to enter your team --->
<!–- We submit the form to self- meaning this file --->
<h1 style="color: white;">Sport</h1>
<div class="whole">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin-left: 345px;margin-right:  auto;">     <input  type="text"  class="text-line"  name="teamName">
  <input type="submit" name="submit" value="Submit"style="padding: 10px;">  
</form>
</div>
<!–- This part prints out losses summary --->
<?php
echo "<h2>".$teamIn."</h2>";
echo "<p><b>Summary of Losses</b></p>";
echo "<table>";
echo "  <tr>";
echo "    <th>Team</th>";
echo "    <th>Away Losses</th> ";
echo "    <th>Home Losses</th>";
echo "    <th>Total Losses</th>";  
echo "  </tr>";
echo "  <tr>";
echo "    <td>".$teamIn."</td>";
echo "    <td>".$awayLosses."</td> ";
echo "    <td>".$homeLosses."</td> ";
echo "     <td>".$totalLosses."</td> ";
echo "  </tr>";
echo "</table>";
?>
<!–- This part prints out list of teams who beat the entered team --->
<?php
echo "<p><b>Details of losses</b></p>";
echo "<table>";
echo "  <tr>";
echo "    <th>Beaten By</th>";
echo "    <th>Date</th> ";
echo "    <th>Location</th>";
echo "    <th>Goals For</th>";
echo "    <th>Goals Against</th>"; 
echo "  </tr>";
    foreach ($winningTeams as $winningTeam){
        echo "  <tr>";
        echo "    <td>".$winningTeam['name']."</td>";
        echo "    <td>".$winningTeam['date']."</td>";
        echo "    <td>".$winningTeam['location']."</td>";  
        echo "    <td>".$winningTeam['goalsFor']."</td>"; 
        echo "    <td>".$winningTeam['goalsAgainst']."</td>";     
        echo "  </tr>";
    }
echo "</table>";
?>

</body>
</html>