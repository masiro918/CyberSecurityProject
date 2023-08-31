<?php 

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
	<!-- there is xss, instead use sessions -->
	<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
	<textarea name="message"></textarea>
	<input type="submit" value="Add!">
	</form>
	<br>
	<?php
		include("db_conn.php");
		
		$conn = make_connection();
		$query = $conn->prepare("SELECT * FROM Messages ORDER BY timestamp DESC");
		$query->execute();

		while ($line = $query->fetch()) {
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
