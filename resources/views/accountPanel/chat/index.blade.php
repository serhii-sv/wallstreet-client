@extends('layouts.accountPanel.app')
@section('title')
Chat page
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col call-chat-sidebar col-sm-12" style="margin-top:20px;">
        <div class="card">
          <div class="card-body chat-body">
            <div class="chat-box">
              <!-- Chat left side Start-->
              <div class="chat-left-aside">
                <div class="media">
                  <img class="rounded-circle user-image" src="{{ $myAvatar ?? asset('accountPanel/images/user/user.png') }}" alt="">
                  <div class="about">
                    <div class="name f-w-600">{{ auth()->user()->name }}</div>
                    <div class="status">{{ auth()->user()->login }}</div>
                  </div>
                </div>
                <div class="people-list" id="people-list">
                  <div class="search">
                    <form class="theme-form" action="{{ route('accountPanel.chat') }}">
                      <div class="mb-3">
                        <input class="form-control" type="text" name="login" placeholder="Search" data-bs-original-title="" title="" value="{{ $login }}">
                          <i class="fa fa-search"></i>
                      </div>
                    </form>
                  </div>
                  <ul class="list">
                      @if(!empty($filteredReferrals))
                          @forelse($filteredReferrals as $filteredReferral)
                              <li class="clearfix">
                                  <a href="{{ route('accountPanel.chat', $filteredReferral->getReferralChatId()) }}">
                                      <img class="rounded-circle user-image" src="{{ $filteredReferral->avatar ? route('accountPanel.profile.get.avatar',auth()->user()->partner()->first()->id) : asset('accountPanel/images/user/user.png')  }}" alt="">
                                      <div class="status-circle {{  $filteredReferral->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                                      <div class="about">
                                          <div class="name">{{ $filteredReferral->login }}</div>
                                          <div class="status">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Referral' contenteditable="true">{{ __('Referral') }}</editor_block> @else {{ __('Referral') }} @endif</div>
                                      </div>
                                      <span class="unread badge round-badge-primary">{{$filteredReferral->getReferralChat()->getUnreadMessagesCount(auth()->user()->id) > 0 ? '+' .  $filteredReferral->getReferralChat()->getUnreadMessagesCount(auth()->user()->id) : '' }}</span>
                                  </a>
                              </li>
                          @empty
                              <li class="clearfix">
                                  <span>
                                      @if(canEditLang() && checkRequestOnEdit())
                                          <editor_block data-name='Пользователь с таким логином не найден' contenteditable="true">{{ __('Пользователь с таким логином не найден') }}</editor_block>
                                      @else
                                          {{ __('Пользователь с таким логином не найден') }}
                                      @endif
                                  </span>
                              </li>
                          @endforelse
                      @else
                    @if(!empty(auth()->user()->partner()->first()))
                      <li class="clearfix">
                        <a href="{{ route('accountPanel.chat', auth()->user()->partner()->first()->getPartnerChatId()) }}">
                          <img class="rounded-circle user-image" src="{{ auth()->user()->partner()->first()->avatar ? route('accountPanel.profile.get.avatar',auth()->user()->partner()->first()->id) : asset('accountPanel/images/user/user.png')  }}" alt="">
                          <div class="status-circle {{  auth()->user()->partner()->first()->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                          <div class="about">
                            <div class="name">{{ auth()->user()->partner()->first()->login }}</div>
                            <div class="status">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Partner' contenteditable="true">{{ __('Partner') }}</editor_block> @else {{ __('Partner') }} @endif</div>

                          </div>
                          <span class="unread badge round-badge-primary">{{auth()->user()->partner()->first()->getPartnerChat()->getUnreadMessagesCount(auth()->user()->id) > 0 ? '+' .  auth()->user()->partner()->first()->getPartnerChat()->getUnreadMessagesCount(auth()->user()->id) : '' }}</span>
                        </a>
                      </li>
                    @endif
{{--                    @if(!empty(auth()->user()->hasReferrals()))--}}
                      @foreach($activeChats as $activeChat)
                        <li class="clearfix">
                          <a href="{{ route('accountPanel.chat', $activeChat->userReferral->getReferralChatId()) }}">
                            <img class="rounded-circle user-image" src="{{ $activeChat->userReferral->avatar ? route('accountPanel.profile.get.avatar',$activeChat->userReferral->id) : asset('accountPanel/images/user/user.png') }}" alt="">
                            <div class="status-circle {{ $activeChat->userReferral->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                            <div class="about">
                              <div class="name">{{ $activeChat->userReferral->login }}</div>
                              <div class="status">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Referral' contenteditable="true">{{ __('Referral') }}</editor_block> @else {{ __('Referral') }} @endif</div>
                            </div>
                            <span class="unread badge round-badge-primary">{{ $activeChat->userReferral->getReferralChat()->getUnreadMessagesCount(auth()->user()->id) > 0 ? '+' .  $activeChat->userReferral->getReferralChat()->getUnreadMessagesCount(auth()->user()->id) : '' }}</span>
                          </a>
                        </li>
                      @endforeach
                    @endif
                  </ul>

                </div>
              </div>
              <!-- Chat left side Ends-->
            </div>
          </div>
        </div>
      </div>
      <div class="col call-chat-body" style="margin-top: 20px">
        <div class="card">
          <div class="card-body p-0">
            <div class="row chat-box">
              <!-- Chat right side start-->
              <div class="col pe-0 chat-right-aside">
                <!-- chat start-->
                <div class="chat">
                @if(!empty($chat))
                  <!-- chat-header start-->
                    @if(!empty($companion))
                      <div class="chat-header clearfix">
                        <img class="rounded-circle" src="{{ $companion->avatar ? route('accountPanel.profile.get.avatar',$companion->id) : asset('accountPanel/images/user/user.png') }}" alt="">
                        <div class="about">
                          <div class="name">{{ $companion->name }}&nbsp;&nbsp;({{ $companion->login }})&nbsp;&nbsp;
                            <span class="font-primary f-12">{{ $companion->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}</span>
                          </div>
                          <div class="status">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Last Seen' contenteditable="true">{{ __('Last Seen') }}</editor_block> @else {{ __('Last Seen') }} @endif {{ $companion->getLastActivityAttribute()['last_seen'] }}</div>
                        </div>
                        <ul class="list-inline float-start float-sm-end chat-menu-icons">

                        </ul>
                      </div>
                  @endif
                  <!-- chat-header end-->
                    <div class="chat-history chat-msg-box custom-scrollbar">

                      <ul class="chat-msg-list">
                        @if(!empty($chat_messages))
                          @foreach($chat_messages as $message)
                            @if($message->user_id == auth()->user()->id)
                              <li>
                                <div class="message my-message mb-0">
                                  <img class="rounded-circle float-start chat-user-img img-30" src="{{ $myAvatar ?? asset('accountPanel/images/user/user.png') }}" alt="">
                                  <div class="message-data text-end">
                                    <span class="message-data-time">{{ $message->created_at->format('d.M H:i:s') }}</span>
                                  </div>
                                  {{ $message->message }}
                                </div>
                              </li>
                            @else
                              <li class="clearfix">
                                <div class="message other-message pull-right">
                                  <img class="rounded-circle float-end chat-user-img img-30" src="{{ asset('accountPanel/images/user/12.png') }}" alt="">
                                  <div class="message-data">
                                    <span class="message-data-time">{{ $message->created_at->format('d.M H:i:s') }}</span>
                                  </div>
                                  {{ $message->message }}
                                </div>
                              </li>
                            @endif
                          @endforeach
                        @endif


                      </ul>

                    </div>
                    <!-- end chat-history-->
                    <div class="chat-message clearfix">
                      <div class="row">
                        <div class="col-xl-12 d-flex">
                          <div class="input-group text-box">
                            <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message.." data-bs-original-title="" title="">
                            <button class="input-group-text btn btn-primary send-message-btn" type="button" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Send' contenteditable="true">{{ __('Send') }}</editor_block> @else {{ __('Send') }} @endif</button>
                          </div>
                        </div>
                      </div>
                    </div>
                @endif
                <!-- end chat-message-->
                  <!-- chat end-->
                  <!-- Chat right side ends-->
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
  @if($chat)
    <script src="{{ asset('/js/app.js') }}"></script>
    {{--  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>--}}
    <script>
      $(document).ready(function () {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June",
          "July", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        function scrollChat() {
          var container = $('.chat-history'),
              scrollTo = $('.chat-msg-list');
          container.scrollTop(scrollTo.prop('scrollHeight'));
        }

        scrollChat();
        Pusher.logToConsole = true;

        window.Echo.private('chat.{{ $chat->id }}').listen('PrivateChat', (data) => {
          var $data = data;
          var $message_id = $data.message_id;

          if (!($data.user == "{{ auth()->user()->id }}")) {
            var $options = {
              method: "post",
              url: "{{ route('accountPanel.chat.message.read') }}",
              data: {
                user: "{{ auth()->user()->id }}",
                message_id: $message_id,
              }
            }
            window.axios($options);
          }

          if ($data.chat_id == "{{ $chat->id }}" && $data.user == "{{ auth()->user()->id }}") {
            $(".chat-msg-list").append('<li>' +
                '<div class="message my-message mb-0">' +
                '  <img class="rounded-circle float-start chat-user-img img-30" src="{{ $myAvatar ?? asset('accountPanel/images/user/16.png') }}" alt="">' +
                '   <div class="message-data text-end">' +
                '    <span class="message-data-time">' + $data.time + '</span>' +
                '   </div>' +
                $data.message +
                '  </div>' +
                '</li>');
          } else {
            $(".chat-msg-list").append('<li class="clearfix">' +
                '<div class="message other-message pull-right">' +
                '<img class="rounded-circle float-end chat-user-img img-30" src="{{ $companion->avatar ? route('accountPanel.profile.get.avatar',$companion->id) : asset('accountPanel/images/user/16.png') }}" alt="">' +
                '<div class="message-data">' +
                '  <span class="message-data-time">' + $data.time + '</span>' +
                ' </div>' +
                $data.message +
                ' </div>' +
                '</li>');
          }
          scrollChat();
        });

        $(".send-message-btn").on('click', function (e) {
          var $message = $("#message-to-send").val();
          if ($message.length > 0) {
            var $options = {
              method: "post",
              url: "{{ route('accountPanel.chat.send.message') }}",
              data: {
                user: "{{ auth()->user()->id }}",
                message: $message,
                chat_id: "{{ $chat->id }}",
                type: "message",
              }
            }
            window.axios($options);
          }
          $("#message-to-send").val('');
        });
        $("#message-to-send").keyup(function (event) {
          if (event.keyCode == 13) {
            var $message = $(this).val();
            if ($message.length > 0) {
              var $options = {
                method: "post",
                url: "{{ route('accountPanel.chat.send.message') }}",
                data: {
                  user: "{{ auth()->user()->id }}",
                  message: $message,
                  chat_id: "{{ $chat->id }}",
                  type: "message",
                }
              }
              window.axios($options);
            }
            $(this).val('');
          }
        });

        function addZeroBefore(n) {
          return (n < 10 ? '0' : '') + n;
        }
      });

    </script>
  @endif
  {{--@if($chat)
    <script>
      window.onload = function () {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June",
          "July", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        function scrollChat() {
          var container = $('.chat-history'),
              scrollTo = $('.chat-msg-list');
          container.scrollTop(scrollTo.prop('scrollHeight'));
        }

        scrollChat();

        function addZeroBefore(n) {
          return (n < 10 ? '0' : '') + n;
        }

        $("#message-to-send").keyup(function (event) {
          if (event.keyCode == 13) {
            var $message = $(this).val();
            if ($message.length > 0) {
              send($message);
            }
            $(this).val('');
          }
        });
        var conn = new WebSocket((window.location.protocol === "http:" ? "ws" : "wss") + "://" + window.location.host + ":6001");

        conn.onmessage = function ($data) {
          $data = $.parseJSON($data.data);

          if ($data.chat == "{{ $chat->id }}" && $data.user == "{{ auth()->user()->id }}") {

            $(".chat-msg-list").append('<li>' +
                '<div class="message my-message mb-0">' +
                '  <img class="rounded-circle float-start chat-user-img img-30" src="{{ $myAvatar ?? asset('accountPanel/images/user/16.png') }}" alt="">' +
                '   <div class="message-data text-end">' +
                '    <span class="message-data-time">10:20 am</span>' +
                '   </div>' +
                $data.message +
                '  </div>' +
                '</li>');
          } else {
            $(".chat-msg-list").append('<li class="clearfix">' +
                '<div class="message other-message pull-right">' +
                '<img class="rounded-circle float-end chat-user-img img-30" src="{{ $companion->avatar ? route('accountPanel.profile.get.avatar',$companion->id) : asset('accountPanel/images/user/16.png') }}" alt="">' +
                '<div class="message-data">' +
                '  <span class="message-data-time">' + $data.time + '</span>' +
                ' </div>' +
                $data.message +
                ' </div>' +
                '</li>');
          }

          scrollChat();
        };
        conn.onopen = function ($data) {
          console.log("Соединение установлено");
          send(JSON.stringify({
            status: "check",
            chat: "{{ $chat->id }}",
            user_partner: "{{ $chat->user_partner()->first()->id }}",
            user_referral: "{{ $chat->user_referral()->first()->id }}",
            current_user: "{{ auth()->user()->id }}",
          }));
        }
        conn.onclose = function(event) {
          if (event.wasClean) {
            console.log('Соединение закрыто чисто');
          } else {
            console.log('Обрыв соединения'); // например, "убит" процесс сервера
          }
          console.log('Код: ' + event.code + ' причина: ' + event.reason);
        };

        function send($message) {
          var data = $message;
          var now = new Date;

          var time = now.getUTCDate() + '.' + monthNames[now.getUTCMonth()] + ' ' + addZeroBefore(now.getUTCHours()) + ':' + addZeroBefore(now.getUTCMinutes()) + ':' + addZeroBefore(now.getUTCSeconds());
          conn.send(JSON.stringify({
            status: "message",
            chat: "{{ $chat->id }}",
            user: "{{ auth()->user()->id }}",
            message: data
          }));
          $(".chat-msg-list").append('<li>' +
              '<div class="message my-message mb-0">' +
              '                            <img class="rounded-circle float-start chat-user-img img-30" src="{{ $myAvatar ?? asset('accountPanel/images/user/16.png') }}" alt="">' +
              '                            <div class="message-data text-end">' +
              '                              <span class="message-data-time">' + time + '</span>' +
              '                            </div>' +
              data +
              '                         </div>' +
              '</li>');
          scrollChat();
        }

        $(".send-message-btn").on('click', function (e) {
          var $message = $("#message-to-send").val();
          if ($message.length > 0) {
            send($message);
          }
          $("#message-to-send").val('');
        });
      };
    </script>
  @endif--}}
@endpush
