<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_product_coupons')){
            return redirect('admin/index');
        }

        $main_coupons = ProductCategory::whereNull('parent_id')->get(['id' , 'name']);
        return view('back.product_coupons.create' , compact('main_coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCategoryRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_product_coupons')){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        if($image = $request->file('cover')){
            $file_name = Str::slug($request->name)."-".time().".".$image->getClientOriginalExtension();
            $path = public_path('assets\product_coupons/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }

        ProductCategory::create($input);
        return redirect()->route('admin.product_coupons.index')->with([
            'message' => 'Created successfully',
            'alert-type'=> 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!auth()->user()->ability('admin' , 'display_product_coupons')){
            return redirect('admin/index');
        }
        return view('back.product_coupons.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin' , 'update_product_coupons')){
            return redirect('admin/index');
        }
        $main_coupons = ProductCategory::whereNull('parent_id')->get(['id' , 'name']);
        return view('back.product_coupons.edit' , compact('main_coupons' , 'productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin' , 'update_product_coupons')){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['slug'] = null ;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        if($image = $request->file('cover')){
            if ($productCategory->cover != null and File::exists('assets/product_coupons/'. $productCategory->cover)){
                unlink('assets/product_coupons/' . $productCategory->cover);
            }
            $file_name = Str::slug($request->name)."-".time().".".$image->getClientOriginalExtension();
            $path = public_path('assets\product_coupons/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }
        $productCategory->update($input);

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => 'Update successfully',
            'alert-type'=> 'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin' , 'delete_product_coupons')){
            return redirect('admin/index');
        }
        if (File::exists('assets/product_coupons/'. $productCategory->cover)){
            unlink('assets/product_coupons/' . $productCategory->cover);
        }
        $productCategory->delete();

        return redirect()->route('admin.product_coupons.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

}
