<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ERROR</title>
<style>
body {
	background: #009688;
	font-family: sans-serif;
	margin: 0 0 0 150px;
}
#error_window {
	color: #FFFFFF;
	position: absolute;
	top: 20%;
}
#error_window_emotion {
	font-size:100px;
	font-weight:bold;
	margin-bottom:70px;
}
#error_window_message {
	font-size:45px;
	margin-bottom:35px;
	line-height:150%;
}
#error_window_reason {
	font-weight:lighter;
	font-size:18px;
}
</style>
</head>

<body>
<div id="error_window">
  <div id="error_window_emotion">(／‵Д′)／~ ╧╧</div>
  <br>
  <div id="error_window_message">Opps! Something went wrong.<br>
    Sorry about that (◞‸◟)</div>
  <br>
  <span id="error_window_reason">Reason: <?php if (isset($errorMessage)) echo $errorMessage; else echo "No error message available";?></span> </div>
</body>
</html>