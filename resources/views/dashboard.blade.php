@extends('layouts.common')
@section('pageTitle')
    {{__('app.dashboard_title',["app_name"=> __('app.app_name')])}}
@endsection
@push('externalCssLoad')
<link rel="stylesheet" href="{{url('css/plugins/jquery-jvectormap-1.2.2.css')}}" type="text/css" />
<link rel="stylesheet" href="{{url('css/plugins/jqvmap.min.css')}}" type="text/css" />
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
            </ol>
        </div>
        <div class="container">
    <div class="row"style="margin-bottom:100px;">
       <div class="col-md-4 box">Total User : {{$user ?? ''}}</div>
       <div class="col-md-4 box">Total Product: {{$product ?? ''}}</div>
       <div class="col-md-4 box">Total Category: {{$categories ?? ''}}</div>
    </div>
</div>
    </div>
@endsection

@push('externalJsLoad')
<script src="{{url('js/plugins/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.vmap.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/countUp.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.orderBars.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/curvedLines.js')}}" type="text/javascript"></script>

@endpush
@push('internalJsLoad')
<script type="text/javascript">
    $(document).ready(function () {
        App.charts();
    });
</script>
@endpush