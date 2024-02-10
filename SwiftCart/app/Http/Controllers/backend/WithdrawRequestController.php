<?php

namespace App\Http\Controllers\backend;

use App\DataTables\WithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{

    public function index(WithdrawRequestDataTable $datatable)
    {
        return $datatable->render('admin.withdraw_request.index');
    }

    public function show(String $id)
    {
        $withdraw_request = WithdrawRequest::findOrFail($id);
        return view('admin.withdraw_request.show', compact('withdraw_request'));
    }

    public function switch_status(Request $request)
    {
       $withdraw_request = WithdrawRequest::findOrFail($request->id);
       $withdraw_request->update(['status'=>$request->value]);
       return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
    }
}
