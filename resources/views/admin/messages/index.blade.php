@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-2">
            <div class="col d-flex gap-5">
                @forelse($messages as $message)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $message->name }} {{ $message->lastname }}</h4>
                            <p class="card-text">{{ $message->sender_email }}</p>
                            @foreach ($apartment as $key)
                                <p class="card-text"><strong>Per l'appartamento: </strong>{{ $key->title }}</p>
                            @endforeach
                            <a name="show" id="show" class="btn btn-dark text-light"
                                href="{{ route('admin.messages.show', $message) }}" role="button"><i class="fa fa-eye"
                                    aria-hidden="true"></i></a>
                            <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal"
                                data-bs-target="#modalId-{{ $message->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>

                            </button>
                            <div class="modal fade" id="modalId-{{ $message->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Attention! Are sure you want to delete the message of: {{ $message->name }}
                                                {{ $message->lastname }} ?
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">This is an irreversible operation.
                                            Are you sure you want to run it?</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <form action="{{ route('admin.message.destroy', $message) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Confirm
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
