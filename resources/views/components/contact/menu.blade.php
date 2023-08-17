@props([
    'items' => [],
    'header',
    'footer'
])
@

<div class="menu">
    {{$header}}
    <ul>
       @foreach ($items as $item)
        <li data-id={{$item['id']}} 
        @class(['item','active' =>  $item['active']])
        >
          <span>{{$item['name']}}</span>
        </li>
       @endforeach
    </ul>
    {{$footer}}
</div>