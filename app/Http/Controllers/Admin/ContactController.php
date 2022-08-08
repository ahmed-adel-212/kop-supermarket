<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

use App\Traits\LogfileTrait;


class ContactController extends Controller
{

    use LogfileTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id', 'DESC')->get();
        $this->Make_Log('App\Models\Contact','view',0);
        return view('admin.contacts.index', compact('contacts'));
    }
}
