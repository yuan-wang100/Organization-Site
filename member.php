<html>
	<head>
		<title>Member's Service Hours</title>
	</head>
	<body>
		<?php
			//create variables for username and password
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$password = isset($_POST['password']) ? $_POST['password'] : '';
  
			//connect to mysql database
			$mysql_connect = mysqli_connect("localhost","joeuser","joeuser123","ahs_jc");
  
			if (!$mysql_connect) {
				echo 'Cannot connect to database. Please try again!';
				exit;
			}
  
			//check if user is authorized
			$auth = "select count(*) from users where name = '".$name."' and password = '".$password."'";
			$result = mysqli_query($mysql_connect, $auth);
  
			if(!$result) {
				echo 'Cannot run query.';
				exit;
			}
  
			$row = mysqli_fetch_row($result);
			$count = $row[0];
  
			$query = "select name, service_name, service_date, total_hours from service_hrs where name = '".$name."'";
			$result1 = mysqli_query($mysql_connect, $query);
  
  
			if ($count > 0) {
				//correct username and password combination
				echo "<div align=\"center\" style=\"color:darkblue\">
				<h1><img src=\"ahsmoors_logo.jpg\" height=\"100\" width=\"100\">AHS Junior Civitan Service Club<img src=\"civitan-logo2.png\"></h1>
				<h2> Welcome $name !</h2> 
				<h3> <u>Here are Your Service Hours: </u></h3></div>";
				echo "<br>";
				echo "<table border='1' align='center'>";
				echo "<tr>";
				echo "<th>Name</th>";
				echo "<th>Service Name</th>";
				echo "<th>Service Date</th>";
				echo "<th>Total Hours</th>";
				echo "</tr>";
				while ($row = mysqli_fetch_assoc($result1)){
		   
					echo "<tr>";
					foreach($row as $field=>$value){
						echo "<td align='center'> $value </td>";
					}
					echo "</tr>";		 
				}		
				echo "</table>";		   
			} else { //incorrect username and password combination
				echo "<h1>Access Denied</h1>
				<p> The username and password you entered do not match our records. 
				Please check your spelling and try again!</p>";
			}
  
			mysqli_close($mysql_connect)
  
		?>
	</body>
</html>