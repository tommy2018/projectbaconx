<?php
header('HTTP/1.1 500 Internal Server Error');
global $setting;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fatal Error</title>
</head>

<body>
<h1>Something went wrong :(</h1>
<h2>We can't process your request at the moment</h2>
<h3>Error: <?php echo($errorMsg) ?></h3>
<hr>
<?php echo($setting['core']['productName'] . ' ' . $setting['core']['productVersion']); ?>

</body>
</html>