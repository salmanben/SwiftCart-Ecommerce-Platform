<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\TransactionDataTable;
use App\Models\Transaction;

class TransactionController extends Controller
{
    function index(TransactionDataTable $datatable)
    {
        return $datatable->render('admin.order.transaction');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->delete();
        return response(['status'=>'success', 'message'=>'Transaction Deleted Successfully!']);
    }
}
