@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('students.register') }}" style="margin-top: 20px;">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                <label for="st-first-name" class="col-xs-offset-1 control-label">Имя</label>
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <input id="st-first-name" type="text" name="firstName" class="form-control" placeholder="Имя" required value="{{ old('firstName', $student->firstName) }}">

                    @if ($errors->has('firstName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstName') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                <label for="st-last-name" class="col-xs-offset-1 control-label">Фамилия</label>
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <input id="st-last-name" type="text" name="lastName" class="form-control" placeholder="Фамилия" required value="{{ old('lastName', $student->lastName) }}">

                    @if ($errors->has('lastName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastName') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <p class="control-label"><b>Пол</b></p>
                    <div class="text-center">
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="1" checked> Мужской
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="0"> Женский
                        </label>
                    </div>

                    @if ($errors->has('sex'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sex') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('squad') ? ' has-error' : '' }}">
                <label for="st-squad" class="col-xs-offset-1 control-label">Группа</label>
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <input id="st-squad" type="text" name="squad" class="form-control" placeholder="Группа" required value="{{ old('squad', $student->squad) }}">

                    @if ($errors->has('squad'))
                        <span class="help-block">
                            <strong>{{ $errors->first('squad') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="st-mail" class="col-xs-offset-1 control-label">E-mail</label>
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <input id="st-mail" type="email" name="email" class="form-control" placeholder="E-mail" required value="{{ old('email', $student->email) }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
                <label for="st-points" class="col-xs-offset-1 control-label">Баллы ВНО</label>
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <input id="st-points" type="number" name="points" class="form-control" placeholder="Баллы" required min="0" max="300" value="{{ old('points', $student->points) }}">

                    @if ($errors->has('points'))
                        <span class="help-block">
                            <strong>{{ $errors->first('points') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('birth') ? ' has-error' : '' }}">
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <label for="st-date">Дата рождения</label>
                    <input id="st-date" type="date" class="form-control" name="birth" value="{{ old('birth', $student->birth) }}">

                    @if ($errors->has('birth'))
                        <span class="help-block">
                            <strong>{{ $errors->first('birth') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('foreign') ? ' has-error' : '' }}">
                <div class="col-sm-10 col-xs-10 col-xs-offset-1 input-group">
                    <p class="control-label"><b>Проживание</b></p>
                    <div class="text-center">
                        <label class="radio-inline">
                            <input type="radio" name="foreign" value="1" checked> Иногородний
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="foreign" value="0"> Местный
                        </label>
                        {{--<label class="radio-inline">--}}
                            {{--<input type="radio" name="foreign" value="2"> Тестовый вариант ответа--}}
                        {{--</label>--}}
                    </div>

                    @if ($errors->has('foreign'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foreign') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <input class="btn btn-primary pull-right" type="submit">
        </form>
    </div>
@endsection