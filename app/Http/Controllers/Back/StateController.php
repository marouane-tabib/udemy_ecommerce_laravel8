<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use App\Http\Requests\Back\StateRequest;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->ability('admin' ,
            //'manage_states' ,
            'show_states')){
            return redirect('admin/index');
        }
        $states = State::with('cities')
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != '' , function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.states.index' , compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_states')){
            return redirect('admin/index');
        }
        $countries = Country::get(['id' , 'name']);
        return view('back.states.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StateRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_states')){
            return redirect('admin/index');
        }

        State::create($request->validated());
        return redirect()->route('admin.states.index')->with([
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
    public function show(State $state)
    {
        if(!auth()->user()->ability('admin' , 'display_states')){
            return redirect('admin/index');
        }
        
        return view('back.states.show' , compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        if(!auth()->user()->ability('admin' , 'update_states')){
            return redirect('admin/index');
        }
        $countries = Country::get(['id' , 'name']);
        return view('back.states.edit' , compact('state' , 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        if(!auth()->user()->ability('admin' , 'update_states')){
            return redirect('admin/index');
        }

        $state->update($request->validated());

        return redirect()->route('admin.states.index')->with([
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
    public function destroy(State $state)
    {
        if(!auth()->user()->ability('admin' , 'delete_states')){
            return redirect('admin/index');
        }

        $state->delete();

        return redirect()->route('admin.states.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

}
