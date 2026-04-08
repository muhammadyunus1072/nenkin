@extends('app.layouts.print')

@section('content')
<main class="min-h-screen watermark-container">
    <livewire:exata.exata-preview-candidate.detail>
</main>
@endsection
@section('footer')
    <!-- Table Footer/Summary -->
    <div class="px-8 py-4 bg-surface-container flex justify-between items-center text-[10px] text-on-surface-variant font-medium">
        <div class="flex">
            <span>Total Candidates: 5</span>
        </div>
        <div class="italic">
            * Data updated as of August 24, 2024
        </div>
    </div>
@endsection