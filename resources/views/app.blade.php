<!DOCTYPE html>
<html lang="en">

<head>
    @inertiaHead
    @routes
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/logo.svg" type="image/svg+xml">
    <link rel="icon" href="/logo.svg" type="image/svg+xml">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#0F1A2C">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <meta name="msapplication-TileImage" content="/mstile-150x150.png">
    <meta name="msapplication-TileColor" content="#0F1A2C">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="selection:bg-[var(--sea-glass)] selection:bg-gradient-to-r selection:text-[var(--deep-ocean)] ">
    @inertia
</body>

</html>
