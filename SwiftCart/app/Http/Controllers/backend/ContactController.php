<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(ContactDataTable $datatable)
    {
        return $datatable->render('admin.contact.index');
    }

    public function destroy(String $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response(['status' => 'success', 'message' => 'Contact Deleted Successfully!']);
    }
}
