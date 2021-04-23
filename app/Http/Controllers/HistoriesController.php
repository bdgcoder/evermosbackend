<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use Illuminate\Http\Request;
use DataTables;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Histories::select('histories.id', 'history_date', 'itemname', 'name', 'email', 'histories.qty', 'histories.price', 'histories.totalprice', 'histories.description')
                            ->leftJoin('items', 'histories.itemID', '=', 'items.id')
                            ->leftJoin('customers', 'histories.customerID', '=', 'customers.id');
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('histories');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function show(histories $histories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function edit(histories $histories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, histories $histories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function destroy(histories $histories)
    {
        //
    }
}
