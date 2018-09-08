<?php

session_start();
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect('localhost','id4813571_rocco1991','rocco1991', 'id4813571_hackatondb');
        $username = $_SESSION['username'];

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			
      $q = mysqli_query($db, "INSERT INTO items (username, task) VALUES ('$username','$task' )");
			header('location: list.php');
		}
	}
  ?>
<!DOCTYPE html>
<html>
   <style>
table, th, td {
    border-bottom: 2px solid white;
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
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<head>
	<title>To do list</title>
</head>
<body>
  
	<div class="heading">
		<h1 style="color: white;">Tasks </h1>
	</div>
	<form method="post" action="list.php" class="input_form" style="margin-left: 475px;margin-right:  auto;">
		<input type="text" name="task" class="text-line" >
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
    <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>
	</form>
  <table style="margin-left:  auto;margin-right:  auto;">
	

	<tbody>
		<?php
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM items WHERE username ='$username'" );
		$done = "";
		$i = 1; 
		while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td >
<?php
if ($row['done']==1) {
			echo '<input name="checkbox" type="checkbox"  checked>';

} else {
			echo '<input name="checkbox" type="checkbox"  >';
}
?>
                 				
                </td>
			</tr>
		<?php $i++; } ?>
	</tbody>
</table>

</body>
</html>
<script>
 $('input:checkbox').change(function(e) {
e.preventDefault();
var isChecked = $("input:checkbox").is(":checked") ? 1:0; 
$.ajax({
          type: 'POST',
          url: '<?php echo $this->url('/profile/list', 'event_status', $cobj->getCollectionID())?>',
        data: { event_status:$("input:checkbox").attr("id"), event_status:isChecked }
});        
});
</script>
