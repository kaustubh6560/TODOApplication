<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="style.css">

<html>
<head>
	<title>ToDo Application </title>

</head>
<body>
	
	<form method="post" action="index.php" class="input_form">
	<div class="login-box">
  <h2>ToDo Application</h2>
  
    <div class="user-box">
      <input type="text" name="task" required="">
      <label>Task</label>
	  <input type="date" name="date" required="">
    </div>
	
    	
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
		
		</div>
	</form>

	<?php 
    // initialize errors variable
	$errors = "";
	
	

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$date = $_POST['date'];
			$sql = "INSERT INTO task (task, date) VALUES ('$task', '$date')";
			
			
			
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}

	if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM task WHERE id=".$id);
	header('location: index.php');
   }
?>
<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>
<div class="login-box1">
<h2>ToDo Task List</h2>

<table border="1" >
	<thead>
		<tr>
			<th style="width: 60px; color:#FFFF">No.</th>
			<th style="width: 900px; color:#FFFF">Tasks</th>
			<th style="width: 150px; color:#FFFF">Tasks</th>
			<th style="width: 150px; color:#FFFF">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
			$tasks = mysqli_query($db, "SELECT * FROM task");

		$i = 1; 
		
		while ($row = mysqli_fetch_array($tasks)) {
			
		?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']?> </td>
				<td class="task"> <?php echo $row['date'] ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">Delete Task</a> 
				</td>
			</tr>
		<?php $i++; } 
		
		?>	
	</tbody>
</table>
</div>
	</body>
</html>
