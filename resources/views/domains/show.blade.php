@extends('layouts.app')

@section('title')
    @lang('main.analysis')
@endsection

@section('page_content')
    <div class='jumbotron jumbotron-fluid bg-dark py-2 mb-3'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-7 col-md-9 col-sm-12 text-white'>
                    <h1>@lang('main.analysis')</h1>
                    <hr class="my-3 mx-md-5 bg-secondary">
                    <p class="lead text-primary font-weight-bold mb-2 mx-md-5"><u>{{$domain->name}}</u></p>
                    <p class="lead mb-2 mx-md-5">
                        <span class="mr-2">@lang('domain.state'):</span>
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
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if ($domain->state === "init")
        <div class="alert alert-info mx-md-5 mx-sm-2 mb-3 p-3" role="alert">
            @lang('main.analysis_message')
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
                        <td>@lang('domain.created_at')</td>
                        <td>{{$domain->created_at}}</td>
                    </tr>
                    <tr>
                        <td>@lang('domain.status')</td>
                        <td>{{$domain->status ?? __('domain.null')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('domain.content_length')</td>
                        <td>{{$domain->content_length ?? __('domain.null')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('domain.h1')</td>
                        <td>{{$domain->h1 ?? __('domain.null')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('domain.keywords')</td>
                        <td>{{$domain->keywords ?? __('domain.null')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('domain.description')</td>
                        <td>{{$domain->description ?? __('domain.null')}}</td>
                    </tr>
                </tbody>
            </table>                
        </div>
    @endif
@endsection