@extends('layouts.app')

@section('page_header')
    <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col text-white text-center">
                    <h1>SeoAnalyzer: анализатор страниц</h1>
                    <p class="lead">Это простой и удобный сервис по анализу веб-страниц на SEO пригодность</p>
                </div>  
            </div>
        </div>
    </div>
@endsection

@section('page_content')
    <div class="container">
        <div class="jumbotron">
            <h3>Анализ страницы</h1>
            <hr class="my-3">
            <form action="/domains" method="post">
                <div class="form-group">
                    <label for="page-url-input">Введите URL веб-страницы:</label>
                    <input type="text" name="name" class="form-control" id="page-url-input" placeholder="https://www.example.com" required>
                </div>
                <button type="submit" class="btn btn-primary">Анализировать</button>
            </form>                
        </div>
    </div>
@endsection