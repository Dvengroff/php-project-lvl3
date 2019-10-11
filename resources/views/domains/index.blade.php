@extends('layouts.app')

@section('title')
    @lang('main.nav.list')
@endsection

@section('page_content')
    <div class='jumbotron jumbotron-fluid bg-dark py-2 mb-3'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-7 col-md-9 col-sm-12 text-white'>
                    <h1>@lang('main.nav.list')</h1>
                    <hr class="my-3 mx-md-5 bg-secondary">
                    <p class="text-white-50 mb-2 mx-md-5">
                        @lang('main.list_description')
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mx-md-5 mx-sm-2 mb-3 p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('domain.id')</th>
                    <th scope="col">@lang('domain.name')</th>
                    <th scope="col">@lang('domain.state')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($domains as $domain)
                    <tr>
                        <th scope="row">{{$domain->id}}</th>
                        <td>
                            <a href="{{route('domains.show', ['id' => $domain->id])}}">{{$domain->name}}</a>
                        </td>
                        <td>                            
                            @switch($domain->state)
                                @case('init')
                                    <span class="badge badge-primary">
                                        @lang('domain.state_message.init')
                                    </span>
                                    @break
                                @case('completed')
                                    <span class="badge badge-success">
                                        @lang('domain.state_message.completed')
                                    </span>
                                    @break
                                @case('failed')
                                    <span class="badge badge-danger">
                                        @lang('domain.state_message.failed')
                                    </span>
                                    @break
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mx-auto">
            {{$domains->links()}}
        </div>
    </div>
@endsection