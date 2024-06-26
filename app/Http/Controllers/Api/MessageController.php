<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReceived;


class MessageController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'content' => 'required|string',
            'apartment_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }



        /*   $validated = $validator->validated();
            $message = new Message();
            $message->name = $validated['name'];
            $message->lastname = $validated['lastname'];
            $message->sender_email = $validated['sender_email'];
            $message->content = $validated['content'];
            $message->apartment_id = $validated['apartment_id'];
            $message->save();
 */

        //get apartment id
        $apartment = Apartment::find($data['apartment_id']);

        // Creazione e salvataggio del messaggio nel database
        $newMessage = Message::create($data);

        // Invio dell'email utilizzando il Mailable MessageReceived
        Mail::to($apartment->user->email)->send(new MessageReceived($newMessage));

        // Ritorno una risposta JSON di successo
        return response()->json(['success' => true, 'message' => 'Message received and email sent!']);
    }






    public function index()
    {
        // $idApartment = Auth::user()->apartment_id;
        // $messages = Message::where('apartment_id', $idApartment)->get();
        // return view('admin.messages.index', compact('messages'));
        $user = Auth::user();
        $apartmentIds = $user->apartments->pluck('id')->toArray();
        $apartment = Apartment::where('user_id', $user->id)->get();
        $messages = [];

        if (!empty($apartmentIds)) {
            $messages = Message::whereIn('apartment_id', $apartmentIds)->orderByDesc('id')->get();
        }
        //dd($apartment);

        return view('admin.messages.index', compact('messages', 'apartment'));
    }

    public function show(Message $message)
    {
        $user = Auth::user();
        if ($message->apartment->user_id !== $user->id) {
            abort(403, 'This is not your apartment!');
        }
        return view('admin.messages.show', compact('message'));
    }
    public function destroy(Message $message)
    {
        $message->delete(); //Good for soft delete

        return to_route('admin.messages.index')->with('message', "The message of $message->name $message->lastname has been deleted successfully");
    }
}
