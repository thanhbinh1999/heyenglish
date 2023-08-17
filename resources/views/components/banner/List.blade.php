@props([
    'banners' => [],
    'tableTitle' => ''
])
<div @class(['col col-lg-10'])>
    {{$tableTitle}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>    

        @if (!empty($banners))
            <tbody>
                @foreach ($banners as $index => $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <td><button @class([
                            'btn',
                            'btn-success' => true,
                            'btn-danger' => $index % 2 == 0,
                        ])
                                {{ $attributes->merge(['data-id' => $banner->id, 'type' => 'button']) }}>Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @can
        @endif
    </table>
</div>

@push('scripts')
    <script></script>
@endpush
