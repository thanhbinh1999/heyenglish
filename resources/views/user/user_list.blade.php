<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <th>ID</th>
        <th>Country</th>
        <tbody>
            @foreach($banners->items() as $banner)
            <tr>
                <td>{{$banner->id}}</td>
                <td>{{$banner->country}}</td>
            </tr>
            @endforeach
        </tbody>
        <ul>
            <li> <a href="{{$banners->nextPageUrl()}}">{{$banners->nextPageUrl()}}</a></li>
        </ul>
        {!! $title !!}
    </table>
</body>

</html>