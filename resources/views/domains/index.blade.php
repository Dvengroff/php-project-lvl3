@extends('layouts.app')

@section('title', 'Список страниц')

@section('page_content')
    <div class="container">
        <div class="jumbotron">
            <h1>Список загруженных страниц</h1>
            <hr class="my-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">URL страницы</th>
                        <th scope="col">Добавлена</th>
                        <th scope="col">Обновлена</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($domains as $domain)
                        <tr>
                            <th scope="row">{{$domain->id}}</th>
                            <td>
                                <a href="{{route('domains.show', ['id' => $domain->id])}}">{{$domain->name}}</a>
                            </td>
                            <td>{{$domain->created_at}}</td>
                            <td>{{$domain->updated_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>                
        </div>
    </div>
@endsection