@extends('auth.layout')

@section('content')
    <div style="margin-left: 200px;margin-right: 200px; margin-top:20px">

        <form action="/admin/products/{{$product->id ?? 'create/new'}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example1" class="form-control" name="name" value="{{$product->name ?? ''}}"/>
                <label class="form-label" for="form4Example1">Название</label>
                @if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- title input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example2" class="form-control" name="title" value="{{$product->title ?? ''}}"/>
                <label class="form-label" for="form4Example2">Заголовок</label>
                @if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- description input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="form4Example3" name="description" rows="4">{{$product->description ?? ''}}</textarea>
                <label class="form-label" for="form4Example3">Описание</label>
                @if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- image input -->
            <div style="border: 1px solid #ced4da; padding: 15px; width: 200px">
                <div class="mb-4 d-flex justify-content-center">
                    <img src="{{ URL::to('/') }}/{{$product->image_src ?? ''}}" id="image-preview" style="width: 700px; @if(!isset($product)) display:none @endif"/>
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
                <input type="text" id="form4Example2" class="form-control" name="video_src" value="{{$product->video_src ?? ''}}"/>
                <label class="form-label" for="form4Example2">Ссылка на видео</label>@if($errors->has('name')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- Price input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example2" class="form-control" name="price" value="{{$product->price ?? ''}}"/>
                <label class="form-label" for="form4Example2">Цена</label>
                @if($errors->has('price')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- Weight input -->
            <div class="form-outline mb-4">
                <input type="text" id="form4Example2" class="form-control" name="weight" value="{{$product->weight ?? ''}}"/>
                <label class="form-label" for="form4Example2">Вес</label>
                @if($errors->has('weight')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- Size input -->
            <div class="form-outline mb-4">
                <div style="display: flex">
                    <input style="width: 100px; text-align: center" type="number" id="length" name="length" class="form-control" value="{{$product->length ?? ''}}" />
                    <input style="width: 100px; text-align: center" type="number" id="height" name="height" class="form-control" value="{{$product->height ?? ''}}" />
                </div>

                <label class="form-label" for="form4Example2">Длина/Высота</label>
            </div>

            <!-- Weight input -->
            <div class="form-check mb-4" >
                <input class="form-check-input" style="width: 30px;height: 30px" type="checkbox" id="flexSwitchCheckDefault"
                       {{isset($product) ? ($product->status ? "checked" : "") : "checked"}} name="status" value="{{$product->status ?? 1}}">
                <label class="form-check-label" style="font-size: 18px; margin-left: 25px; margin-top:5px" for="flexSwitchCheckDefault">Статус</label>
                @if($errors->has('status')) <label class="form-label" for="form4Example1" style="color:red">Заполните поле</label> @endif
            </div>

            <!-- Submit button -->
            <div style="display: flex">
                <button type="submit" class="btn btn-primary mb-4" style="width: 200px;">Сохранить</button>
                @if(isset($product))
                <a href="/admin/products/{{$product->id ?? 0}}/delete" type="submit" class="btn btn-danger mb-4" style="width: 200px; margin-left: auto; color:white">Удалить</a>
                @endif
            </div>
        </form>
    </div>
    <script>
        $('input[type="checkbox"]').change(function(){
            this.value = (Number(this.checked));
        });

        function openModal(event) {
            if (event.target.tagName !== 'INPUT' && event.target.tagName !== 'LABEL') {
                console.log(1);
                var fileInput = document.getElementById('customFile1');
                fileInput.click();
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
    </script>
@endsection
