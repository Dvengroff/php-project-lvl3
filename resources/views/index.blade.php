@extends('layouts.app')

@section('page_content')
    <div class='jumbotron jumbotron-fluid bg-dark py-4'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-7 col-md-9 col-sm-12 text-white'>
                    <h1>@lang('main.name')</h1>
                    <p class='text-white-50'>@lang('main.description')</p>
                    <hr class="my-4 mx-md-5 bg-secondary">
                    <form action="{{route('domains.store')}}" method="post" class="mx-md-5">
                        <div class="form-group">
                            <label for="page-url-input">@lang('main.form.message')</label>
                            <input type="text" name="url" class="form-control" id="page-url-input" placeholder="https://www.example.com" required>
                        </div>
                        @if (isset($errors))
                            @foreach ($errors as $error)
                                <div class="alert alert-warning mt-n2 mb-2 py-1" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                        <button type="submit" class="btn btn-primary">@lang('main.form.submit')</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
@endsection