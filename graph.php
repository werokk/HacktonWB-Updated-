<?php

$json = file_get_contents('https://therapy-box.co.uk/hackathon/clothing-api.php?username=swapnil');

$data = json_decode($json,true);
$name = $data['name'];
echo $name;
$Geonames = $data['payload'];
 $totalNumber  = count($Geonames);
$hoodie= 0;
echo "<pre>";
$hoodie=0;
$jacket=0;
$jumper=0;
$sweater=0;
$blazer=0;
$raincoat=0;
for ($x = 0; $x <= $totalNumber-1; $x++) {
    $fav = $data['payload']{$x}{'clothe'};
switch ($fav) {
    case "hoodie":
        $hoodie++;
        break;
    case "jacket":
        $jacket++;
        break;
    case "jumper":
        $jumper++;
        break;
        case "sweater":
        $sweater++;
        break;
        case "blazer":
        $blazer++;
        break;
        case "raincoat":
        $raincoat++;
        break;
    default:
        echo "Nothing!";
}
    

}



?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Clothe', 'Worn percentage'],
          ['Jacket',     <?php echo $jacket ?>],
          ['Blazer',      <?php echo $blazer ?>],
          ['Raincoat',  <?php echo $raincoat ?>],
          ['Sweater', <?php echo $sweater ?>],
          ['Hoodie',    <?php echo $hoodie ?>],
          ['Jumper',    <?php echo $jumper ?>]

        ]);

        var options = {
          title: '<?php echo $name ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
