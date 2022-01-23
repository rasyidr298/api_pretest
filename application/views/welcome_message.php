<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>List All Admin</title>
</head>
<body>

<div id="container">
	<h1>Welcome, List All Admin!</h1>

	<div id="body">
		<table border="1">
			<tr>
				<th>Email</th>
				<th>Nama</th>
			</tr>
			<?php foreach ($admins as $key => $admin) { ?>
			<tr>
				<td><?php echo $admin->nama ?></td>
				<td><?php echo $admin->email ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>