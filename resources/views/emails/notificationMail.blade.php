<!DOCTYPE html>
<html>
<head>
    <title>Yeniden Danışılan Tedavi Planı Tamamlandı</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>

    <h2>Yeniden Danışılan Tedavi Planı Tamamlandı!</h2>
    <p>{{ $body['message'] }}</p>
    <a href="https://sales.arpanumedical.com/doctor/treatmentplan/edit/{{ $body['treatment_plan_id'] }}" class="btn btn-primary">Tedavi Planını Cevapla</a>

</body>
</html>