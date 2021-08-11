@extends('layouts.accountPanel.app')
@section('title', 'Настройки безопасности')
@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Общие</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                                         data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            {{--<div class="mb-3">
                                <div class="row">
                                    <label class="form-label">E-mail</label>
                                    <div class="col-md-8">
                                        <input class="form-control" placeholder="http://Uplor .com">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="form-control btn btn-square btn-light active txt-dark"
                                                type="button" title=""
                                                data-bs-original-title="btn btn-square btn-light active"
                                                data-original-title="btn btn-square btn-success active">Выслать
                                            подтверждение
                                        </button>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="form-check checkbox checkbox-success mb-0">
                                <input class="form-check-input" type="checkbox" name="ffa_field"
                                       data-bs-original-title="" title="" id="ffa_field" @if($fa_field) checked="checked" @endif>
                                <label class="form-check-label" for="ffa_field">исползовать двух-факторную
                                    аутентификацию</label>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block" id="ffa_save">Применить изменения</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Пароль</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                                         data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Смените пароль на новый</label>
                                <input class="form-control" id="password_field" type="password" name="password">
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block" id="password_save">Сменить пароль</button>
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
        $(document).ready(() => {
            $("#password_save").click((e) => {
                e.preventDefault();

                $.ajax({
                    url: "{{route('accountPanel.settings.setPassword')}}",
                    type: 'post',
                    data: [
                        '#password_field'
                    ]
                        .map((val) => $(val).attr('name') + "=" + $(val).val())
                        .reduce((accum, next) => accum + "&" + next),
                    success: (response) => {
                        $.notify('<i class="fa fa-bell-o"></i><strong>Данные обновлены</strong> пароль был изменен', {
                            type: 'theme',
                            allow_dismiss: true,
                            delay: 2000,
                            showProgressbar: true,
                            timer: 300,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            }
                        });

                        $('#password_field').val('');
                    }
                })
            });

            $("#ffa_save").click((e) => {
                e.preventDefault();

                $.ajax({
                    url: "{{route('accountPanel.settings.set2FA')}}",
                    type: 'post',
                    data: 'ffa_field=' + $('#ffa_field').is(':checked'),
                    success: (response) => {
                        console.log(response);

                        if(response.result === 'redirect')
                            window.location.replace(response.to);

                        $.notify('<i class="fa fa-bell-o"></i><strong>Данные обновлены</strong> 2FA был изменен', {
                            type: 'theme',
                            allow_dismiss: true,
                            delay: 2000,
                            showProgressbar: true,
                            timer: 300,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            }
                        });
                    }
                })
            })
        });
    </script>
@endpush
