<!DOCTYPE html>
<html>
	<head>
		<title>Won a Ritual</title>
	</head>
	<body>

		Hi {{$request->user()->name}},

			<br /><br />

		you performed a ritual with code <b>{{$request->code}}</b> AND WON!!!

			<br />

		Congratulations!

			<br />

		You'll recieve an email within the next hour with your prize.

			<br /><br />

		Kind regards

			<br />

		Rituals

	</body>
</html>