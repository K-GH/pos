@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.users')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}"> <i class="fa fa-dashboard">     </i> @lang('site.dashboard') </a> </li>
        <li> <a href="{{  route('dashboard.users.index') }}">  @lang('site.users') </a> </li>
        <li class="active">   </i> @lang('site.add')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                <h3 class="box-title">@lang('site.add')</h3>
               
            </div>
            <div class="box-body">
                @include('partials._errors')
               <form action="{{ route('dashboard.users.store')}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="form-group">
                        <label> @lang('site.first_name') </label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }} " >
                    </div>

                    <div class="form-group">
                        <label> @lang('site.last_name') </label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }} ">
                    </div>
                    <div class="form-group">
                        <label> @lang('site.email') </label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }} ">
                    </div>
                    <div class="form-group">
                        <label> @lang('site.password') </label>
                        <input type="password" name="password" class="form-control"  >
                    </div>
                    <div class="form-group">
                        <label> @lang('site.password_confirmation') </label>
                        <input type="password" name="password_confirmation" class="form-control" >
                    </div>
                    <div class="form-group">
                        <button type="submit" btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.add') </button>
                    </div>
                </form>
           
            </div><!-- end of box body --> 
        </div>
    </section>
        
</div>


@endsection