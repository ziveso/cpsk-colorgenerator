@extends('layouts.master')

@section('content')
    <div id='app'></div>
@stop

@push('js-stack')
    <script type="text/javascript">
        const siteName = '@setting('core::site-name')'
        const createApi = '{{ route('color.create') }}'
    </script>

    {!! Theme::script('js/react/index.js')!!}
@endpush