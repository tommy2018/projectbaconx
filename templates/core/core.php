<!doctype html>
<html>
<head>
<meta charset="utf-8">
<base href="/">
<title><?php if (isset($this->context['core']['title'])) echo($this->context['core']['title']); ?></title>
<?php
if (isset($this->context['core']['css']))
	foreach ($this->context['core']['css'] as $link)
		echo('<link rel="stylesheet" type="text/css" href="' . $link . '">' . "\n");
		
if (isset($this->context['core']['script']))
	foreach ($this->context['core']['script'] as $link)
		echo('<script src="' . $link . '"></script>' . "\n");
?>
</head>

<body>
<?php if (isset($this->context['core']['body'])) include $this->context['core']['body']; ?>
</body>
</html>