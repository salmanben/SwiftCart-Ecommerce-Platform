<?php

namespace App\Http\Controllers\backend;

use App\DataTables\CustomerDataTable;
use App\DataTables\VendorDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\Route;

class UsersListController extends Controller
{
    // Affich all customers
    public function index_customer(CustomerDataTable $datatable)
    {
      return $datatable->render('admin.user.index');
    }

    // Affich all approved vendors
    public function index_vendor(VendorDataTable $datatable)
    {
        return $datatable->render('admin.user.index');
    }

    // Affich all admins
    public function index_admin(AdminDataTable $datatable)
    {
        return $datatable->render('admin.user.index');
    }

    // Switch user  status
    public function switch_status(Request $request)
    {
        if ($request->id == 1)
              return response(['status'=>'error', 'message'=>'Not Authorized Action']);
        $user = User::findOrFail($request->id);
        $user->update(['status'=>$request->status]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
    }

    // Drope Admin
    public function admin_destroy(String $id)
    {
        if (auth()->user()->id != 1)
            return response(['status'=>'error', 'message'=>'Only the main admin can perform this action!']);
        if ($id == 1)
            return response(['status'=>'error', 'message'=>'Not Authorized Action']);
        $admin = User::findOrFail($id);
        if ($admin->orders != null)
            return response(['status'=>'error', 'message'=>'This Admin Can\'t be deleted!']);
        $admin->delete();
        return response(['status'=>'success', 'message'=>'Admin Deleted Successfully!']);
    }
}
