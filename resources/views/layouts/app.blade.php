<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script src="https://kit.fontawesome.com/29fb9dfedd.js"></script>
    <script>tinymce.init({ 
        selector:'#post-editor',
        plugins:'codesample link lists',
        toolbar:'undo redo bold italic codesample link bullist',
        menubar:'false',
        body_id:'editor'
        });
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('inc.navbar')
        <div class="wrapper container">

            <div class="row">
                    <div id="content">
                        <div class="container">
                            <main class="py-4">
                                @yield('content') 
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    <script>
        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });   

        });
        </script>
</body>

</html>
