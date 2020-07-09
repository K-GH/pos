@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.products')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}">  <i class="fa fa-dashboard"> </i> @lang('site.dashboard') </a> </li>
        <li class="active">  </i> @lang('site.products')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                 <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') <small>{{$products->total()}}</small></h3>

                <form action="{{route('dashboard.products.index')}}" method="GET">

                    <div class="row">

                        <div class="col-md-4">
                              <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                        </div>
                        <div class="col-md-4">
                            <select name="category_id"  class="form-control">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{request()->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                       </div>

                        <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"> <li class="fa fa-search"></li> @lang('site.search') </button>
                                @if (auth()->user()->hasPermission('create_products'))
                                      <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"> <li class="fa fa-plus"></li> @lang('site.add') </a>
                                @else
                                <a href="#" class="btn btn-primary disabled"> <li class="fa fa-plus"></li> @lang('site.add') </a> 
                                @endif
                                
                        </div>

                    </div>

                </form>
            </div>
            <div class="box-body">
              @if ($products->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.profit_percent') %</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->description  !!}</td>
                                    <td>{{ $product->category->name  }}</td>
                                    <td><img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail" alt=""></td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->profit_percent }} %</td>
                                    <td>{{ $product->stock }}</td>
                                    
                                    
                                   
                                    <td>
                                    @if (auth()->user()->hasPermission('update_products'))
                                         <a href=" {{route('dashboard.products.edit' , $product->id)}} "  class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit') </a>
                                    @else
                                         <a href="#" class="btn btn-info btn-sm disabled"> <i class="fa fa-edit"></i> @lang('site.edit') </a>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_products'))
                                            <form action="{{route('dashboard.products.destroy', $product->id)}}" method="POST" style="display: inline-block">
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
                    {{-- links() to run paginate from productscontroller , appends(request()->query) da 3lshan yafdal append key of search mat3'yrash m3a links --}}
                    {{$products->appends(request()->query())->links()}}
                  
              @else
                  <h2>@lang('site.no_data_found')</h2>
              @endif
            </div><!-- end of box body --> 
        </div>
    </section>
        
</div>


@endsection