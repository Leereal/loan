<?php

namespace App\Http\Controllers;

use App\Models\NextOfKin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $next_of_kins = NextOfKin::all()
            ->orderBy("id", "desc")
            ->get();
        return view('backend.user.next_of_kin.list', compact('next_of_kins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->get('user');
        return view('backend.user.next_of_kin.create',compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required',
            'name'              => 'required',
            'relationship'      => 'nullable',
            'cellphone'         => 'nullable',
            'address'           => 'required',            
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('next_of_kin.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $next_of_kin                    = new NextOfKin();
        $next_of_kin->user_id           = $request->input('user_id');
        $next_of_kin->name              = $request->input('name');
        $next_of_kin->relationship      = $request->input('relationship');
        $next_of_kin->cellphone         = $request->input('cellphone');
        $next_of_kin->address           = $request->input('address');
        $next_of_kin->created_by_id     = Auth::user()->id;
        $next_of_kin->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $next_of_kin->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $next_of_kin, 'table' => '#next_of_kin_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $nextOfKin)
    {
        $next_of_kin = NextOfKin::find($nextOfKin);
        if (!$request->ajax()) {
            return view('backend.user.next_of_kin.view', compact('next_of_kin'));
        } else {
            return view('backend.user.next_of_kin.modal.view', compact('next_of_kin'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,  $id)
    {       
        $next_of_kin = NextOfKin::find($id);       
        if (!$request->ajax()) {
            return view('backend.user.next_of_kin.edit', compact('next_of_kin', 'id'));
        } else {
            return view('backend.user.next_of_kin.modal.edit', compact('next_of_kin', 'id'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //'user_id'           => 'required',
            'name'              => 'required',
            'relationship'      => 'nullable',
            'cellphone'         => 'nullable',
            'address'           => 'required',            
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('next_of_kin.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $next_of_kin                    =  NextOfKin::find($id);
        $next_of_kin->name              = $request->input('name');
        $next_of_kin->relationship      = $request->input('relationship');
        $next_of_kin->cellphone         = $request->input('cellphone');
        $next_of_kin->address           = $request->input('address');
        $next_of_kin->updated_by_id     = auth()->user()->id;
        $next_of_kin->ip_address        = request()->ip();
        $next_of_kin->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $next_of_kin->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $next_of_kin, 'table' => '#next_of_kin_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $next_of_kin = NextOfKin::find($id);
        $next_of_kin->delete();
        return back()->with('success', _lang('Deleted successfully'));
    }
}
