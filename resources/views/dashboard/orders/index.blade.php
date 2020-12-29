@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.orders')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.welcome') }}">  <i class="fa fa-dashboard"> </i> @lang('site.dashboard') </a> </li>
            <li class="active"> </i> @lang('site.orders')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.orders') <small></small></h3>

                <form action="{{route('dashboard.orders.index')}}" method="GET">

                    <div class="row">

                      <div class="col-md-2">
                        <select name="is_deposited"  class="form-control">
                            <option value="">all</option>
                            <option value="0">NO Deposited</option>
                            <option value="1">Deposited</option>
                        </select>
                      </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                <li class="fa fa-search"></li> @lang('site.filter')
                            </button>

                        </div>


                </form>


            </div>
        </div>



        <div class="box-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.clientName')</th>
                    
                  
                        <th>@lang('site.products')</th>
                        <th>@lang('site.total')</th>
                     

                
                        <th>@lang('site.created_at')</th>
                        <th>@lang('site.edited_at')</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $index=>$order)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $order->client->name }}</td>
                        <td>

                            @foreach ($order->products as $index=>$orderproduct)
                            <p> {{$index+1}}
                                -   @lang('site.product'): {{ $orderproduct->translate('ar')->name }}
                                -  @lang('site.quantity') : ({{ $orderproduct->pivot->quantity }})
                            </p>
                            </br>
                            @endforeach

                            </td>
                        <td>{{ $order->total_price}}</td>
                    

                        <td>{{ $order->created_at->toDayDateTimeString()  }}</td>
                        <td>{{ $order->updated_at->toDayDateTimeString()  }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table><!-- end of table -->





        </div><!-- end of box body -->
</div>
</section>

</div>


@endsection
