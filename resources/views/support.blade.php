@extends('auth.layout')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" style="align-content: center">
            <span style="display: table;margin: 0 auto;">{{ session()->get('success') }}</span>
        </div>
    @endif
    <div class="container" style="margin-top:20px">

        <form action="/admin/supports/{{$support->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example1" class="form-control" value="{{$support->email}}" disabled/>
                <label class="form-label" for="form4Example1">Почта отправителя</label>
            </div>

            <!-- problem description input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="form4Example3" rows="4" disabled>{{$support->problem_description}}</textarea>
                <label class="form-label" for="form4Example3">Описание</label>
            </div>

            <!-- answer description input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="form4Example3" name="answer_description" rows="4">{{$support->answer_description}}</textarea>
                <label class="form-label" for="form4Example3">Ваш ответ</label>
            </div>

            <!-- Submit button -->
            <div style="display: flex">
                <button type="submit" class="btn btn-primary mb-4" style="width: 200px;">Сохранить</button>
            </div>
        </form>
    </div>

@endsection
