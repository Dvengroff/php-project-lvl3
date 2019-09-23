<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;

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
        // добавить валидацию данных формы

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
