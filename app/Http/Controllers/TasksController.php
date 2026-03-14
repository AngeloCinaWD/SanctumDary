<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(TasksResource::collection(Task::where('user_id', Auth::user()->id)->latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $task = Task::create([
            'user_id' => Auth::user()->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'priority' => $data['priority'] ?? 'medium',
        ]);

        return $this->success(new TasksResource($task), 'Task created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$task) {
            return $this->error('', 'Task not found', 404);
        }

        return $this->success(new TasksResource($task));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$task) {
            return $this->error('', 'Task not found', 404);
        }

        $task->update($request->validated());

        return $this->success(new TasksResource($task), 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$task) {
            return $this->error('', 'Task not found', 404);
        }

        $task->delete();

        return $this->success('', 'Task deleted successfully');
    }
}
