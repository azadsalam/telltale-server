<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tell tale</title>
	
</head>
<body>

<div id="container">
 	<div id="body">
		<?php
                     echo "HomePage : ".base_url();
                     echo "<br/>ALL OTHER PAGES";
                ?>

            <br/>
            <a href="<?=base_url()?>index.php/initiate">INITIATE A STORY</a>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>