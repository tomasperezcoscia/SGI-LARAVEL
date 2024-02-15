<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BasisConstrucciones') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



</head>

<body>
    <!-- Hero Image with Title -->
    <div class="jumbotron text-center" style="position: relative;">
        <h1 class="display-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">BasisConstrucciones</h1>
        <img src="/img/unnamed.jpg" alt="Construction Hero Image" class="img-fluid">
    </div>

    <!-- Description Section -->
    <div class="container my-5">
        <h2>About BasisConstrucciones</h2>
        <p>Your description here...</p>
    </div>

    <!-- Gallery Section -->
    <div class="container my-5">
        <h2>Gallery</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="/path/to/image1.jpg" alt="Image 1" class="img-fluid">
            </div>
            <!-- Repeat for other images -->
        </div>
    </div>

    <!-- Map Section -->
    <div class="container my-5">
        <h2>Our Location</h2>
        <div id="map"></div> <!-- You can use Google Maps or any other map service -->
    </div>

    <!-- Contact Form Section -->
    <div class="container my-5">
        <h2>Contact Us</h2>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name">
            </div>
            <!-- Repeat for other fields -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
