<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use stdClass;
use function Psy\sh;
use function Symfony\Component\String\s;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request){
        $productId = $request->get('productId');
        $productQuantity = $request->get('productQuantity');
        $action = $request->get('cartAction');
        $product = Product::find($productId);
        if ($product == null){
            return 'product';
        }
        $shoppingCart =null;
        if (Session::has('shoppingCart')){
            $shoppingCart = Session::get('shoppingCart');
        }else{
            $shoppingCart = [];
        }
        $cartItem = null;
    $message = 'Thêm sản phẩm vào giỏ hàng thành công';
        if (!array_key_exists($productId,$shoppingCart)){
            $cartItem = new  stdClass();
            $cartItem->id = $product->id;
            $cartItem->name = $product->name;
            $cartItem->thumbnail = $product->thumbnail;
            $cartItem->unitPrice = $product->price;
            $cartItem->quantity = intval($productQuantity);

        }else{
            $cartItem = $shoppingCart[$productId];
            if ($action != null && $action == 'update') {
                $cartItem->quantity = $productQuantity;
                $message = 'Update sản phẩm thành công';

            }else{
                $cartItem->quantity += $productQuantity;
            }
        }
        $shoppingCart[$productId] = $cartItem;
        Session::put('shoppingCart',$shoppingCart);
        return redirect('/show')->with('message', $message);

    }
    public function show()
    {
        $shoppingCart = Session::get('shoppingCart');

      return view('cart',['shoppingCart'=>$shoppingCart]);
    }
    public function remove(Request $request){
        $productId = $request->get('productId');
        $shoppingCart= null;
        if (Session::has('shoppingCart')){
            $shoppingCart = Session::get('shoppingCart');
            unset($shoppingCart[$productId]);
            Session::put('shoppingCart',$shoppingCart);
            return redirect('/show')->with('remove', 'Xóa sản phẩm khỏi giỏ hàng thành công!');

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


//namespace App\Http\Controllers;
//
//use App\Models\Product;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
//use stdClass;
//
//class ShoppingCartController extends Controller
//{
//    public function add(Request $request)
//    {
//        $productId = $request->get('productId');
//        $productQuantity = $request->get('productQuantity');
//        $action = $request->get('cartAction');
//        $product = Product::find($productId);
//        if ($product == null) {
//            return view('404');
//        }
//        if (Session::has('shoppingCart')) {
//            $shoppingCart = Session::get('shoppingCart');
//        } else {
//            $shoppingCart = [];
//        }
//        $cartItem = null;
//        $message = 'Thêm sản phẩm vào giỏ hàng thành công';
//        if (!array_key_exists($productId, $shoppingCart)) {
//            $cartItem = new stdClass();
//            $cartItem->id = $product->id;
//            $cartItem->name = $product->name;
//            $cartItem->thumbnail = $product->thumbnail;
//            $cartItem->unitPrice = $product->price;
//            $cartItem->quantity = intval($productQuantity);
//        } else {
//            $cartItem = $shoppingCart[$productId];
//            if ($action != null && $action == 'update') {
//                $cartItem->quantity = $productQuantity;
//                $message = 'Update sản phẩm thành công';
//            } else {
//                $cartItem->quantity += $productQuantity;
//            }
//        }
//        $shoppingCart[$productId] = $cartItem;
//        Session::put('shoppingCart', $shoppingCart);
//        return redirect('/show')->with('message', $message);
//    }
//
//    public function show()
//    {
//        $shoppingCart = Session::get('shoppingCart');
//        return view('cart', [
//            'shoppingCart' => $shoppingCart
//        ]);
//    }
//
//    public function remove(Request $request)
//    {
//        $productId = $request->get('productId');
//        $shoppingCart = null;
//        if (Session::has('shoppingCart')) {
//            $shoppingCart = Session::get('shoppingCart');
//            unset($shoppingCart[$productId]);
//            Session::put('shoppingCart', $shoppingCart);
//            return redirect('/show')->with('remove', 'Xóa sản phẩm khỏi giỏ hàng thành công!');
//        }
//    }
//}
