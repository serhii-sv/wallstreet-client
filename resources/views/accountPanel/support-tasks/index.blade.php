@extends('layouts.accountPanel.app')
@section('title')
Support tasks
@endsection

@section('content')
    <div class="container-fluid">
        <div class="email-wrap bookmark-wrap">
            <div class="row">
                <div class="col-xl-12 col-md-12 box-col-12" style="margin-top:50px;">
                    <div class="email-right-aside bookmark-tabcontent">
                        <div class="card email-body radius-left">
                            <div class="ps-0">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                                        <div class="card mb-0">
                                            <div class="card-header d-flex align-items-center">
                                                <h5 class="mb-0">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Created by me' contenteditable="true">{{ __('Created by me') }}</editor_block> @else {{ __('Created by me') }} @endif</h5>
                                                <a href="{{ route('accountPanel.support-tasks.create') }}" class="badge-light-primary btn-block btn-mail m-0">
                                                    <i class="me-2" data-feather="check-circle"></i>
                                                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='New Task' contenteditable="true">{{ __('New Task') }}</editor_block> @else {{ __('New Task') }} @endif
                                                </a>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="taskadd">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            @forelse($tasks as $task)
                                                                <tr>
                                                                    <td>
                                                                        <h6 class="task_title_0">{{ $task->title }}</h6>
                                                                    </td>
                                                                    <td>
                                                                        <p class="task_desc_0">{{ $task->description }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <a class="me-2" href="{{ route('accountPanel.support-tasks.show', $task->id) }}">
                                                                            <i data-feather="eye"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <p>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='No tasks' contenteditable="true">{{ __('No tasks') }}</editor_block> @else {{ __('No tasks') }} @endif</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            {{ $tasks->links() }}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        </table>
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
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
