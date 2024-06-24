<div>
    <h2>Hi</h2>
    You just got a new message from: {{ $message->sender_email }} - {{ $message->name }} {{ $message->lastname }}

    Message: <br>
    <p>{{ $message->content }}</p>
</div>
