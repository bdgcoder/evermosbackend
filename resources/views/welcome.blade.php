@extends('layouts/main')
@section('title', 'Welcome')
@section('content')
<div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li class="active">
                <i class="ace-icon fa fa-dashboard home-icon"></i>
                <a href="{{ url('') }}">Dashboard</a>
            </li>

            <!--<li>
                <a href="#">Other Pages</a>
            </li>
            <li class="active">Blank Page</li>-->
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div id="main-widget-container">
                    <div class="row">
                        @if ($msg != "")
                        <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>

                            <p>
                                <strong>
                                    <i class="ace-icon fa fa-exclamation-triangle"></i>
                                </strong>
                                {{ $msg  }}
                            </p>
                        </div>
                        @endif
                        <div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
                            <div class="widget-box" id="widget-box-1">
                                <div class="widget-header">
                                    <h5 class="widget-title">Introduction</h5>

                                    <div class="widget-toolbar">
                                        <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                        </a>

                                        <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                        </a>

                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>

                                        <a href="#" data-action="close">
                                            <i class="ace-icon fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 widget-container-col">
                                                <h4>Proof of Concept (PoC) for Online Store</h4>
                                                <p>Simulation</p>
                                            </div>
                                            <div class="col-xs-12 col-sm-8 widget-container-col">
                                                <h4 class="blue">Item stock {{ $stock['item']}}</h4>
                                                <div class="infobox infobox-blue">
                                                    <div class="infobox-icon">
                                                        <i class="ace-icon fa fa-inbox"></i>
                                                    </div>
        
                                                    <div class="infobox-data">
                                                        <span class="infobox-data-number">{{ $stock['instock']}}</span>
                                                        <div class="infobox-content">In Stock</div>
                                                    </div>
                                                </div>

                                                <div class="infobox infobox-pink">
                                                    <div class="infobox-icon">
                                                        <i class="ace-icon fa fa-shopping-cart"></i>
                                                    </div>
        
                                                    <div class="infobox-data">
                                                        <span class="infobox-data-number">{{ $stock['cart']}}</span>
                                                        <div class="infobox-content">Cart</div>
                                                    </div>
                                                </div>

                                                <div class="infobox infobox-red">
                                                    <div class="infobox-icon">
                                                        <i class="ace-icon fa fa-list-alt"></i>
                                                    </div>
        
                                                    <div class="infobox-data">
                                                        <span class="infobox-data-number">{{ $stock['invoice']}}</span>
                                                        <div class="infobox-content">Invoice</div>
                                                    </div>
                                                </div>
                                                <div class="infobox infobox-green">
                                                    <div class="infobox-icon">
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </div>
        
                                                    <div class="infobox-data">
                                                        <span class="infobox-data-number">{{ $stock['delivery']}}</span>
                                                        <div class="infobox-content">Delivery</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-12"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-1">
                            <div class="widget-box" id="widget-box-1">
                                <div class="widget-header">
                                    <h5 class="widget-title"><i class="ace-icon fa fa-film"></i> Store Front</h5>

                                    <div class="widget-toolbar">
                                        <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                        </a>

                                        <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                        </a>

                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>

                                        <a href="#" data-action="close">
                                            <i class="ace-icon fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="customer"> Customer Select</label>
        
                                                <div class="col-sm-9">
                                                    <select id="customerID" placeholder="Customer Name" class="chosen-select input-large">
                                                        @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->email }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th><i class="ace-icon fa fa-tag"></i> ID</th>
                                                    <th>Item</th>
                                                    <th class="hidden-480"></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($items as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <span class="header blue"><strong>{{ $item->itemname }}</strong></span>
                                                        <p><img src="https://picsum.photos/id/{{ $item->id }}/100">
                                                        </p>
                                                        <small>Price: {{ number_format($item->price,0,',','.') }}</small><br>
                                                        <small class="red"> {{ $item->stock }} Stock</small>
                                                    </td>
                                                    <td class="hidden-480">
                                                        <form role="form" method="POST" action="api/cart">
                                                            @csrf
                                                            <input type="hidden" name="itemID" value="{{ $item->id }}">
                                                            <input type="hidden" id="customerID_{{ $item->id }}" name="customerID" value="">
                                                            <input type="hidden" name="price" value="{{ $item->price }}">    
                                                            <input type="text" name="qty" class="input-mini" value="1">
                                                            <button class="btn btn-primary btn-sm" type="submit" onClick="addcart({{ $item->id }});">
                                                                <i class="ace-icon fa fa-cart-plus"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-1">
                            <div class="widget-box" id="widget-box-1">
                                <div class="widget-header">
                                    <h5 class="widget-title"><i class="ace-icon fa fa-shopping-cart"></i> Cart</h5>

                                    <div class="widget-toolbar">
                                        <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                        </a>

                                        <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                        </a>

                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>

                                        <a href="#" data-action="close">
                                            <i class="ace-icon fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        @foreach ($carts as $cart)
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                                        <b>Customer Info</b>
                                                    </div>
                                                </div>

                                                <div>
                                                    <ul class="list-unstyled spaced">
                                                        <li><i class="ace-icon fa fa-caret-right green"></i>{{ $cart['name'] }}</li>
                                                        <li><i class="ace-icon fa fa-caret-right green"></i>{{ $cart['email'] }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($cart['cartitems'] as $item)
                                                <tr>
                                                    <td>{{ $item['itemID'] }}</td>
                                                    <td>{{ $item['itemname'] }}</td>
                                                    <td>{{ $item['qty'] }}</td>
                                                    <td>{{ number_format($item['price'],0,',','.') }}</td>
                                                    <td><div align="right">{{ number_format($item['totalprice'],0,',','.') }}</div></td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">&nbsp;</th>
                                                    <th>TOTAL</th>
                                                    <th><div align="right">{{ number_format($cart['total'],0,',','.') }}</div></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <form id="fmcart-{{ $cart['customerID'] }}" role="form" method="POST" action="api/pay">
                                            <div class="form-actions center">
                                                @csrf
                                                <input type="hidden" name="customerID" value="{{ $cart['customerID'] }}">
                                                <button class="btn btn-primary btn-sm" type="submit"><i class="ace-icon fa fa-money"></i> Pay</button>
                                                <button class="btn btn-warning btn-sm" type="submit" onClick="removecart({{ $cart['customerID'] }});"><i class="ace-icon fa fa-ban"></i> Cancel</button>
                                            </div>
                                        </form>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-1">
                            <div class="widget-box" id="widget-box-1">
                                <div class="widget-header">
                                    <h5 class="widget-title"><i class="ace-icon fa fa-list"></i> Invoice</h5>

                                    <div class="widget-toolbar">
                                        <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                        </a>

                                        <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                        </a>

                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>

                                        <a href="#" data-action="close">
                                            <i class="ace-icon fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        @foreach ($invoices as $invoice)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                                                        <b>Customer Info</b>
                                                    </div>
                                                </div>

                                                <div>
                                                    <ul class="list-unstyled spaced">
                                                        <li><i class="ace-icon fa fa-caret-right yellow"></i>Invoice ID
                                                            <small>{{ $invoice['invoiceID'] }}</small></li>
                                                        <li><i class="ace-icon fa fa-caret-right yellow"></i>{{ $invoice['name'] }}</li>
                                                        <li><i class="ace-icon fa fa-caret-right yellow"></i>{{ $invoice['email'] }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th><i class="ace-icon fa fa-tag"></i> ID</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($invoice['cartitems'] as $item)
                                                <tr>
                                                    <td>{{ $item['itemID'] }}</td>
                                                    <td>{{ $item['itemname'] }}</td>
                                                    <td>{{ $item['qty'] }}</td>
                                                    <td>{{ number_format($item['price'],0,',','.') }}</td>
                                                    <td><div align="right">{{ number_format($item['totalprice'],0,',','.') }}</div></td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th colspan="4"><div align="right">TOTAL</div></th>
                                                    <th><div align="right">{{ number_format($invoice['total'],0,',','.') }}</div></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <form role="form" method="POST" action="api/delivery">
                                            <div class="form-actions center">
                                                @csrf
                                                <input type="hidden" name="invoiceID" value="{{ $invoice['invoiceID'] }}">
                                                <button class="btn btn-primary btn-sm"><i class="ace-icon fa fa-truck"></i> Process</button>
                                            </div>
                                        </form>
                                        </div>
                                        @endforeach    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-1">
                            <div class="widget-box" id="widget-box-1">
                                <div class="widget-header">
                                    <h5 class="widget-title"><i class="ace-icon fa fa-truck"></i> Delivery</h5>

                                    <div class="widget-toolbar">
                                        <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                        </a>

                                        <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                        </a>

                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>

                                        <a href="#" data-action="close">
                                            <i class="ace-icon fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        @foreach ($deliveries as $delivery)
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                                                            <b>Customer Info</b>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <ul class="list-unstyled spaced">
                                                            <li><i class="ace-icon fa fa-caret-right yellow"></i>Invoice ID
                                                                <small>{{ $delivery['invoiceID'] }}</small></li>
                                                            <li><i class="ace-icon fa fa-caret-right yellow"></i>{{ $delivery['name'] }}</li>
                                                            <li><i class="ace-icon fa fa-caret-right yellow"></i>{{ $delivery['email'] }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead class="thin-border-bottom">
                                                    <tr>
                                                        <th><i class="ace-icon fa fa-tag"></i> ID</th>
                                                        <th>Item</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($delivery['cartitems'] as $item)
                                                    <tr>
                                                        <td>{{ $item['itemID'] }}</td>
                                                        <td>{{ $item['itemname'] }}</td>
                                                        <td>{{ $item['qty'] }}</td>
                                                        <td>{{ number_format($item['price'],0,',','.') }}</td>
                                                        <td><div align="right">{{ number_format($item['totalprice'],0,',','.') }}</div></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4"><div align="right">TOTAL</div></th>
                                                        <th><div align="right">{{ number_format($delivery['total'],0,',','.') }}</div></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <form role="form" method="POST">
                                                <div class="form-actions center">
                                                    Delivery at : {{ $delivery['delivery_at'] }}
                                                </div>
                                            </form>
                                            </div>
                                        @endforeach    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div>
@endsection

@section('script')
function addcart(itemID) {
    var sel = document.getElementById("customerID");
    var text= sel.options[sel.selectedIndex].value;

    document.getElementById("customerID_"+itemID).value = text;
    //console.log(document.getElementById("customerID_"+itemID).value);
}

function removecart(customerID) {
    document.getElementById("fmcart-"+customerID).action = 'api/cancel';
}
@endsection