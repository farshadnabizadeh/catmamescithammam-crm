<!DOCTYPE html>
<html>
<head>
    <title>Yeni Tedavi Planı Talebi</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>

    <h2>Yeni Tedavi Planı Talebi Geldi!</h2>
    <a href="https://sales.arpanumedical.com/doctor/treatmentplan/edit/{{ $body['newID'] }}" class="btn btn-primary">Tedavi Planını Cevapla</a>

</body>
</html>