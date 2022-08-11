<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        if(!auth()->user()->ability('admin' ,
            //'manage_customers' ,
            'show_customers')){
            return redirect('admin/index');
        }
        $customers = User::whereHas('roles' , function($q){
            $q->whereName('customer');
        })
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != '' , function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.customers.index' , compact('customers'));
    }

    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_customers')){
            return redirect('admin/index');
        }

        $main_categories = ProductCategory::whereNull('parent_id')->get(['id' , 'name']);
        return view('back.customers.create' , compact('main_categories'));
    }

    public function store(ProductCategoryRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_customers')){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        if($image = $request->file('cover')){
            $file_name = Str::slug($request->name)."-".time().".".$image->getClientOriginalExtension();
            $path = public_path('assets\customers/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }

        ProductCategory::create($input);
        return redirect()->route('admin.customers.index')->with([
            'message' => 'Created successfully',
            'alert-type'=> 'success'
        ]);
    }

    public function show($id)
    {
        if(!auth()->user()->ability('admin' , 'display_customers')){
            return redirect('admin/index');
        }
        return view('back.customers.show');
    }

    public function edit(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin' , 'update_customers')){
            return redirect('admin/index');
        }
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id' , 'name']);
        return view('back.customers.edit' , compact('main_categories' , 'productCategory'));
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin' , 'update_customers')){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['slug'] = null ;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        if($image = $request->file('cover')){
            if ($productCategory->cover != null and File::exists('assets/customers/'. $productCategory->cover)){
                unlink('assets/customers/' . $productCategory->cover);
            }
            $file_name = Str::slug($request->name)."-".time().".".$image->getClientOriginalExtension();
            $path = public_path('assets\customers/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null , function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }
        $productCategory->update($input);

        return redirect()->route('admin.customers.index')->with([
            'message' => 'Update successfully',
            'alert-type'=> 'success'
        ]);

    }

    public function destroy(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin' , 'delete_customers')){
            return redirect('admin/index');
        }
        if (File::exists('assets/customers/'. $productCategory->cover)){
            unlink('assets/customers/' . $productCategory->cover);
        }
        $productCategory->delete();

        return redirect()->route('admin.customers.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

    public function remove_image(Request $request){
        if(!auth()->user()->ability('admin' , 'delete_customers')){
            return redirect('admin/index');
        }
        $category = ProductCategory::findOrFail($request->product_category_id);
        if (File::exists('assets/customers/'. $category->cover)){
            unlink('assets/customers/' . $category->cover);
            $category->cover = null;
            $category->save();
        }
        return true;
    }
}
