<!DOCTYPE html>
<html lang="en" data-layout="mini">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Streamline your business with our advanced CRM template. Easily integrate and customize to manage sales, support, and customer interactions efficiently. Perfect for any business size">
    <meta name="keywords"
        content="Advanced CRM template, customer relationship management, business CRM, sales optimization, customer support software, CRM integration, customizable CRM, business tools, enterprise CRM solutions">
    <meta name="author" content="Dreams Technologies">
    <meta name="robots" content="index, follow">
    <title>CRMS</title>
    @include('layout.partials.head')
</head>

<body>
    <body class="mini-sidebar">
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @if(Session::has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ Session::get('success') }}',
                        timer: 6000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        @if(Session::has('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ Session::get('error') }}',
                        timer: 6000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        @if(Session::has('message'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ Session::get('message') }}',
                        timer: 6000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif
        @yield('content')
    </div>
    <!-- /Main Wrapper -->

    @include('layout.partials.footer-scripts')
</body>

</html>
