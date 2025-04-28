<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Orders";
        $datas = Orders::orderBy('id', 'desc')->get();
        // $privilageAll = Session::get('privilage');
        // $path = request()->path();
        // $currentpath = "/{$path}";
        // $privilage = $privilageAll[$currentpath];
        return view('analytic.index', compact('title', 'datas'));
    }


    public function getwidget()
    {
        $category_data = DB::select('SELECT count(*) as value , c.category_name as category FROM order_details od inner join products p on od.product_id = p.id inner join categories c on p.category_id = c.id group by c.category_name');
        $total_product = DB::select('SELECT count(*) as value from products');
        $total_users = DB::select('SELECT count(*) as value from users');
        $total_orders = DB::select('SELECT count(*) as value from order_details');
        $order_timeline = DB::select("SELECT sum(qty) as value, DATE(created_at) as 'key' FROM order_details GROUP BY DATE(created_at)");
        // $
        return response()->json([
            "category_data" => $category_data,
            "total_product" => $total_product,
            "total_users" => $total_users,
            "total_orders" => $total_orders,
            "order_timeline" => $order_timeline
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

   public function edit($id)
    {
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
    }

}
