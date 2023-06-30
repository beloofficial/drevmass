@extends('auth.layout')

@section('content')
    <div class="container" style="margin-top:20px">

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
            <div style="border: 1px solid #ced4da; padding: 15px; width: 500px">
                <div class="d-flex" style="width: 200px; height: 200px; margin: 0 auto 20px auto; justify-content: center;">
                    <img src="{{ URL::to('/') }}/{{$product->image_src ?? ''}}" id="image-preview" style="width: fit-content; margin: 0 auto; @if(!isset($product)) display:none @endif"/>
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
                    <input style="width: 100px; text-align: center" id="length" name="length" class="form-control" value="{{$product->length ?? ''}}" />
                    <input style="width: 100px; text-align: center" id="height" name="height" class="form-control" value="{{$product->height ?? ''}}" />
                    <input style="width: 100px; text-align: center" id="depth" name="depth" class="form-control" value="{{$product->depth ?? ''}}" />
                </div>

                <label class="form-label" for="form4Example2">Длина/Высота/Ширина</label>
            </div>

            <!-- Size input -->
            <div class="form-outline mb-4" style="border: 1px solid #b9b9b9; padding: 15px 0px 0px 0px; width: fit-content; border-radius: 7px">
                <div style="display: flex">
                    <input style="width: 100px; text-align: center" type="radio" name="icon" class="form-control" value="" @if(!isset($product) || $product->icon !== 'star' && $product->icon !== 'fire') checked @endif/>
                    <input style="width: 100px; text-align: center" type="radio" name="icon" class="form-control" value="star" @if(isset($product) && $product->icon === 'star') checked @endif/>
                    <input style="width: 100px; text-align: center" type="radio" name="icon" class="form-control" value="fire" @if(isset($product) && $product->icon === 'fire') checked @endif/>
                </div>
                <div style="display: flex">
                    <label style="width: 100px; text-align: center">Пусто</label>
                    <label style="width: 100px; text-align: center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-fire" viewBox="0 0 16 16">
                            <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z"/>
                        </svg></label>
                    <label style="width: 100px; text-align: center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg></label>
                </div>

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
