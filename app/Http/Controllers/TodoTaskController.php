<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoTask;
use App\Services\GenshinImpactService;
use App\Models\GenshinEvent;

class TodoTaskController extends Controller
{
    public function index()
    {
        $todo_tasks = TodoTask::all();

        return response()->json($todo_tasks, 201);
    }

    public function store(Request $request)
    {
        $todo_task = TodoTask::create($request->all());
        return response()->json($todo_task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $service = new GenshinImpactService();

        $events = GenshinEvent::all();

        return response()->json($events, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
