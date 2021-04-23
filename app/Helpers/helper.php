<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Histories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Helper
{
    public static function itemlog($itemID, $customerID, $qty, $price, $totalprice, $description) {
        try {
            $newitem = [
                'history_date' => Carbon::now(),
                'itemID' => $itemID,
                'customerID' => $customerID,
                'qty' => $qty,
                'price' => $price,
                'totalprice' => $totalprice,
                'description' => $description,
            ];
            Histories::create($newitem);
        } catch (Exception $exception) {
			dd($exception);
		}
    }
}