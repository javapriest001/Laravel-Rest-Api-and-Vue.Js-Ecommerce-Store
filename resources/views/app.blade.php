<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->


        <!-- Styles -->




    </head>
    <body>
        <div id="app">

            <h1>New</h1>
            <transition name="slide-fade">
                <router-view :key="$route.fullPath"></router-view>
            </transition>
            <about></about>

        </div>
    </body>
</html>
