@extends('layout.master')
@section('title', 'Contact')
@section('content')

    <div class="col col-lg-12">
        <div class="row">
            <div class="form">
                <form action="">
                    @csrf
                </form>
            </div>
            <h2>List Banners</h2>
            @if (!empty($banners))
                <x-banner.List :banners="$banners">
                    <x-slot name="tableTitle">
                        <h1 class="btn btn-success">New Banners</h1>
                    </x-slot>
                </x-banner.List>
            @endif
        </div>
    </div>

@stop
