@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_edit_title',["app_name" => __('app.app_name'),"module"=> __('app.user')])}}
@endsection
@push('externalCssLoad')
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
            <div class="page-head">
            <h2>{{trans('app.user')}} {{trans('app.management')}}</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li><a href="{{url('/user/list')}}">{{trans('app.user')}} {{trans('app.management')}}</a></li>
                <li class="active">{{trans('app.edit')}} {{trans('app.user')}}</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">{{trans('app.edit')}} {{trans('app.user')}}</div>
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
                            <form action="{{url('/user/update')}}" name="app_edit_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">First Name <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control input-sm required" value="{{ $details->first_name ?? old('first_name') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Last Name <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control input-sm required" value="{{ $details->last_name ?? old('last_name') }}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email Address <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="email" id="email" placeholder="Email Editress" class="form-control input-sm required email" readonly value="{{$details->email}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Role <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control input-sm required" name="role" id="role">
                                            <option value="">Select Role</option>
                                            @if(count($userRoleData) > 0)
                                                @foreach($userRoleData as $row)
                                                    <option value="{{$row->id}}" @if($details->role == $row->id){{"selected"}}@endif>{{$row->role}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$details->id}}" />
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">Update {{trans('app.user')}}</button>
                                        <a href="{{url('/user/')}}" class="btn btn-space btn-danger btn-lg">Cancel</a>
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
<script src="{{url('js/modules/user.js')}}"></script>
@endpush
@push('internalJsLoad')
<script type="text/javascript">
        checkParentValid();
        app.validate.init(app.user.action.event.custome_validations());
        app.user.action.event.common();

</script>
@endpush