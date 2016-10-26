<!DOCTYPE html>
<html>
	<head>
		<title>Someone Won</title>
	</head>
	<body>

		Hi {{$admin->name}},

			<br /><br />

		{{$request->user()->name}} performed a ritual with code <b>{{$request->code}}</b> and won.

			<br />

		Kind regards

			<br />

		Rituals

	</body>
</html>