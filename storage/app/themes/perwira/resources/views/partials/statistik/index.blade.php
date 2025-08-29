@extends('theme::template')
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@include('theme::commons.asset_highcharts')

$(document).ready(function() {
    console.log('jQuery version:', $.fn.jquery);
    console.log('Highcharts loaded:', typeof Highcharts !== 'undefined');
    console.log('Highcharts version:', typeof Highcharts !== 'undefined' ? Highcharts.version : 'Not loaded');
    console.log('3D module loaded:', typeof Highcharts !== 'undefined' && typeof Highcharts.chart3d !== 'undefined');
    
    // Show loading status
    if (typeof Highcharts === 'undefined') {
        console.error('❌ Highcharts failed to load');
        $('#container').html(`
            <div class="alert alert-danger text-center">
                <h4>⚠️ Chart Library Error</h4>
                <p>Highcharts library failed to load. Please check your internet connection or contact administrator.</p>
                <button onclick="location.reload()" class="btn btn-primary mt-2">Refresh Page</button>
            </div>
        `);
    } else {
        console.log('✅ Highcharts loaded successfully');
    }
});
</script>
@endpush

@section('layout')
    <div class="container mx-auto flex flex-col-reverse lg:flex-row my-5 gap-3 lg:gap-5 justify-between text-gray-600">
        <div class="lg:w-1/3 w-full">
            @include('theme::partials.statistik.sidenav')
        </div>
        <main class="lg:w-3/4 w-full space-y-1 bg-white rounded-xs px-4 py-2 lg:py-4 lg:px-5 shadow">
            @include('theme::partials.statistik.default')
            <script>
                // Pass PHP variables to JavaScript
                const enable3d = {{ setting('statistik_chart_3d') ? 1 : 0 }};
                const baseUrl = '{{ base_url() }}';
                const currentYear = '{{ $selected_tahun ?? '' }}';
                
                console.log('Statistics Configuration:', {
                    enable3d: enable3d,
                    baseUrl: baseUrl,
                    currentYear: currentYear
                });
            </script>
        </main>
    </div>
@endsection