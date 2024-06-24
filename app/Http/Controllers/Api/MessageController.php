<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MessageController extends Controller
{

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'content' => 'required|string',
            'apartment_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }



        $validated = $validator->validated();
        $message = new Message();
        $message->name = $validated['name'];
        $message->lastname = $validated['lastname'];
        $message->sender_email = $validated['sender_email'];
        $message->content = $validated['content'];
        $message->apartment_id = $validated['apartment_id'];
        $message->save();

        return response()->json(['success' => true, 'message' => 'Message received!']);
    }
    public function index()
    {
        // $idApartment = Auth::user()->apartment_id;
        // $messages = Message::where('apartment_id', $idApartment)->get();
        // return view('admin.messages.index', compact('messages'));
        $user = Auth::user();
        $apartment = Apartment::where('user_id', $user->id)->get();
        $apartments = $user->apartments->pluck('id');
        $messages = Message::where('apartment_id', $apartments)->orderByDesc('id')->get();
        //dd($apartment);
        return view('admin.messages.index', compact('messages', 'apartment'));
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }
}
