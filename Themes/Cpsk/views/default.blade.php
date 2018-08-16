@extends('layouts.master')

@section('content')
    <div id='app'></div>
@stop

@push('css-stack')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
@endpush

@push('js-stack')
    <script type="text/javascript">
        const siteName = '@setting('core::site-name')'
        const createApi = '{{ route('color.create') }}'
        const studentApi = '{{ route('student.data') }}'
    </script>

    {!! Theme::script('js/react/index.js')!!}
@endpush