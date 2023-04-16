<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MessageFormController extends Controller
{
    public function index ()
    {
        if (request()->ajax()) {
            return DataTables::of(ContactForm::latest())
                ->addIndexColumn()
                ->addColumn('action', 'admin.message_form._action')
                ->toJson();
        }
        return view('admin.message_form.index');
    }

    public function show (ContactForm $message_form){

        return view('admin.message_form.show', compact('message_form'));
    }


}
