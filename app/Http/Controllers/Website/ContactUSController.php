<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Mail\Contacts;
use Mail;
class ContactUSController extends Controller
{
    public function contactPage()
    {
        return view('website.page-contacts');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'subject' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }

        $user = Auth::user();
        $contact = new Contact;
        $contact->subject = $request->subject;
        $contact->body = $request->body;
        $contact->customer_id = $user->id;
        $contact->save();

        Mail::to("kop@wahfyservices.com")
            ->send(new Contacts($contact));
        return redirect()->back()->with(['success' => __('general.Contact Message Sent')]);
    }
}
