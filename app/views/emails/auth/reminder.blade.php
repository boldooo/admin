<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form: <a href="{{ URL::to('token', array($token)) }}" target="_blank">{{ URL::to('token', array($token)) }}</a>.
		</div>
	</body>
</html>