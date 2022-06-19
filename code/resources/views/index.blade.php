<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script> window.Laravel = { csrfToken: "{{ csrf_token() }}" }</script>
    <title>Frutos do Oeste</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ mix('css/styles.css') }}" rel="stylesheet"></link>
</head>

<body>
    <div id="app">
        <navbar></navbar>
        <router-view></router-view>
    </div>
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- <script src="js/app.js"></script> -->
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ mix('js/scripts.js') }}"></script>
    <!-- Contact form JS-->
    
    

</body>

</html>

