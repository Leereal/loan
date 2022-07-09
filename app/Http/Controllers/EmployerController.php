<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::all();
        return view('backend.employer.list', compact('employers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $employers = Employer::all();
        if (!$request->ajax()) {
            return view('backend.employer.create', compact('employers'));
        } else {
            return view('backend.employer.modal.create');
        }
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
            'name'            => 'required',                 
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('employers.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $employer                       = new Employer();
        $employer->name                 = $request->input('name');      
        $employer->address              = $request->input('address');
        $employer->phone                = $request->input('phone');
        $employer->contact_name         = $request->input('contact_name');     
        $employer->save();

        if (!$request->ajax()) {
            return redirect()->route('employers.index')->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $employer, 'table' => '#employer_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $employer = Employer::find($id);
        if (!$request->ajax()) {
            return view('backend.employer.view', compact('employer', 'id'));
        } else {
            return view('backend.employer.modal.view', compact('employer', 'id'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
      
        $employer = Employer::find($id);
        if (!$request->ajax()) {
            return view('backend.employer.edit', compact('employer', 'id'));
        } else {
            return view('backend.employer.modal.edit', compact('employer', 'id'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name'            => 'required',         
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('employers.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $employer                       = Employer::find($id);
        $employer->name                 = $request->input('name');      
        $employer->address              = $request->input('address');
        $employer->phone                = $request->input('phone');
        $employer->contact_name         = $request->input('contact_name'); 
        $employer->save();

        if (!$request->ajax()) {
            return redirect()->route('employers.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $employer, 'table' => '#employer_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $employer = Employer::find($id);
        $employer->delete();
        return redirect()->route('employers.index')->with('success', _lang('Deleted successfully'));
    }
}
