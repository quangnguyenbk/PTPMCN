<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Purchase_order_item;
use Illuminate\Support\Facades\DB;
class PurchaseOrderItemController extends Controller
{
     public function getItems($id){

         $purchase_order_items = DB::table('purchase_order_items')->where('purchase_order_id', '=',$id)->get();
         return view('admin.purchaseorderitem.detail', ['purchase_order_items'=>$purchase_order_items]);
     }
}