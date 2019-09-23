<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
            $errors = $validator->errors()->all();
            return response(view('index', compact('errors')), 422);
        }
        $url = $request->input('url');
        $domain = Domain::create(['name' => $url]);
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);
        return view('domains.show', compact('domain'));
    }
}
