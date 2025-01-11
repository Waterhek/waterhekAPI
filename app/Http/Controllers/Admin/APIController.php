<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API;

class APIController extends Controller
{
    public function index()
    {
        $apis = API::latest();

        return view('admin.api.index', compact('apis'));
    }

    public function create()
    {
        return view('admin.api.create');
    }

    public function store(Request $request)
    {
        API::create($request->all());
        
        return redirect()->route('admin.api.index');
    }
}
