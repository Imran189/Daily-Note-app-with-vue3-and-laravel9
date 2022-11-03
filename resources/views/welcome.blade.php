<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
        <title>Daily Notes</title>
        
        @vite('resources/sass/app.scss')
    </head>
    <body class="antialiased">
       <div id="app"></div>
       
       @vite('resources/js/app.js')
    </body>
</html>
