@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mb-3">
            <h4>Tot. Messaggi: </h4>
            <h4 id="count" data-val="{{ is_array($messages) ? count($messages) : $messages->count() }}" class="px-1"> 000
            </h4>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="">Apartment</th>
                    <th class="">From</th>
                    <th class="">Sent at</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="align-middle">
                        <td>
                            <div class="image-title d-flex align-items-center gap-2">
                                <div class="image d-none d-lg-block">
                                    @if (Str::startsWith($message->apartment->image, 'http'))
                                        <img src="{{ $message->apartment->image }}" alt="" width="80">
                                    @elseif(Str::startsWith($message->apartment->image, 'uploads/'))
                                        <img src="{{ asset('storage/' . $message->apartment->image) }}" alt=""
                                            width="80">
                                    @elseif(Str::startsWith($message->apartment->image, 'apartments/'))
                                        <img src="{{ asset($message->apartment->image) }}" alt="" width="80">
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                            alt="" width="80" class="border rounded">
                                    @endif
                                </div>
                                <div class="title">
                                    {{ $message->apartment->title }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $message->name }} {{ $message->lastname }} </strong><br>
                            {{ $message->sender_email }}
                        </td>
                        <td>
                            <div class="date">
                                {{ \Carbon\Carbon::parse($message->created_at)->format('d F Y') }}
                            </div>
                            <div class="time">
                                {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}
                            </div>
                        </td>
                        <td>

                            <button class="btn btn-principal px-2 py-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#msg-{{ $message->id }}" aria-expanded="false"
                                aria-controls="msg-{{ $message->id }}">
                                <span class="d-none d-xl-inline-block">Read</span>
                                <span>
                                    <i class="fa-solid fa-envelope-circle-check d-xl-none"></i>
                                </span>
                            </button>

                        </td>
                    </tr>
                    <tr class="collapse" id="msg-{{ $message->id }}">
                        <td colspan="4">
                            <div class="card card-body border-0 ps-0">
                                {{ $message->content }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>no messages</td>
                    </tr>
                @endforelse
            </tbody>
        </table>





        {{-- @forelse($messages as $message)
            <div class="card">
                <div class="card-apartment d-flex gap-3 p-2 rounded text-white justify-content-center"
                    style="background-color: #45C2B1">
                    <span><strong>Apartment: </strong></span>
                    <span>{{ $message->apartment->title }}</span>
                </div>
                <div class="card-body">
                    <div class="card-heading d-flex justify-content-between flex-column flex-md-row mb-3">
                        <div class="d-flex gap-2 flex-column">
                            <div class="card-title">
                                <span><strong>From: </strong></span>
                                <span class="fs-5">{{ $message->name }} {{ $message->lastname }}</span>
                            </div>
                            <div class="card-title">
                                <span><strong>Email: </strong></span>
                                <span>{{ $message->sender_email }}</span>
                            </div>
                        </div>

                        <p class="card-text"><strong>Sent: </strong>{{ $message->created_at }}</p>
                    </div>

                    <p class="d-inline-flex gap-1">
                        <button class="btn btn-principal" type="button" data-bs-toggle="collapse"
                            data-bs-target="#msg-{{ $message->id }}" aria-expanded="false"
                            aria-controls="msg-{{ $message->id }}">
                            Read message
                        </button>
                    </p>
                    <div class="collapse" id="msg-{{ $message->id }}">
                        <div class="card card-body border-0 ps-0">
                            {{ $message->content }}
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end">
                        <a name="show" id="show" class="btn btn-outline-primary btn-sm btn-act me-2"
                            href="{{ route('admin.messages.show', $message) }}" role="button"><i class="fa fa-eye"
                                aria-hidden="true" style="height: 10px"></i></a>
                        <button type="button" class="btn btn-outline-danger btn-sm btn-act" data-bs-toggle="modal"
                            data-bs-target="#modalId-{{ $message->id }}" style="height: 16px margin:auto">
                            <i class="fa fa-trash" style="font-size: 0.93rem" aria-hidden="true"></i>
                        </button>
                        <div class="modal fade" id="modalId-{{ $message->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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

                </div>
            </div>

        @empty
            <p>No messages</p>
        @endforelse --}}

    </div>
@endsection

@section('script')
    @vite(['resources/js/message-count.js'])
@endsection
