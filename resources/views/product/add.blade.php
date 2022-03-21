@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_add_title',["app_name" => __('app.app_name'),"module"=> __('app.product')])}}
@endsection
@push('externalCssLoad')

@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>{{trans('app.product')}} {{trans('app.management')}}</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li><a href="{{url('/product/')}}">{{trans('app.product')}} {{trans('app.management')}}</a></li>
                <li class="active">{{trans('app.add')}} {{trans('app.product')}}</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">{{trans('app.add')}} {{trans('app.product')}}</div>
                        <div class="panel-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{url('/product/store')}}" name="app_add_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">product Name</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="product_name" id="product_name" placeholder="Name" class="form-control input-sm required" value="{{old('product_name')}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">product Description</label>
                                    <div class="col-sm-6 col-md-4">
                                        <textarea name="product_description" id="product_description" placeholder="Description" class="form-control input-sm required"> {{old('product_description')}} </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">product Price</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="number" name="product_price" id="product_price" placeholder="Price" class="form-control input-sm required" value="{{old('product_name')}}" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Categories <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control input-sm required" name="product_category_id" id="product_category_id">
                                            <option value="">{{trans('app.select')}} Category</option>
                                            @if(count($categoriesData) > 0)
                                                @foreach($categoriesData as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="document" class="col-sm-4 control-label">{{ __('Documents') }}</label>
                                <div class="col-md-6 col-md-4">
                                    <input type="file" name="document[]" multiple class="form-control required">
                                </div>
                                </div>
                                {{ csrf_field() }}
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">{{trans('app.add')}} {{trans('app.product')}}</button>
                                        <a href="{{url('/product/')}}" class="btn btn-space btn-danger btn-lg">Cancel</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('externalJsLoad')
@endpush
@push('internalJsLoad')
<script type="text/javascript">
    $(document).ready(function () {
        app.validate.init();        
    });
</script>
@endpush