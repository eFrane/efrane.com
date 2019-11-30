<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="Portfolio minisite of Stefan 'eFrane' Graupner" />
        @if ($page->production)
        <style data-src="{{ mix('css/main.css', 'assets/build') }}"></style>
        @else
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}" />
        @endif
        <title>eFrane.com: @yield('title')</title>
    </head>
    <body>
        <header class="container mx-auto pt-4">
            <img
                src="/assets/images/avatar@1x.png"
                srcset="/assets/images/avatar@1x.png 1x, /assets/images/avatar@2x.png 2x, /assets/images/avatar@3x.png 3x"
                class="bg-gray-300 object-fill object-center w-12 h-12 sm:w-18 sm:h-18 md:w-24 md:h-24 rounded-full border-gray-700 border mx-auto mb-4"
                aria-hidden="true"
            />
        </header>

        <main class="container sm:mx-2 md:mx-auto">
            @yield('body')
        </main>

        <footer class="container mx-auto mb-4 border-t border-gray-700 pt-2">
            <nav role="complementary">
                <ul class="text-gray-700 text-2xs">
                    <li class="inline pr-2">
                        <a href="/" class="text-blue-700 hover:text-pink-900">Home</a>
                    </li>
                    <li class="inline pr-2">
                        <a href="/imprint" class="text-blue-700 hover:text-pink-900">Imprint</a>
                    </li>
                    <li class="inline">
                        <a href="/privacy" class="text-blue-700 hover:text-pink-900">Privacy</a>
                    </li>
                </ul>
            </nav>
        </footer>
    </body>
</html>
