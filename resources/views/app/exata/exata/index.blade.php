@extends('app.layouts.panel')

@section('title', 'Exata')

@section('header')

@stop

@section('content')

    <div class="card">
        <div class="card-header">
            @if (auth()->user()->hasRole('Admin'))
                <livewire:exata.exata.filter>
            @endif
        </div>
        <div class="card-body">
            <livewire:exata.exata.datatable lazy>
        </div>
    </div>
@stop
