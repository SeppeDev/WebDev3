<!DOCTYPE html>
<html>
	<head>
		<title>Performed a Ritual</title>
	</head>
	<body>

		Hi {{$request->user()->name}},

			<br /><br />

		you performed a ritual with code <b>{{$request->code}}</b>.
		We sadly have to inform you that this is not a winning code =/
		Good luck with your next code!

			<br /><br />

		Kind regards

			<br />

		Rituals

	</body>
</html>