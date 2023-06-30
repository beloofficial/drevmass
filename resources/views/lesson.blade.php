@extends('auth.layout')

@section('content')
    <div class="container" style="margin-top:20px">
        @if(session()->has('success'))
            <div class="alert alert-success" style="align-content: center">
                <span style="display: table;margin: 0 auto;">{{ session()->get('success') }}</span>
            </div>
        @endif
        <form action="/admin/lessons/{{$lesson->id ?? 'create/new'}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example1" class="form-control" name="name" value="{{$lesson->name ?? ''}}"/>
                <label class="form-label" for="form4Example1">Название</label>
                @if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- title input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example2" class="form-control" name="title" value="{{$lesson->title ?? ''}}"/>
                <label class="form-label" for="form4Example2">Заголовок</label>
                @if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- description input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="form4Example3" name="description" rows="4">{{$lesson->description ?? ''}}</textarea>
                <label class="form-label" for="form4Example3">Описание</label>
                @if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- image input -->
            <div style="border: 1px solid #ced4da; padding: 15px; width: 500px">
                <div class="d-flex" style="width: 200px; height: 200px; margin: 0 auto 20px auto; justify-content: center;">
                    <img src="{{ URL::to('/') }}/{{$lesson->image_src ?? ''}}" id="image-preview" style="width: fit-content; margin: 0 auto; @if(!isset($lesson)) display:none @endif"/>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary btn-rounded" onclick="openModal(event)">
                        <label class="form-label text-white m-1" for="customFile1">Выберите файл</label>
                        <input type="file" class="form-control d-none" id="customFile1" name="image" onchange="previewImage(event)"/>
                    </div>
                </div>
            </div>@if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            <br>

            <!-- Video input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example2" class="form-control" name="video_src" value="{{$lesson->video_src ?? ''}}"/>
                <label class="form-label" for="form4Example2">Ссылка на видео</label>@if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- Duration input -->
            <div class="form-outline mb-4">
                <div style="display: flex">
                    <input style="width: 100px; text-align: center" type="number" id="minute" class="form-control" value="{{(int) (($lesson->duration ?? 0) / 60)}}" oninput="limitInputSymbols(this, 23)"/>
                    <input style="width: 100px; text-align: center" type="number" id="second" class="form-control" value="{{($lesson->duration ?? 0) % 60}}" oninput="limitInputSymbols(this, 59)"/>
                    <input id="duration" name="duration" hidden>
                </div>

                <label class="form-label" for="form4Example2">Длительность видео</label>
            </div>

            <!-- Submit button -->
            <div style="display: flex">
                <button onclick="convertAndAssignDuration(event)" type="submit" class="btn btn-primary mb-4" style="width: 200px;">Сохранить</button>
                @if(isset($lesson))
                <a href="/admin/lessons/{{$lesson->id ?? 0}}/delete" type="submit" class="btn btn-danger mb-4" style="width: 200px; margin-left: auto; color:white">Удалить</a>
                @endif
            </div>
        </form>
    </div>
    <script>
        function openModal(event) {
            console.log(event.target.tagName);
            if (event.target.tagName !== 'INPUT' && event.target.tagName !== 'LABEL') {
                console.log(1);
                var fileInput = document.getElementById('customFile1');
                fileInput.click();
            }

        }
        function limitInputSymbols(input, maxSymbols) {
            input.value = input.value.replace(/\D/g, '');
            if (input.value > maxSymbols) {
                input.value = maxSymbols;
            }
        }

        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').style.display = "block";
                    document.getElementById('image-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function convertAndAssignDuration(event) {
            event.preventDefault();
            var minuteInput = document.getElementById('minute');
            var secondInput = document.getElementById('second');
            var durationInput = document.getElementById('duration');

            var minutes = parseInt(minuteInput.value);
            var seconds = parseInt(secondInput.value);

            durationInput.value = minutes * 60 + seconds;

            document.getElementById('form').submit();
        }
    </script>
@endsection
