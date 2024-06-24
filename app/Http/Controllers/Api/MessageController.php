<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $idApartment = Auth::user()->apartment_id;
        $message->apartment_id = $idApartment;
        $message->save();

        return response()->json(['success' => true, 'message' => 'Message received!']);
    }
    public function index()
    {
        $idApartment = Auth::user()->apartment_id;
        $messages = Message::where('apartment_id', $idApartment)->get();
        return view('admin.messages.index', compact('messages'));
    }
}
