@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mb-3">
            <h4>Tot. Messaggi: </h4>
            <h4 id="count" data-val="{{ $messages->count() }}" class="px-1"> 000</h4>
        </div>
        <div class="row">
            <div class="col d-flex flex-column gap-3">
                @forelse($messages as $message)
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-heading d-flex align-items-md-center justify-content-between flex-column flex-md-row">
                                <div class="d-flex align-items-md-center gap-2 flex-column flex-lg-row">
                                    <h4 class="card-title">{{ $message->name }} {{ $message->lastname }}</h4>
                                    <p class="card-text"><strong class="d-lg-none">From:
                                        </strong>{{ $message->sender_email }}</p>
                                </div>

                                <p class="card-text"><strong>Sent: </strong>{{ $message->created_at }}</p>
                            </div>
                            <div class="card-info d-flex gap-3">
                                <p class="card-text"><strong>Apartment: </strong>{{ $message->apartment->title }}</p>
                            </div>

                            <div class="accordion pb-3" id="accordionExample{{ $message->id }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $message->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $message->id }}" aria-expanded="true"
                                            aria-controls="collapseOne" style="background-color: white">
                                            Read the Message
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $message->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $message->id }}"
                                        data-bs-parent="#accordionExample{{ $message->id }}">
                                        <div class="accordion-body">
                                            {{ $message->content }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex align-items-center justify-content-end">
                                <a name="show" id="show" class="btn btn-dark text-light"
                                    href="{{ route('admin.messages.show', $message) }}" role="button"><i class="fa fa-eye"
                                        aria-hidden="true" style="height: 10px"></i></a>
                                <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $message->id }}" style="height: 16px margin:auto">
                                    <i class="fa fa-trash" style="font-size: 0.93rem" aria-hidden="true"></i>
                                </button>
                                <div class="modal fade" id="modalId-{{ $message->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    Attention! Are you sure you want to delete the message of:
                                                    {{ $message->name }}
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
                                                <form action="{{ route('admin.message.destroy', $message) }}"
                                                    method="POST">
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

                        </div>
                    </div>

                @empty
                    <p>No messages</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/message-count.js'])
@endsection
