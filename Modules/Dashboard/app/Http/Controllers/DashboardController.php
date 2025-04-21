<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Modules\Dashboard\app\Events\ContactUsReplay;
use Modules\Dashboard\Mail\ContactReplyMail;
use Modules\Website\app\Models\ContactUs;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard::home.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function  contactUs()
    {
        $contact_us = ContactUs::paginate(10);
        return view('dashboard::contact-us.index', compact('contact_us'));
    }
    public function contactUsShow($id)
    {
        $contact_us = ContactUs::find($id);
        return view('dashboard::contact-us.show', compact('contact_us'));
    }
    public function SendMail()
    {
        $contact_us = new ContactUs();
        return view('dashboard::contact-us.form', compact('contact_us'));

    }
    public function SaveMail(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255',
            'message' =>'required|string|max:255',
        ]);
        $contact_us = new ContactUs();
        $contact_us->name = $request->name;
        $contact_us->email = $request->email;
        $contact_us->message = $request->message;
        $contact_us->save();
        Mail::to($contact_us->email)->send(new ContactReplyMail($contact_us , $request->message));
            return back()->with('success', 'Message has been sent successfully');
    }


    public function contactUsReplaySend($id)
    {
        $contact_us = ContactUs::find($id);
        return view('dashboard::contact-us.form', compact('contact_us'));
    }

    public function contactUsReplayStore(Request $request,$id)
    {
        $request->validate([
            'message'=>'string|max:255'
        ]);
        $contact_us = ContactUs::find($id);
        $contact_us->reply = $request->message;
        $contact_us->save();
        Mail::to($contact_us->email)->send(new ContactReplyMail($contact_us, $request->message));
//        $contact_us->replay = $request->replay;
        return back()->with('success', 'Replay has been sent successfully');
    }

}
