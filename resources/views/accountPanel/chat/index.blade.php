@extends('layouts.accountPanel.app')
@section('title', __('Чат'))
@section('content')
  
  <div class="container-fluid">
    <div class="row">
      <div class="col call-chat-sidebar col-sm-12">
        <div class="card">
          <div class="card-body chat-body">
            <div class="chat-box">
              <!-- Chat left side Start-->
              <div class="chat-left-aside">
                <div class="media">
                  <img class="rounded-circle user-image" src="{{ $myAvatar ?? asset('accountPanel/images/user/16.png') }}" alt="">
                  <div class="about">
                    <div class="name f-w-600">{{ auth()->user()->name }}</div>
                    <div class="status">{{ auth()->user()->login }}</div>
                  </div>
                </div>
                <div class="people-list" id="people-list">
                  <div class="search">
                    <form class="theme-form">
                      <div class="mb-3">
                        <input class="form-control" type="text" placeholder="Search" data-bs-original-title="" title=""><i class="fa fa-search"></i>
                      </div>
                    </form>
                  </div>
                  <ul class="list">
                    @if(!empty(auth()->user()->partner()->first()))
                      <li class="clearfix">
                        <a href="{{ route('accountPanel.chat', auth()->user()->partner()->first()->getPartnerChat()) }}">
                          <img class="rounded-circle user-image" src="{{ auth()->user()->partner()->first()->avatar ? route('accountPanel.profile.get.avatar',auth()->user()->partner()->first()->id) : asset('accountPanel/images/user/16.png')  }}" alt="">
                          <div class="status-circle "></div>
                          <div class="about">
                            <div class="name">{{ auth()->user()->partner()->first()->login }}</div>
                            <div class="status">Partner</div>
                          </div>
                        </a>
                      </li>
                    @endif
                    @if(!empty(auth()->user()->hasReferrals()))
                      @foreach(auth()->user()->referrals()->get() as $user)
                        <li class="clearfix">
                          <a href="{{ route('accountPanel.chat', $user->getReferralChat()) }}">
                            <img class="rounded-circle user-image" src="{{ $user->avatar ? route('accountPanel.profile.get.avatar',$user->id) : asset('accountPanel/images/user/16.png') }}" alt="">
                            <div class="status-circle "></div>
                            <div class="about">
                              <div class="name">{{ $user->login }}</div>
                              <div class="status">Referral</div>
                            </div>
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
      <div class="col call-chat-body">
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
                        <img class="rounded-circle" src="{{ $companion->avatar ? route('accountPanel.profile.get.avatar',$companion->id) : asset('accountPanel/images/user/16.png') }}" alt="">
                        <div class="about">
                          <div class="name">{{ $companion->name }}&nbsp;&nbsp;({{ $companion->login }})&nbsp;&nbsp;
                            <span class="font-primary f-12">{{ $companion->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}</span>
                          </div>
                          <div class="status">Last Seen {{ $companion->getLastActivityAttribute()['last_seen'] }}</div>
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
                                  <img class="rounded-circle float-start chat-user-img img-30" src="{{ $myAvatar ?? asset('accountPanel/images/user/16.png') }}" alt="">
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
                            <button class="input-group-text btn btn-primary send-message-btn" type="button" data-bs-original-title="" title="">SEND</button>
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
    <script>
      $(document).ready(function () {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June",
          "July", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        function scrollChat(){
          var container = $('.chat-history'),
              scrollTo = $('.chat-msg-list');
          container.scrollTop(scrollTo.prop('scrollHeight'));
        }
        scrollChat();
        
        function addZeroBefore(n) {
          return (n < 10 ? '0' : '') + n;
        }
  
        $("#message-to-send").keyup(function(event){
          if(event.keyCode == 13){
            var $message = $(this).val();
            if ($message.length > 0) {
              send($message);
            }
            $(this).val('');
          }
        });
        
        var conn = new WebSocket('ws://localhost:6001');
        
        conn.onopen = function ($data) {
          console.log("Соединение установлено");

          conn.send(JSON.stringify({
            status: "check",
            chat: "{{ $chat->id }}",
            user_partner: "{{ $chat->user_partner()->first()->id }}",
            user_referral: "{{ $chat->user_referral()->first()->id }}",
            current_user: "{{ auth()->user()->id }}",
          }));
        }
        
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
      });
    </script>
  @endif
@endpush
