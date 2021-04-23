<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Invoices;
use App\Models\Items;
use App\Models\Deliveries;
use App\Models\Histories;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\DB;
use App\Helpers\Helper;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Carts::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemID     = $request->itemID;
        $customerID = $request->customerID;

        $item = Items::where('id', '=', $itemID)->get()[0];
        $itemstock = $item->stock;
        
        $cart = Carts::where('itemID', '=', $itemID)
                    ->where('customerID', '=', $customerID)
                    ->where('ispay', '=', 0)
                    ->where('deleted_at', '=', null)
                    ->get();
        //dd($cart[0]->id);
        if (count($cart) != 0) {
            $id     = $cart[0]->id;
            $qty    = $cart[0]->qty + $request->qty;

            if ($qty <= $itemstock) {
                $totalprice = $qty * $request->price;
                $update = [
                    'qty'=> $qty,
                    'totalprice'=> $totalprice
                ];
                Carts::where('id', $id)->update($update);
                $msg = "Success!, add item quantity to cart";
                $description = "Change Quantity to Cart";
                Helper::itemlog($request->itemID, $request->customerID, $request->qty, $request->price, $request->qty * $request->price, $description);
            } else {
                $msg = "Sorry, Stock not available";
            }
        } else {
            if ($request->qty <= $itemstock) {
                $cart = new Carts;
                $cart->itemID     = $request->itemID;
                $cart->customerID = $request->customerID;
                $cart->qty        = $request->qty;
                $cart->price      = $request->price;
                $cart->totalprice = $request->qty * $request->price;
                $cart->ispay      = 0;
                $cart->save();
                $msg = "Success!, add item to cart";
                $description = "Add To Cart";
                Helper::itemlog($request->itemID, $request->customerID, $request->qty, $request->price, $request->qty * $request->price, $description);
            } else {
                $msg = "Sorry, Stock not available";
            }
        }

        return redirect()->route('index', ['msg' => $msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carts $carts)
    {
        //
    }

    public function pay(Request $request)
    {
        $customerID = $request->customerID;

        //Check Available Quantity or not
        $cart = Carts::where('customerID', '=', $customerID)
                    ->where('ispay', '=', 0)
                    ->where('deleted_at', '=', null)
                    ->get();
        $invoiceID = md5(uniqid(rand(), true));
        
        $msg = "";
        foreach ($cart as $item) {
            $itemlist = Items::where('id', '=', $item->itemID)->get();
            if (count($itemlist) != 0) {
                //dd($item[0]->stock);
                $itemstock = $itemlist[0]->stock;
            } else {
                $itemstock = 0;
            }
            
            $iteminv = Invoices::where('itemID', '=', $item->itemID)
            ->where('isdelivery', '=', '0')
            ->get();

            if (count($iteminv) != 0) {
                $iteminvoices = $iteminv[0]->qty;
            } else {
                $iteminvoices = 0;
            }

            //dd($iteminv);
            if ($item->qty <= ($itemstock - $iteminvoices)) {
                $invoice = new Invoices;
                $invoice->invoiceID = $invoiceID;
                $invoice->itemID    = $item->itemID;
                $invoice->customerID= $item->customerID;
                $invoice->qty       = $item->qty;
                $invoice->price     = $item->price;
                $invoice->totalprice= $item->totalprice;
                $invoice->isdelivery= 0;
                $invoice->save();

                Carts::where('customerID', '=', $customerID)
                            ->where('itemID', '=', $item->itemID)
                            ->update(['ispay'=>1]);
                $msg .= "Payment Success";
                $description = "Create Invoice ".$invoiceID;
                Helper::itemlog($item->itemID, $item->customerID, $item->qty, $item->price, $item->totalprice, $description);
            } else {
                $msg .= "Payment Fail, Stock not available";
            }
        }

        return redirect()->route('index', ['msg' => $msg]);
    }

    public function cancel(Request $request)
    {
        $customerID = $request->customerID;
        $cart = Carts::where('customerID', $customerID)
        ->where('ispay', 0)
        ->update(['deleted_at'=>date('Y-m-d')]);
        
        $msg = "Cart dibatalkan";

        $description = "Cart Canceled";
        Helper::itemlog(0, $request->customerID, 0, 0, 0, $description);
        return redirect()->route('index', ['msg' => $msg]);
    }

    public function delivery(Request $request)
    {
        $invoiceID = $request->invoiceID;
        $invoice = Invoices::where('invoiceID', '=', $invoiceID)
            ->where('isdelivery', '=', '0')
            ->get();

        if (count($invoice) != 0) {
            foreach ($invoice as $row) {
                $delivery = new Deliveries;
                $delivery->invoiceID = $row->invoiceID;
                $delivery->itemID = $row->itemID;
                $delivery->customerID = $row->customerID;
                $delivery->qty = $row->qty;
                $delivery->price = $row->price;
                $delivery->totalprice = $row->totalprice;
                $delivery->delivery_at = Carbon::now();
                $delivery->save();

                $update = [
                    'isdelivery'=> 1,
                ];
                Invoices::where('id', $row->id)->update($update);

                $items = Items::where('id', $row->itemID)->get()[0];
                
                $update = [
                    'stock'=> $items->stock - $row->qty,
                ];
                Items::where('id', $row->itemID)->update($update);
            }
            $msg = "Order have been sent";
            $description = "Order have been sent";
            Helper::itemlog($row->itemID, $row->customerID, $row->qty, $row->price, $row->totalprice, $description);
        } else {
            $msg = "No Order right now";
        }
        return redirect()->route('index', ['msg' => $msg]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carts $carts)
    {
        //
    }
}
