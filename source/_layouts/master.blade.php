<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="Portfolio minisite of Stefan 'eFrane' Graupner" />
        <style data-src="{{ mix('css/main.css', 'assets/build') }}">
        </style>
        <title>eFrane: portfolio</title>
    </head>
    <body>
        <header class="container mx-auto pt-4">
            <h1>
                <span class="sr-only">eFrane's portfolio minisite</span>
                <img
                    src="assets/images/avatar@1x.png"
                    srcset="assets/images/avatar@1x.png 1x, assets/images/avatar@2x.png 2x, assets/images/avatar@3x.png 3x"
                    class="bg-gray-300 object-fill object-center w-24 h-24 rounded-full border-gray-700 border mx-auto mb-4"
                    aria-hidden="true" />
            </h1>
        </header>

        <main class="container mx-auto">
            @yield('body')
        </main>
    </body>
</html>
