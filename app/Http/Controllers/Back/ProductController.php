<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!auth()->user()->ability('admin' ,
            //'manage_product_categories' ,
            'show_products')){
            return redirect('admin/index');
        }
        $products = Product::with('category' , 'tags' , 'firstMedia')
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != '' , function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->ability('admin' ,
            'create_products')){
            return redirect('admin/index');
        }

        $categories = ProductCategory::whereStatus(1)->get(['id' , 'name']);
        $tags = Tag::whereStatus(1)->get(['id' , 'name']);
        return view('back.products.create' , compact('categories' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        if(!auth()->user()->ability('admin' ,
            'create_products')){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['featured'] = $request->featured;
        $input['status'] = $request->status;

        $product = Product::create($input);
        $product->tags()->attach($request->tags);

        if ($request->images and count($request->images) > 0){
            $i = 1;
            foreach ($request->images as $image){
                $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/products/' . $file_name);

                Image::make($image->getRealPath())->resize(500 , null , function($constraint){
                    $constraint->aspectRatio();
                })->save($path , 100);

                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        return redirect()->route('admin.products.index')->with([
            'message' => 'Created Successfully',
            'alert_type' => 'success'
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
        return view('back.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('back.products.edit');
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
