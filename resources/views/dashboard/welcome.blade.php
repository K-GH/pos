@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            @lang('site.dashboard')
        </h1>

        <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard"> </i> @lang('site.dashboard')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.users')</h3>
            </div>
            <div class="box-body">

            </div>
        </div>
    </section>
        
</div>


@endsection