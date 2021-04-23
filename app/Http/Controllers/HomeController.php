<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Items;
use App\Models\Customers;
use App\Models\Carts;
use App\Models\Invoices;
use App\Models\Deliveries;

class HomeController extends Controller
{
    public function index(Request $request){
        $data = [];
        $data['title'] = 'Dashboard';
        if ($request['msg'] != '') {
            $data['msg'] = $request['msg'];
        } else {
            $data['msg'] = '';
        }

        //Store Front Section
        $customers  = json_decode(Customers::take(10)->get());
        $data['customers']  = $customers;

        //$items              = json_decode(Items::take(1)->get());
        $items = Items::select('id', 'itemname', 'description', 'price', 'stock')
                ->take(1)
                ->get();
        $data['items']      = $items;

        //Dashboard

        $incarts = Carts::selectRaw('SUM(qty) AS jumlah')
                    ->where('ispay', '=', '0')
                    ->where('carts.deleted_at', '=', NULL)
                    ->where('itemID', '=', $items[0]->id)
                    ->get();
        $incart = ($incarts[0]->jumlah != null)?$incarts[0]->jumlah:0;

        $invs = Invoices::selectRaw('SUM(qty) AS jumlah')
                    ->where('invoices.deleted_at', '=', NULL)
                    ->where('itemID', '=', $items[0]->id)
                    ->where('isdelivery', '=', 0)
                    ->get();
        $inv = ($invs[0]->jumlah != null)?$invs[0]->jumlah:0;

        $dels = Deliveries::selectRaw('SUM(qty) AS jumlah')
                    ->where('deliveries.deleted_at', '=', NULL)
                    ->where('deliveries.delivery_at', '<>', NULL)
                    ->where('itemID', '=', $items[0]->id)
                    ->get();
        $del = ($dels[0]->jumlah != null)?$dels[0]->jumlah:0;

        $stock = [
            'item' => $items[0]->itemname,
            'instock' => $items[0]->stock,
            'cart' => $incart,
            'invoice' => $inv,
            'delivery' => $del,
        ];
        $data['stock'] = $stock;

        //Cart Section
        $customers = Carts::select('customerID', 'name', 'email', DB::raw('SUM(totalprice) AS total'))
                    ->leftJoin('customers', 'carts.customerId', '=', 'customers.id')
                    ->where('ispay', '=', '0')
                    ->where('carts.deleted_at', '=', NULL)
                    ->groupBy('customerID', 'name', 'email')
                    ->get();
        
        $carts = [];
        foreach ($customers as $customer) {
            $cartitems = Carts::select('carts.id', 'itemID', 'itemname', 'customerID', 'qty', 'carts.price', 'totalprice', 'ispay')
            ->leftJoin('items', 'carts.itemID', '=', 'items.id')
            ->where('ispay', '=', '0')
            ->where('carts.deleted_at', '=', NULL)
            ->where('customerID', '=', $customer['customerID'])->get();

            $cartitem = [];
            foreach ($cartitems as $items) {
                $cartitem[] = [
                    'itemID' => $items->itemID,
                    'itemname' => $items->itemname,
                    'qty' => $items->qty,
                    'price' => $items->price,
                    'totalprice' => $items->totalprice,
                ];
            }

            $carts[] = [
                'customerID' => $customer['customerID'], 
                'name' => $customer['name'],
                'email' => $customer['email'],
                'total' => $customer['total'],
                'cartitems'  => $cartitem
            ];
        }

        $data['carts']      = $carts;

        //Invoice Section
        $customers = Invoices::select('invoiceID', 'customerID', 'name', 'email', DB::raw('SUM(totalprice) AS total'))
                    ->leftJoin('customers', 'invoices.customerId', '=', 'customers.id')
                    ->where('invoices.deleted_at', '=', NULL)
                    ->where('invoices.isdelivery', '=', 0)
                    ->groupBy('invoiceID', 'customerID', 'name', 'email')
                    ->get();
                    
        $invoices = [];
        foreach ($customers as $customer) {
            $cartitems = Invoices::select('invoices.id', 'invoices.itemID', 'itemname', 'invoices.customerID', 'invoices.qty', 'invoices.price', 'invoices.totalprice')
            ->leftJoin('items', 'invoices.itemID', '=', 'items.id')
            ->where('invoices.deleted_at', '=', NULL)
            ->where('invoiceID', '=', $customer['invoiceID'])->get();

            $cartitem = [];
            foreach ($cartitems as $items) {
                $cartitem[] = [
                    'itemID' => $items->itemID,
                    'itemname' => $items->itemname,
                    'qty' => $items->qty,
                    'price' => $items->price,
                    'totalprice' => $items->totalprice,
                ];
            }

            $invoices[] = [
                'invoiceID' => $customer['invoiceID'], 
                'customerID' => $customer['customerID'], 
                'name' => $customer['name'],
                'email' => $customer['email'],
                'total' => $customer['total'],
                'cartitems'  => $cartitem
            ];
        }

        $data['invoices']      = $invoices;

        //Delivery Section
        $customers = Deliveries::select('invoiceID', 'customerID', 'name', 'email', DB::raw('SUM(totalprice) AS total'), 'delivery_at')
                ->leftJoin('customers', 'deliveries.customerID', '=', 'customers.id')
                ->where('deliveries.deleted_at', '=', NULL)
                ->groupBy('invoiceID', 'customerID', 'name', 'email', 'delivery_at')
                ->get();

        $deliveries = [];
        foreach ($customers as $customer) {
            $cartitems = Deliveries::select('deliveries.id', 'deliveries.itemID', 'itemname', 'deliveries.customerID', 'deliveries.qty', 'deliveries.price', 'deliveries.totalprice')
            ->leftJoin('items', 'deliveries.itemID', '=', 'items.id')
            ->where('deliveries.deleted_at', '=', NULL)
            ->where('invoiceID', '=', $customer['invoiceID'])->get();

            $cartitem = [];
            foreach ($cartitems as $items) {
                $cartitem[] = [
                    'itemID' => $items->itemID,
                    'itemname' => $items->itemname,
                    'qty' => $items->qty,
                    'price' => $items->price,
                    'totalprice' => $items->totalprice,
                ];
            }

            $deliveries[] = [
                'invoiceID' => $customer['invoiceID'], 
                'customerID' => $customer['customerID'], 
                'name' => $customer['name'],
                'email' => $customer['email'],
                'total' => $customer['total'],
                'delivery_at' => $customer['delivery_at'],
                'cartitems'  => $cartitem
            ];
        }
        $data['deliveries']      = $deliveries;

        //dd($data);
        return view('welcome', $data);
    }
}
