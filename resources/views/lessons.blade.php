@extends('auth.layout')

@section('content')
    <div>
        <a href="/admin/lessons/create/new" type="submit" class="btn btn-success mt-4 mb-4 ml-5" style="width: 200px; color:white">Создать урок</a>
    </div>
    <table class="table align-middle mb-0 bg-white border border-secondary">
        <thead class="bg-light">
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Заголовок</th>
            <th>Видео</th>
            <th>Длительность</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lessons as $key => $lesson)
        <tr>
            <td>
                <p class="fw-normal mb-1">{{$key}}</p>
            </td>
            <td>
                <p class="fw-normal mb-1">{{$lesson->name}}</p>
            </td>
            <td>
                <p class="fw-normal mb-1">{{$lesson->title}}</p>
            </td>
            <td>
                <iframe width="200" height="100"
                        src="https://www.youtube.com/embed/{{$lesson->video_src}}">
                </iframe>
            </td>
            <td>
                <p class="fw-normal mb-1">{{(int)($lesson->duration / 60)}}:{{$lesson->duration % 60}}{{$lesson->duration % 60 == 0 ? 0 : ''}} мин</p>
            </td>
            <td>
                <a href="/admin/lessons/{{$lesson->id}}" class="btn btn-primary" style="margin-top:30px">Изменить</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
