@extends('layouts.master')

@section('content')
    <div id='app'></div>
@stop

@push('js-stack')
    <script type="text/javascript">
        const siteName = '@setting('core::site-name')'
    </script>

    {!! Theme::script('js/react/index.js')!!}
@endpush