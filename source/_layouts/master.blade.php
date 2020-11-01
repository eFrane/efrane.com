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

        <main class="container px-2 sm:p-0 sm:mx-auto">
            @yield('body')
        </main>

        <footer class="container mx-auto mb-16 border-t-2 border-mossy-green pt-2">
            <div class="md:flex justify-between mb-2">
                <nav role="complementary" class="mb-2 md:mb-0">
                    <ul class="text-gray-700 text-2xs cursor-default">
                        <li class="inline pr-2 pl-2 sm:pl-0">
                            <a href="/" class="text-mossy-green-light hover:text-mossy-green underline">Home</a>
                        </li>
                        <li class="inline pr-2">
                            <a href="/imprint" class="text-mossy-green-light hover:text-mossy-green underline">Imprint</a>
                        </li>
                        <li class="inline">
                            <a href="/privacy" class="text-mossy-green-light hover:text-mossy-green underline">Privacy</a>
                        </li>
                    </ul>
                </nav>
                <nav role="complimentary">
                    <ul class="text-gray-700 text-2xs cursor-default">
                        <li class="inline pr-2 pl-2 sm:pl-0">
                            <a href="https://brightneonfencing.bandcamp.com" title="Bandcamp">
                                <img src="/assets/images/bandcamp.svg" alt="Bandcamp logo" width="16" height="16" class="inline" />
                            </a>
                        </li>
                        <li class="inline pr-2 pl-2">
                            <a href="https://github.com/eFrane" title="GitHub">
                                <img src="/assets/images/github.svg" alt="GitHub logo" width="16" height="16"  class="inline" />
                            </a>
                        </li>
                        <li class="inline pr-2 pl-2">
                            <a href="https://instagram.com/eFrane" title="Instagram">
                                <img src="/assets/images/instagram.svg" alt="Instagram logo" width="16" height="16" class="inline" />
                            </a>
                        </li>
                        <li class="inline pr-2 pl-2">
                            <a href="https://www.npmjs.com/~efrane" title="npm">
                                <img src="/assets/images/npm.svg" alt="npm logo" width="16" height="16" class="inline" />
                            </a>
                        </li>
                        <li class="inline pr-2 pl-2">
                            <a href="https://packagist.org/users/eFrane/" title="Packagist">
                                <img src="/assets/images/php.svg" alt="php logo" width="16" height="16" class="inline" />
                            </a>
                        </li>
                        <li class="inline pr-2 pl-2">
                            <a href="https://twitter.com/eFrane" title="Twitter">
                                <img src="/assets/images/twitter.svg" alt="Twitter logo" width="16" height="16" class="inline" />
                            </a>
                        </li>
                        <li class="inline pr-2 pl-2">
                            <a href="https://www.youtube.com/channel/UCA9vabs2diMrQP4-Jm32Qwg" title="YouTube">
                                <img src="/assets/images/youtube.svg" alt="YouTube logo" width="16" height="16" class="inline" />
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <img
                    src="/assets/images/bottom.jpg"
                    srcset="/assets/images/bottom-300.jpg 300w, /assets/images/bottom-1280.jpg 1280w"
                    alt="A roof top completely grown over with moss"
                    aria-hidden="true"
            />
        </footer>
    </body>
</html>
