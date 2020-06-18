@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.users')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}">  <i class="fa fa-dashboard"> </i> @lang('site.dashboard') </a> </li>
        <li class="active">  </i> @lang('site.users')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.users')</h3>
            </div>
            <div class="box-body">
              @if ($users->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index=>$user)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href=" {{route('dashboard.users.edit' , $user->id)}} " class="btn btn-info btn-sm"> @lang('site.edit') </a>
                                    <form action="{{route('dashboard.users.destroy', $user->id)}}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger btn-sm">@lang('site.delete')</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- end of table --> 
                  
              @else
                  <h2>@lang('site.no_data_found')</h2>
              @endif
            </div><!-- end of box body --> 
        </div>
    </section>
        
</div>


@endsection