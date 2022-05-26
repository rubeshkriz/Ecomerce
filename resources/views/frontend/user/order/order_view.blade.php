@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
        @include('frontend.common.user_sidebar')
            <div class="col-md-10">
                <div class="table-responsive">

                <table class="table">
                    <tbody>
                        <tr style="background: #e2e2e2;">
                            <td class="col-md-1" style="width:20%;">
                                <label for=""> Date</label>
                            </td>
                            <td class="col-md-3">
                                <label for=""> Total</label>
                            </td>
                            <td class="col-md-3">
                                <label for=""> Payment</label>
                            </td>
                            <td class="col-md-2">
                                <label for=""> Invoice</label>
                            </td>
                            <td class="col-md-2">
                                <label for=""> Order</label>
                            </td>
                            <td class="col-md-1" style="width:30%;">
                                <label for=""> Action</label>
                            </td>
                        </tr>

                        @foreach($orders as $order)
                        <tr>
                            <td class="col-md-1">
                                <label for=""> {{ $order->order_date }}</label>
                            </td>
                            <td class="col-md-3">
                                <label for="">$ {{ $order->amount }}</label>
                            </td>
                            <td class="col-md-3">
                                <label for=""> {{ $order->payment_method }}</label>
                            </td>
                            <td class="col-md-2">
                                <label for=""> {{ $order->invoice_no }}</label>
                            </td>
                            <td class="col-md-2">
                                <label for="">
                                    @if($order->status == 'Pending')
                                    <span class="badge badge-pill badge-warning" style="background: #800080;">Pending</span>
                                    @elseif($order->status == 'confirm')
                                    <span class="badge badge-pill badge-warning" style="background: #FFA500;">confirm</span>
                                    @elseif($order->status == 'processing')
                                    <span class="badge badge-pill badge-warning" style="background: #808000;">processing</span>
                                    @elseif($order->status == 'picked')
                                    <span class="badge badge-pill badge-warning" style="background: #1ba112;">picked</span>
                                    @elseif($order->status == 'shipped')
                                    <span class="badge badge-pill badge-warning" style="background: #b71b1b;">shipped</span>
                                    @elseif($order->status == 'delivered')
                                    <span class="badge badge-pill badge-warning" style="background: #2d8ebd;">delivered</span>

                                        @if($order->return_order == 1)
                                        <span class="badge badge-pill badge-warning" style="background: red">Return Requested</span>
                                        @endif

                                    @elseif($order->status == 'cancel')
                                    <span class="badge badge-pill badge-warning" style="background: #9d488e;">cancel</span>
                                    @elseif($order->status == 'confirm')
                                    <span class="badge badge-pill badge-warning" style="background: #f30000;">confirm</span>
                                    @endif
                                </label>
                            </td>
                            <td class="col-md-1">
                                <a href="{{ url('user/order_details/'.$order->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                                <a href="{{ url('user/invoice-download/'.$order->id) }}" class="btn btn-danger btn-sm" style="margin-top: 5px;"><i class="fa fa-download" style="color:#fff;"></i> Invoice</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection