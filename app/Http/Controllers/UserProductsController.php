<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProduct;
use App\Http\Requests\EditUserProduct;
use App\Product;
use App\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserProductsController extends Controller
{
    public function index() {

        $user = Auth::user();
        $userProducts = DB::table('user_products')
                            ->join('users', 'user_products.user_id', '=', 'users.id')
                            ->join('products', 'user_products.product_id', '=', 'products.product_id')
                            ->select('user_products.date')
                            ->selectRaw('SUM(products.sugar * user_products.amount) AS total_sugar')
                            ->groupBy('date')
                            ->where('user_id', '=', $user->id)
                            ->get();
        $param = ['userProducts' => $userProducts, 'user' => $user];
        return view('sugar/index', $param);
    }

    public function showCreateForm() {

        $user = Auth::user();
        $products = Product::all();
        $param = ['products' => $products, 'user' => $user];
        return view('sugar/create', $param);
    }
    
    public function create(CreateUserProduct $request) {
        
        $user = Auth::user();
        $userProduct = new UserProduct();
        $userProduct->user_id = $user->id;
        $userProduct->product_id = $request->product_id;
        $userProduct->amount = $request->amount;
        $userProduct->date = $request->date;
        $userProduct->save();
        return redirect()->route('sugar.index',[
            'id' => $user->id,
            ]);
        }
        
        // public function calc(Request $request) {
            
            //     $product = Product::find($request->selectedProductId);
            //     $sugar = $product->sugar;
            //     $result = $sugar * $request->amount;
            //     return response()->json([
                //         'result' => $result
                //     ]);
                // }
                

    public function show($user_id, $date) {

        $user_id = $user_id;
        $date = $date;
        $total = DB::table('user_products')
                        ->join('users', 'user_products.user_id', '=', 'users.id')
                        ->join('products', 'user_products.product_id', '=', 'products.product_id')
                        ->selectRaw('SUM(products.sugar * user_products.amount) AS total_sugar')
                        ->where('user_id', '=', $user_id)
                        ->whereDate('date', $date)
                        ->get();

        $userProducts = DB::table('user_products')
                            ->join('users', 'user_products.user_id', '=', 'users.id')
                            ->join('products', 'user_products.product_id', '=', 'products.product_id')
                            ->select('user_products.id','user_products.date', 'user_products.amount', 'products.sugar','products.name')
                            ->where('user_id', '=', $user_id)
                            ->whereDate('date', $date)
                            ->get();
        $param = ['userProducts' => $userProducts, 'user_id' => $user_id, 'date' => $date, 'total' => $total];
        return view('sugar/show', $param);

    }

    public function showEditForm($id) {

        $products = Product::all();
        $userProduct = UserProduct::find($id);
        $param = ['userProduct' => $userProduct, 'products' => $products];
        return view('sugar/edit', $param);
    }

    public function edit($id, EditUserProduct $request) {

        $userProduct = UserProduct::find($id);

        $userProduct->product_id = $request->product_id;
        $userProduct->amount = $request->amount;
        $userProduct->date = $request->date;
        $userProduct->save();

        return redirect()->route('sugar.index',[
            'id' => $userProduct->user_id,
            ]);
    }

    public function delete($id) {
        $userProduct = UserProduct::find($id);
        $userProduct->delete();
        return redirect('/');
    }
}
