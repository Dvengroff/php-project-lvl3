<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Jobs\AnalyzeDomainJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
        $url = route('domains.index');
        Log::info("Boot {$url} page");
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
                'required' => 'Поле с URL не может оставаться пустым!',
                'url' => 'Введеный URL не является корректным!',
                'unique' => 'Страница с введенным URL уже анализировалась и находится в базе сервиса!'
            ]
        );
        if ($validator->fails()) {
            Log::info("Enter invalid input data");
            $errors = $validator->errors()->all();
            return response(view('index', compact('errors')), 422);
        }

        $domainUrl = $request->input('url');
        $domain = Domain::create(['name' => $domainUrl]);
        dispatch(new AnalyzeDomainJob($domain));
        Log::info("Domain analysis init");
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);
        $url = route('domains.show', compact('id'));
        Log::info("Boot {$url} page");
        return view('domains.show', compact('domain'));
    }
}
