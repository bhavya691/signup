<?php

$username = 'root';
$password = '';
$server = 'localhost';
$database = 'verification';

$confirm = mysqli_connect($server , $username , $password , $database);

if ($confirm) {
	?>
	<script>
		alert('connected');
	</script>
	<?php
}else{
	?>
	<script>
		alert('something went wrong');
	</script>
	<?php
}

?>