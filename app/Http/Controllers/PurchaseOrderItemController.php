<?php

namespace App\Http\Controllers;
use App\Laptop;
use App\Purchase_order;
use App\Supplier;
use Illuminate\Http\Request;
use App\Purchase_order_item;
use Illuminate\Support\Facades\DB;
class PurchaseOrderItemController extends Controller
{
     public function getItems($id){

         $purchase_order_items = DB::table('purchase_order_items')->where('purchase_order_id', '=',$id)->get();
         $purchase_detail = Purchase_order::where('id', $id)->first();
         $suppliers = Supplier::all();
         $laptops = Laptop::all();
         return view('admin.purchaseorderitem.detail', ['purchase_order_items'=>$purchase_order_items,'purchase_detail'=>$purchase_detail,'suppliers'=>$suppliers]
         ,['laptops'=>$laptops]);
     }
}