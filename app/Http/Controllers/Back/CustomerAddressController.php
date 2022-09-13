<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use App\Models\Country;
use App\Models\User;
use App\Http\Requests\Back\CustomerAddressRequest;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->ability('admin' ,
            //'manage_customer_addresses' ,
            'show_customer_addresses')){
            return redirect('admin/index');
        }
        $customer_addresses = UserAddress::with('user')
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null , function($query){
                $query->whereDefaultAddress(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.customer_addresses.index' , compact('customer_addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_customer_addresses')){
            return redirect('admin/index');
        }

        $countries = Country::whereStatus(true)->get(['id' , 'name']);
        return view('back.customer_addresses.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerAddressRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_customer_addresses')){
            return redirect('admin/index');
        }

        UserAddress::create($request->validated());
        return redirect()->route('admin.customer_address.index')->with([
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
    public function show(UserAddress $customer_address)
    {
        if(!auth()->user()->ability('admin' , 'display_customer_addresses')){
            return redirect('admin/index');
        }
        return view('back.customer_addresses.show' , compact('customer_address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(UserAddress $customer_address)
    {
        if(!auth()->user()->ability('admin' , 'update_customer_addresses')){
            return redirect('admin/index');
        }

        $countries = Country::whereStatus(true)->get(['id' , 'name']);
        return view('back.customer_addresses.edit' , compact('customer_address' , 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(CustomerAddressRequest $request, UserAddress $customer_address)
    {
        if(!auth()->user()->ability('admin' , 'update_customer_addresses')){
            return redirect('admin/index');
        }

        $customer_address->update($request->validated());

        return redirect()->route('admin.customer_address.index')->with([
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
    public function destroy(UserAddress $customer_address)
    {
        if(!auth()->user()->ability('admin' , 'delete_customer_addresses')){
            return redirect('admin/index');
        }

        $customer_address->delete();

        return redirect()->route('admin.customer_address.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

}
