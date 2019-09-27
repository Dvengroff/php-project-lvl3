<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Barryvdh\Debugbar\Facade as Debugbar;


class DomainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $domains = Domain::paginate(10);
        Log::info('Boot domain.index page');
        if (env('APP_DEBUG')) {
            Debugbar::debug('Boot domain.index page');
        }
        return view('domains.index', compact('domains'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'url' => 'required|url|unique:domains,name'
            ],
            [
                'required' => 'Пожалуйста, заполните поле с URL веб-страницы!',
                'url' => 'Введеный URL не является допустимым!',
                'unique' => 'Введенный URL уже находится в базе сервиса!'
            ]
        );
        if ($validator->fails()) {
            Log::info('Invalid input data');
            if (env('APP_DEBUG')) {
                Debugbar::debug('Invalid input data');
            }
            $errors = $validator->errors()->all();
            return response(view('index', compact('errors')), 422);
        }

        $url = $request->input('url');
        $client = app('HttpClient');
        $response = $client->get($url);
        
        $status = $response->getStatusCode();
        $contentLength = $response->getHeader('Content-Length')[0] ?? null;
        $bodyString = (string) $response->getBody();
        $domain = Domain::create(
            [
                'name' => $url,
                'status' => $status,
                'content_length' => $contentLength,
                'body' => $bodyString,
            ]
        );
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);
        Log::info('Boot domain.show page');
        if (env('APP_DEBUG')) {
            Debugbar::debug('Boot domain.show page');
        }
        return view('domains.show', compact('domain'));
    }
}
