<?php
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect('localhost','id4813571_rocco1991','rocco1991', 'id4813571_hackatondb');


session_start();
 
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $_SESSION['username'] ;
} else {
    //echo "Please log in first to see this page.";
        header("location: index.php");

}


include('sport.php');
include('bbc.php');
 ?>
 <?php

$json = file_get_contents('https://therapy-box.co.uk/hackathon/clothing-api.php?username=swapnil');

$data = json_decode($json,true);
$name = $data['name'];
$Geonames = $data['payload'];
 $totalNumber  = count($Geonames);
$hoodie= 0;
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
 <html lang="en" dir="ltr">
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
  'width':650,
  'height':350,
  backgroundColor:{ 'fill': 'transparent' }
}




        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
       <style>

h1, h3, p {
    color: black;
}

td{
    padding:20px;
    border-bottom: 2px solid black;
}
</style>
     <meta name="viewport" content="width=device-width, initial-scale=1 ">
     <link rel="stylesheet" type="text/css" href="style.css">
     <meta charset="utf-8">
     <title>Welcome</title>
   </head>
   <body >

 <a href ="logout.php"style="float: right;"> Log Out </a>

 <?php

$username = $_SESSION['username'];
$con = mysqli_connect('localhost','id4813571_rocco1991','rocco1991', 'id4813571_hackatondb');
$q = mysqli_query($con, "SELECT * FROM usertable1 WHERE username = '$username'");
$row = mysqli_fetch_assoc($q);
$image = $row['imagename'];
 $username = $_SESSION['username'];
 if ($row['imagename'] === "") {
    echo "<img width='100' height='100' src='Images/profilepic.png' alt='Default Profile Pic'>";
  }else {
 	echo "<img width='100' height='100' src='Images/$username/$image' alt='Profile Pic'>";
}

?>
 

 <h1 style="text-align:center";>Good day <?php  echo $username ?>!</h1>

<div class="whole">
   <div class="row">
  <div class="column" >
      <h1>Weather</h1>
      <div class="centered">
    <h1 style="text-align:center;font-size: 3.5em;margin-top: 0px;"id="weather"> ℃ </h1>
        <div id="icon" ></div>
    <h2 style="text-align:center;font-size: 1.7em;"id="wDescr"> </h2>
  </div>
  </div>
  <a href="mainnews.php">
  <div class="column" >
            <h1>News</h1>

            <div class="centered">

    <?php
    foreach(fetch_news()as $article){
      ?>
      <h3><?php echo $article['title']; ?></h3>
      <p style="padding:  6px;"> <?php echo $article ['description']; ?></p>
        <?php
    }

    ?>
  </div>
  </div>
  </a>
<a href="test.php">
  <div class="column">
                  <h1>Sport</h1>
<div class="centered">

    <?php
    foreach(get_news()as $article){
      ?>
      <h3><?php echo $article['title']; ?></h3>
      <p style="padding:  6px;"> <?php echo $article ['description']; ?></p>
        <?php
    }

    ?>
  </div>
            
</div>
  </a>
<a href="images.php">
<div class="row">
  <div class="column" >
            <h1>Photos</h1>
            <?php

$dir_path = "Images/fullsized/";
$extensions_array = array('jpg','png','jpeg');

if(is_dir($dir_path))
{
    $files = scandir($dir_path);
    
    for($i = 0; $i < 6; $i++)
    {
        if($files[$i] !='.' && $files[$i] !='..')
        {

            // get file extension
            $file = pathinfo($files[$i]);


            // show image
            echo "<img src='$dir_path$files[$i]' style='width:170px;height:100px; padding:5px'>";
            
        }
    }
}
?>

   
  </div>
  </a>
  <a href="list.php">
  <div class="column" >
            <h1 style="position:absolute;margin-left: 158px;">Tasks</h1>
            <div style="overflow-y: scroll">
      <table style="width:316px;  margin-top: 88px;margin-left: 60px;overflow-y: scroll;height: 209px;display:block;">
	<thead>
		<tr>
		
		</tr>
	</thead>

	<tbody>
		<?php
		// select all tasks if page is visited or refreshed
    $username = $_SESSION['username'];
		$tasks = mysqli_query($db, "SELECT * FROM items where username ='$username' ");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td>
                <?php
if ($row['done']==1) {
			echo '<input name="uploadto" type="checkbox"  checked>';

} else {
			echo '<input name="uploadto" type="checkbox"  >';
}
?>

				</td>
			</tr>
		<?php $i++; } ?>
	</tbody>
</table>
</div>
  </div>
  </a>

  <div class="column">
            <h1>Clothes</h1>
    <div id="piechart" style="width: 900px;height: 500px;margin-left:  -88px;margin-top: -64px;"></div>
  </div>
</div>
</div>

   </body>
   <script src="script.js" charset="utf-8"></script>


 </html>