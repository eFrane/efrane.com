<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    </head>
    <body>
        <div class="container mx-auto p-4">
            <img
                src="assets/images/avatar.png"
                class="object-fill object-center w-24 h-24 rounded-full border-gray-600 border mx-auto mb-4">

            @yield('body')
        </div>
    </body>
</html>
