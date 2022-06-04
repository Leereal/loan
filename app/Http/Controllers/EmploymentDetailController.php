<?php

namespace App\Http\Controllers;

use App\Models\EmploymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmploymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employment_details = EmploymentDetail::all()
            ->orderBy("id", "desc")
            ->get();
        return view('backend.user.employment_detail.list', compact('employment_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->get('user');
        return view('backend.user.employment_detail.create',compact('user_id'));
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
            'user_id'               => 'required|numeric',
            'salary'                => 'required|numeric',
            'name'                  => 'required',
            'telephone'             => 'nullable',
            'address'               => 'nullable',                     
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('employment_details.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $employment_detail                                  = new EmploymentDetail();
        $employment_detail->user_id                         = $request->input('user_id');
        $employment_detail->salary                          = $request->input('salary');
        $employment_detail->name                            = $request->input('name');
        $employment_detail->telephone                       = $request->input('telephone');
        $employment_detail->address                         = $request->input('address');
        $employment_detail->limit                           = ceil($employment_detail->salary / 3);// A third of salary
        $employment_detail->created_by_id                   = Auth::user()->id;
        $employment_detail->ip_address                      = request()->ip();
        $employment_detail->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $employment_detail->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $employment_detail, 'table' => '#employment_detail_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmploymentDetail  $employmentDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $employmentDetail)
    {
        $employment_detail = EmploymentDetail::find($employmentDetail);
        if (!$request->ajax()) {
            return view('backend.user.employment_detail.view', compact('employment_detail'));
        } else {
            return view('backend.user.employment_detail.modal.view', compact('employment_detail'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmploymentDetail  $employmentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $employment_detail = EmploymentDetail::find($id);       
        if (!$request->ajax()) {
            return view('backend.user.employment_detail.edit', compact('employment_detail', 'id'));
        } else {
            return view('backend.user.employment_detail.modal.edit', compact('employment_detail', 'id'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmploymentDetail  $employmentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [     
            'salary'                => 'required|numeric',
            'name'                  => 'required',
            'telephone'             => 'nullable',
            'address'               => 'nullable',                     
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('employment_detail.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $employment_detail                                  = EmploymentDetail::find($id);      
        $employment_detail->salary                          = $request->input('salary');
        $employment_detail->name                            = $request->input('name');
        $employment_detail->telephone                       = $request->input('telephone');
        $employment_detail->address                         = $request->input('address');
        $employment_detail->limit                           = ceil($employment_detail->salary / 3);// A third of salary
        $employment_detail->updated_by_id                   = Auth::user()->id;
        $employment_detail->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $employment_detail->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $employment_detail, 'table' => '#employment_detail_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmploymentDetail  $employmentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employmentDetail = EmploymentDetail::find($id);
        $employmentDetail->delete();
        return back()->with('success', _lang('Deleted successfully'));
    }
}
