<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
        // dashboardSale
        // admin
        public function saleDashboard_admin(){
            if (request('productOrderPlan')=='month') {
                $sale=Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            }else if (request('productOrderPlan')=='year') {
                $sale=Order::select(DB::raw('Year(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }else{
                $sale=Order::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }


            $products=OrderList::select('products.name as product_name',DB::raw('sum(order_lists.qty) as product_qty'))
            ->when(request('productTrendPlan'),function($search_item){
                $search_item->where('order_lists.created_at','like','%'.request('productTrendPlan').'%');
            })
            ->leftJoin('products','order_lists.product_id','products.id')
            ->groupBy('product_name')
            ->get();

            $productsOrderDate=OrderList::select(DB::raw('Date(created_at) as date'))->groupBy('date')->get();

            // dd($products->toArray());
            return view('admin.dashboard.sale',compact('sale','products','productsOrderDate'));
        }

        //user
        public function saleDashboard_user(){
            if (request('productOrderPlan')=='month') {
                $sale=Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            }else if (request('productOrderPlan')=='year') {
                $sale=Order::select(DB::raw('Year(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }else{
                $sale=Order::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }


            $products=OrderList::select('products.name as product_name',DB::raw('sum(order_lists.qty) as product_qty'))
            ->when(request('productTrendPlan'),function($search_item){
                $search_item->where('order_lists.created_at','like','%'.request('productTrendPlan').'%');
            })
            ->leftJoin('products','order_lists.product_id','products.id')
            ->groupBy('product_name')
            ->get();

            $productsOrderDate=OrderList::select(DB::raw('Date(created_at) as date'))->groupBy('date')->get();

            // dd($products->toArray());
            return view('user.dashboard.sale',compact('sale','products','productsOrderDate'));
        }
}
