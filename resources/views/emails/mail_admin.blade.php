<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{ $body }}<br><br><br>
    @foreach( $reporte as $pais)
        <b>{{$pais->country}}: </b>{{$pais->cantidad}}<br>
    @endforeach
</body>
</html>