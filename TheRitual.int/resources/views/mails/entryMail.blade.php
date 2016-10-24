<!DOCTYPE html>
<html>
	<head>
		<title>Performed a Ritual</title>
	</head>
	<body>

		Hi {{$request->user()->name}}, you performed a ritual with code <h1>{{$request->code}}</h1>.
		We sadly have to inform you that this is not a winning code =/
		Good luck with your next code!

		Kind regards

		Rituals

	</body>
</html>