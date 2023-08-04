@props(['items' => [],'name','style'])
@inject('payment', '\App\Services\Payment')
@php
  function showContact(){
    return 'contact';
  }

@endphp
<div>
    <ul style={{$style}}>

        @foreach($items as $item)
        <li>{{$item ?? ''}}</li>
        @endforeach
    </ul>
    Hello:{{$slot}}
    payment : {{$payment->show()}}
</div>

@push('scripts')
<script>
</script>
@endpush