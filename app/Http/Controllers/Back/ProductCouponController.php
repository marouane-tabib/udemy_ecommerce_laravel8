<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ProductCouponRequest;
use App\Models\ProductCoupon;
use Illuminate\Http\Request;

class ProductCouponController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->ability('admin' ,
            //'manage_product_coupons' ,
            'show_product_coupons')){
            return redirect('admin/index');
        }
        $coupons = ProductCoupon::query()
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != '' , function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.product_coupons.index' , compact('coupons'));
    }

    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_product_coupons')){
            return redirect('admin/index');
        }
        return view('back.product_coupons.create');
    }

    public function store(ProductCouponRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_product_coupons')){
            return redirect('admin/index');
        }

        ProductCoupon::create($request->validated());

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => 'Created successfully',
            'alert-type'=> 'success'
        ]);
    }

    public function show($id)
    {
        if(!auth()->user()->ability('admin' , 'display_product_coupons')){
            return redirect('admin/index');
        }
        return view('back.product_coupons.show');
    }

    public function edit(ProductCoupon $productCoupon)
    {
        if(!auth()->user()->ability('admin' , 'update_product_coupons')){
            return redirect('admin/index');
        }

        return view('back.product_coupons.edit' , compact('productCoupon'));
    }

    public function update(ProductCouponRequest $request, ProductCoupon $productCoupon)
    {
        if(!auth()->user()->ability('admin' , 'update_product_coupons')){
            return redirect('admin/index');
        }

        $productCoupon->update($request->validated());

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => 'Update successfully',
            'alert-type'=> 'success'
        ]);

    }

    public function destroy(ProductCoupon $productCoupon)
    {
        if(!auth()->user()->ability('admin' , 'delete_product_coupons')){
            return redirect('admin/index');
        }
        $productCoupon->delete();

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

}
