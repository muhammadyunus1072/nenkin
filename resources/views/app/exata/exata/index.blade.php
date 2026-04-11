@extends('app.layouts.panel')

@section('title', 'Exata')

@section('header')

@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <livewire:exata.exata.filter>
        </div>
        <div class="card-body">
            <livewire:exata.exata.datatable lazy>
        </div>
    </div>
@stop
