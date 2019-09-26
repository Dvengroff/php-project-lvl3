@extends('layouts.app')

@section('title', 'Анализ страницы')

@section('page_content')
    <div class="container">
        <div class="jumbotron">
            <h1>Анализ страницы</h1>
            <hr class="my-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">URL страницы</th>
                        <th scope="col">Код ответа</th>
                        <th scope="col">Длина тела</th>
                        <th scope="col">Добавлена</th>
                        <th scope="col">Обновлена</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$domain->id}}</th>
                        <td>{{$domain->name}}</td>
                        <td>{{$domain->status}}</td>
                        <td>{{$domain->content_length}}</td>
                        <td>{{$domain->created_at}}</td>
                        <td>{{$domain->updated_at}}</td>
                    </tr>
                </tbody>
            </table>                
        </div>
    </div>
@endsection