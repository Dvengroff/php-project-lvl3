@extends('layouts.app')

@section('title', 'Анализ страницы')

@section('page_content')
    <div class='jumbotron jumbotron-fluid bg-dark py-2 mb-3'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-7 col-md-9 col-sm-12 text-white'>
                    <h1>Анализ страницы</h1>
                    <hr class="my-3 mx-md-5 bg-secondary">
                    <p class="lead text-primary font-weight-bold mb-2 mx-md-5"><u>{{$domain->name}}</u></p>
                    <p class="lead mb-2 mx-md-5">
                        <span class="mr-2">Статус:</span>
                        @switch($domain->state)
                            @case('init')
                                <span class="badge badge-primary">
                                    выполняется
                                </span>
                                @break
                            @case('completed')
                                <span class="badge badge-success">
                                    выполнен успешно
                                </span>
                                @break
                            @case('failed')
                                <span class="badge badge-danger">
                                    выполнить не удалось
                                </span>
                                @break
                        @endswitch
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if ($domain->state === "init")
        <div class="alert alert-info mx-md-5 mx-sm-2 mb-3 p-3" role="alert">
            Выполняется запрос к веб-странице. Пожалуйста, подождите...
        </div>
        <script>
            setTimeout(function(){
                location.reload();
            }, 2000);
        </script>
    @else
        <div class="card mx-md-5 mx-sm-2 mb-3 p-3">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Дата</td>
                        <td>{{$domain->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Код ответа</td>
                        <td>{{$domain->status ?? "данные отсутствуют"}}</td>
                    </tr>
                    <tr>
                        <td>Длина тела</td>
                        <td>{{$domain->content_length ?? "данные отсутствуют"}}</td>
                    </tr>
                    <tr>
                        <td>Заголовок</td>
                        <td>{{$domain->h1 ?? "данные отсутствуют"}}</td>
                    </tr>
                    <tr>
                        <td>Ключевые слова</td>
                        <td>{{$domain->keywords ?? "данные отсутствуют"}}</td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>{{$domain->description ?? "данные отсутствуют"}}</td>
                    </tr>
                </tbody>
            </table>                
        </div>
    @endif
@endsection