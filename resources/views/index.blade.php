<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="main" style="background:blue">
    <div id="menu">
        @php
            $items = ['Home','Users','Banners'];
        @endphp
        <x-dynamic-component component="menu" :items="$items" name="menu-component" style="color:red">
            <div class="title">Menu Component</div>
        </x-dynamic-component>
    </div>

    <div id="content">

    </div>

    <div id="footer">

    </div>
    @stack('scripts')
</body>

</html>