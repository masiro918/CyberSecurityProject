<?php 

session_start();

echo "session " . $_SESSION["username"];


if (!isset($_SESSION["username"])) {
	echo "You are not logged in!";
	die();
}
?>
<html>
<body>
	<h1>Chat</h1>
	
	<a href="logout.php">logout</a>
	
	<form action="add_msg.php" method="post">
	<p>Write your message</p>
	<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
	<textarea name="message"></textarea>
	<input type="submit" value="Add!">
	</form>
	<br>
	<?php
		include("db_conn.php");
		
		$conn = make_connection();

		/*
		 * If we have arguments in sql-query, the example of sql-injection is to put
   		 * user's input as variable to the sql-query e.g. "select * from Messages order by $input".
      		 * In this example case user could list message by own way, but also input dangerous command e.g.
	         * "; DROP TABLE Messages; --".
		 */
		$query = $conn->prepare("SELECT * FROM Messages ORDER BY timestamp DESC");
		$query->execute();

		while ($line = $query->fetch()) {
			/* 
			 * Escape HTML and JavaScript by using htmlspecialchars:
    			   $username = htmlspecialchars($line["username"]);
			   $msg = htmlspecialchars($line["message"]);
			 */
			$username = $line["username"];
			$timestamp = $line["timestamp"];
			$msg = $line["message"];
			echo "<hr>";
			echo "<h3>Username:</h3><p>$username</p>";
			echo "<p><u>Time:</u> $timestamp</p>";
			echo "<p>$msg</p>";
		}
	?>

</body>
</html>
