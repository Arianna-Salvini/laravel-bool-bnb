{{-- <div>
    <h2>Hi</h2>
    You just got a new message from: {{ $message->sender_email }} - {{ $message->name }} {{ $message->lastname }}

    Message: <br>
    <p>{{ $message->content }}</p>
</div> --}}

<x-mail::message>
    # EMAIL FROM

    Name: {{ $message->name }}
    Email: {{ $message->sender_email }}

    Message: {{ $message->content }}


    {{ config('app.name') }}
</x-mail::message>
