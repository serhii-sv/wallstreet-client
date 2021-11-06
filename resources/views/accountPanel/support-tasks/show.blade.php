@extends('layouts.accountPanel.app')
@section('title')
Task details
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col call-chat-body" style="margin-top:50px;">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pe-0 chat-right-aside">
                                <!-- chat start-->
                                <div class="chat">
                                    <!-- chat-header end-->
                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                        <ul style="height: 100%">
                                            @forelse($supportTask->messages as $message)
                                                @if($message->user_id !== auth()->user()->id)
                                                    <li>
                                                        <div class="message my-message">
                                                            <img class="rounded-circle float-start chat-user-img img-30" src="{{ route('accountPanel.profile.get.avatar', $message->user_id) }}" alt="">
                                                            <div class="message-data text-end">
                                                                <span class="message-data-time">{{ $message->created_at->format('d-m-Y H:i') }}</span>
                                                            </div>
                                                            {{ $message->message }}
                                                        </div>
                                                    </li>
                                                @else
                                                    <li class="clearfix">
                                                        <div class="message other-message pull-right">
                                                            <img class="rounded-circle float-end chat-user-img img-30" src="{{ route('accountPanel.profile.get.avatar', $message->user_id) }}" alt="">
                                                            <div class="message-data">
                                                                <span class="message-data-time">{{ $message->created_at->format('d-m-Y H:i') }}</span>
                                                            </div>
                                                            {{ $message->message }}
                                                        </div>
                                                    </li>
                                                @endif
                                            @empty
                                                <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                                                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name="Wait for the administrator's response" contenteditable="true">{{ __("Wait for the administrator's response") }}</editor_block> @else {{ __("Wait for the administrator's response") }} @endif
                                                </div>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <!-- end chat-history-->
                                    <div class="chat-message clearfix">
                                        <div class="row">
                                            @if($supportTask->status == \App\Models\SupportTask::ANSWERED_STATUS)
                                                <form method="post" action="{{ route('accountPanel.support-tasks.messages.store', $supportTask->id) }}">
                                                    @csrf
                                                    <div class="col-xl-12 d-flex">
                                                        <div class="input-group text-box">
                                                            <input class="form-control input-txt-bx" type="text" name="message" value="{{ old('message') }}" placeholder="Type a message......">
                                                            <button class="input-group-text btn btn-primary" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                                                              @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='SEND' contenteditable="true">{{ __('SEND') }}</editor_block> @else {{ __('SEND') }} @endif
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        @include('partials.inform')
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
