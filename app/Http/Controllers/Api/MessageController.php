<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
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
        // Creazione e salvataggio del messaggio nel database
        $newMessage = Message::create($data);

        // Invio dell'email utilizzando il Mailable MessageReceived
        Mail::to('raluca.bubulina@yahoo.com')->send(new MessageReceived($newMessage));

        // Ritorno una risposta JSON di successo
        return response()->json(['success' => true, 'message' => 'Message received and email sent!']);
    }

    /* public function sendTestEmail()
    {
        // Dati di esempio per il test
        $data = [
            'sender_email' => 'sender@example.com',
            'name' => 'lorem',
            'lastname' => 'lorem',
            'content' => 'this is a test email.',
            'apartment_id' => 1,
        ];

        // invio l email di test
        Mail::to('recipient@example.com')->send(new MessageReceived($data));

        // ritorna un messaggio di conferma
        return 'Test email sent!';
    } */
}
