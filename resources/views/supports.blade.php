@extends('auth.layout')

@section('content')
    <div class="container-fluid">
        <div>
            <a href="/admin/supports?answer=0" type="submit" class="btn @if(!$answer) btn-success @endif mt-4 mb-4 ml-5" style="width: 200px; color:white; @if($answer) background-color:grey @endif">Не прочитанные</a>
            <a href="/admin/supports?answer=1" type="submit" class="btn @if($answer) btn-success @endif  mt-4 mb-4 ml-5" style="width: 200px; color:white; @if(!$answer) background-color:grey @endif">Прочитанные</a>
        </div>
        <table class="table align-middle mb-0 bg-white border border-secondary">
            <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>От кого</th>
                <th>Описание</th>
                @if($answer)
                <th>Ответ</th>
                @endif
                <th>Создан</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($supports as $key => $support)
            <tr>
                <td>
                    <p class="fw-normal mb-1">{{$key}}</p>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{$support->email}}</p>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{$support->problem_description}}</p>
                </td>
                @if($answer)
                <td>
                    <p class="fw-normal mb-1">{{$support->answer_description}}</p>
                </td>
                @endif
                <td>
                    <p class="fw-normal mb-1">{{$support->created_at}}</p>
                </td>
                <td>
                    <a href="/admin/supports/{{$support->id}}" class="btn btn-primary" style="margin-top:30px">Изменить</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
