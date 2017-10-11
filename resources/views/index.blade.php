@extends('layouts.app')

@section('title'){{ 'Главная | Список студентов' }}@endsection
@section('description'){{ 'Главная страница тестового задания для Ant House. Список студентов.' }}@endsection

@section('stylesheets')
    <style>
        .student {
            cursor: pointer;
        }

        .dl-fix-a:hover, .dl-fix-a:active, .dl-fix-a:visited {
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @if(isset($sort))
                        <th>
                            <a class="dl-fix-a" href="{{ route('students.sort', [
                                    'column' => 'firstName',
                                    'direction' => $sort->column == 'firstName' ? ($sort->direction == 'asc' ? 'desc' : 'asc') : 'asc'
                                ]) }}">
                                Имя @if($sort->column == 'firstName')
                                    {!! "<i class='fa fa-caret-square-o-" . ($sort->direction == 'asc' ? 'up' : 'down') . "' aria-hidden='true'></i>" !!}
                                @endif</a>
                        </th>
                        <th>
                            <a class="dl-fix-a" href="{{ route('students.sort', [
                                    'column' => 'lastName',
                                    'direction' => $sort->column == 'lastName' ? ($sort->direction == 'asc' ? 'desc' : 'asc') : 'asc'
                                ]) }}">
                                Фамилия @if($sort->column == 'lastName')
                                    {!! "<i class='fa fa-caret-square-o-" . ($sort->direction == 'asc' ? 'up' : 'down') . "' aria-hidden='true'></i>" !!}
                                @endif</a>
                        </th>
                        <th>
                            <a class="dl-fix-a" href="{{ route('students.sort', [
                                    'column' => 'squad',
                                    'direction' => $sort->column == 'squad' ? ($sort->direction == 'asc' ? 'desc' : 'asc') : 'asc'
                                ]) }}">
                                № группы @if($sort->column == 'squad')
                                    {!! "<i class='fa fa-caret-square-o-" . ($sort->direction == 'asc' ? 'up' : 'down') . "' aria-hidden='true'></i>" !!}
                                @endif</a>
                        </th>
                        <th>
                            <a class="dl-fix-a" href="{{ route('students.sort', [
                                    'column' => 'points',
                                    'direction' => $sort->column == 'points' ? ($sort->direction == 'desc' ? 'asc' : 'desc') : 'desc'
                                ]) }}">
                                Баллов @if($sort->column == 'points')
                                    {!! "<i class='fa fa-caret-square-o-" . ($sort->direction == 'desc' ? 'up' : 'down') . "' aria-hidden='true'></i>" !!}
                                @endif</a>
                        </th>
                        @else
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>№ группы</th>
                            <th>Баллов <i class="fa fa-caret-square-o-up" aria-hidden="true"></i></th>
                        @endif
                    </tr>
                </thead>
            @isset($students)
                @foreach($students as &$student)
                    <tr class="student">
                        <input type="hidden" value="{{ $student->id }}">
                        <th scope="row">{{ $student->firstName }}</th>
                        <td>{{ $student->lastName }}</td>
                        <td>{{ $student->squad }}</td>
                        <td>{{ $student->points }}</td>
                    </tr>
                @endforeach
            @endisset
            </table>
        </div>
        <div class="center-block text-center">{{ $students->links() }}</div>
    </div>
    <div id="student" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="student-head" class="modal-title"> Имя фамилия</h4>
                </div>
                <div class="modal-body">
                    <p id="student-id">Идентификационный номер: <span></span></p>
                    <p id="student-sex">Пол: <span></span></p>
                    <p id="student-email">E-mail: <span></span></p>
                    <p id="student-birth">Дата рождения: <span></span></p>
                    <p id="student-squad">Группа: <span></span></p>
                    <p id="student-foreign">Проживание: <span></span></p>
                    <p id="student-points">Количество баллов: <span></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var modal_body = $('#student').modal('hide');
            var modal = {
                header: $(modal_body).find('#student-head'),
                id: $(modal_body).find('#student-id').find('span'),
                sex: $(modal_body).find('#student-sex').find('span'),
                email: $(modal_body).find('#student-email').find('span'),
                birth: $(modal_body).find('#student-birth').find('span'),
                squad: $(modal_body).find('#student-squad').find('span'),
                foreign: $(modal_body).find('#student-foreign').find('span'),
                points: $(modal_body).find('#student-points').find('span')
            };

            $('.student').on('click', function (e) {
                var id = $(e.currentTarget).find('input').val();

                $.get('/' + id, function (response) {
                    modal.header.empty().append(response.firstName + " " + response.lastName);
                    modal.id.empty().append(id);
                    modal.sex.empty().append(response.sex ? "мужской" : "женский");
                    modal.email.empty().append(response.email);
                    modal.birth.empty().append(response.birth);
                    modal.squad.empty().append(response.squad);
                    modal.foreign.empty().append(response.foreign ? (response.sex ? "иногородний" : "иногородняя") : (response.sex ? "местный" : "местная"));
                    modal.points.empty().append(response.points);

                    modal_body.modal();
                });
            });
        });
    </script>
@endsection