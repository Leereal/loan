<?php

namespace App\Http\Controllers;

use App\Models\Guarantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guarantors = Guarantor::all()
            ->orderBy("id", "desc")
            ->get();
        return view('backend.user.guarantor.list', compact('guarantors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->get('user');
        return view('backend.user.guarantor.create',compact('user_id'));
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
            'employer'          => 'nullable',
            'cellphone'         => 'nullable',
            'address'           => 'required',            
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('guarantor.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $guarantor                    = new Guarantor();
        $guarantor->user_id           = $request->input('user_id');
        $guarantor->name              = $request->input('name');
        $guarantor->employer          = $request->input('employer');
        $guarantor->cellphone         = $request->input('cellphone');
        $guarantor->address           = $request->input('address');
        $guarantor->created_by_id     = Auth::user()->id;
        $guarantor->ip_address        = request()->ip();
        $guarantor->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $guarantor->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $guarantor, 'table' => '#guarantor_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $guarantor)
    {
        $guarantor = Guarantor::find($guarantor);
        if (!$request->ajax()) {
            return view('backend.user.guarantor.view', compact('guarantor'));
        } else {
            return view('backend.user.guarantor.modal.view', compact('guarantor'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $guarantor = Guarantor::find($id);       
        if (!$request->ajax()) {
            return view('backend.user.guarantor.edit', compact('guarantor', 'id'));
        } else {
            return view('backend.user.guarantor.modal.edit', compact('guarantor', 'id'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [        
            'name'              => 'required',
            'employer'          => 'nullable',
            'cellphone'         => 'nullable',
            'address'           => 'required',            
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('guarantor.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $guarantor                    = Guarantor::find($id);
        $guarantor->name              = $request->input('name');
        $guarantor->employer          = $request->input('employer');
        $guarantor->cellphone         = $request->input('cellphone');
        $guarantor->address           = $request->input('address');
        $guarantor->updated_by_id     = Auth::user()->id;
        $guarantor->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $guarantor->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $guarantor, 'table' => '#guarantor_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guarantor = Guarantor::find($id);
        $guarantor->delete();
        return back()->with('success', _lang('Deleted successfully'));
    }
}
