@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('oldcpsk::students.title.create student') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.oldcpsk.student.index') }}">{{ trans('oldcpsk::students.title.students') }}</a></li>
        <li class="active">{{ trans('oldcpsk::students.title.create student') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.oldcpsk.student.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <h1>Create OTHER CPSK DATA</h1>
                    <div class="row">
                        <div class="col-md-6">
                                {!! Form::normalSelect('year', 'year', $errors, [2=>2,3=>3,4=>4]) !!}
                        </div>
                        <div class="col-md-6">
                                {!! Form::normalSelect('type', 'type', $errors, ['SKE'=>'SKE', 'CPE'=>'CPE']) !!}
                        </div>
                        <div class="col-md-6">
                                {!! Form::normalSelect('gender', 'gender', $errors, ['male'=>'male','female'=>'female']) !!}
                        </div>
                        <div class="col-md-6">
                                {!! Form::normalSelect('color', 'color', $errors, ['น้ำตาล'=>'น้ำตาล','แสด'=>'แสด','น้ำเงิน'=>'น้ำเงิน','เขียว'=>'เขียว','เหลือง'=>'เหลือง','แดง'=>'แดง']) !!}
                        </div>
                        <div class="col-md-6">
                                {!! Form::normalInput('total', 'total จำนวน', $errors) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        </div>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.oldcpsk.student.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
