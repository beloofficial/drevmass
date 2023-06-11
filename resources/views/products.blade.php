@extends('auth.layout')

@section('content')
    <div>
        <a href="/admin/products/create/new" type="submit" class="btn btn-success mt-4 mb-4 ml-5" style="width: 200px; color:white">Создать продукт</a>
    </div>
    <table class="table align-middle mb-0 bg-white border border-secondary">
        <thead class="bg-light">
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Заголовок</th>
            <th>Видео</th>
            <th>Цена</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td>
                <p class="fw-normal mb-1">{{$key}}</p>
            </td>
            <td>
                <p class="fw-normal mb-1">{{$product->name}}</p>
            </td>
            <td>
                <p class="fw-normal mb-1">{{$product->title}}</p>
            </td>
            <td>
                <iframe width="200" height="100"
                        src="{{$product->video_src}}">
                </iframe>
            </td>
            <td>
                <p class="fw-normal mb-1">{{$product->price}}</p>
            </td>
            <td>
                <p class="fw-normal mb-1">{{$product->status ? "Включен" : "Выключен"}}</p>
            </td>
            <td>
                <a href="/admin/products/{{$product->id}}" class="btn btn-primary" style="margin-top:30px">Изменить</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
