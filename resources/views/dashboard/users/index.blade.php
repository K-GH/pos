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

            <div class="box-header with-boarder ">
                 <h3 class="box-title" style="margin-bottom: 15px">@lang('site.users') <small>{{$users->total()}}</small></h3>

                <form action="{{route('dashboard.users.index')}}" method="GET">

                    <div class="row">

                        <div class="col-md-4">
                              <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                        </div>

                        <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"> <li class="fa fa-search"></li> @lang('site.search') </button>
                                @if (auth()->user()->hasPermission('create_users'))
                                      <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"> <li class="fa fa-plus"></li> @lang('site.add') </a>
                                @else
                                <a href="#" class="btn btn-primary disabled"> <li class="fa fa-plus"></li> @lang('site.add') </a> 
                                @endif
                                
                        </div>

                    </div>

                </form>
            </div>
            <div class="box-body">
              @if ($users->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.image')</th>
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
                                    <td><img src="{{ $user->image_path }}" style="width: 100px" class="img-thumbnail" alt=""></td>
                                    <td>
                                    @if (auth()->user()->hasPermission('update_users'))
                                         <a href=" {{route('dashboard.users.edit' , $user->id)}} "  class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit') </a>
                                    @else
                                         <a href="#" class="btn btn-info btn-sm disabled"> <i class="fa fa-edit"></i> @lang('site.edit') </a>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_users'))
                                            <form action="{{route('dashboard.users.destroy', $user->id)}}" method="POST" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger btn-sm delete" >  <i class="fa fa-trash"></i>@lang('site.delete')</button>
                                           </form>  
                                    @else
                                           <button class="btn btn-danger  btn-sm disabled"> <i class="fa fa-trash"></i> @lang('site.delete') </button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- end of table --> 
                    {{-- links() to run paginate from userscontroller , appends(request()->query) da 3lshan yafdal append key of search mat3'yrash m3a links --}}
                    {{$users->appends(request()->query())->links()}}
                  
              @else
                  <h2>@lang('site.no_data_found')</h2>
              @endif
            </div><!-- end of box body --> 
        </div>
    </section>
        
</div>


@endsection