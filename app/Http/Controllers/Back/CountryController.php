<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Http\Requests\Back\CountryRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->ability('admin' ,
            //'manage_countries' ,
            'show_countries')){
            return redirect('admin/index');
        }
        $countries = Country::with('states')
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != '' , function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.countries.index' , compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_countries')){
            return redirect('admin/index');
        }
        return view('back.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_countries')){
            return redirect('admin/index');
        }

        Country::create($request->validated());
        return redirect()->route('admin.countries.index')->with([
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
    public function show(Country $country)
    {
        if(!auth()->user()->ability('admin' , 'display_countries')){
            return redirect('admin/index');
        }
        return view('back.countries.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        if(!auth()->user()->ability('admin' , 'update_countries')){
            return redirect('admin/index');
        }
        return view('back.countries.edit' , compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        if(!auth()->user()->ability('admin' , 'update_countries')){
            return redirect('admin/index');
        }

        $country->update($request->validated());

        return redirect()->route('admin.countries.index')->with([
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
    public function destroy(Country $country)
    {
        if(!auth()->user()->ability('admin' , 'delete_countries')){
            return redirect('admin/index');
        }

        $country->delete();

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

}
