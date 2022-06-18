<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::query()
            ->when($request->has('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->get('search') . '%');
            })
            ->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('filepath')) {
            $file = $request->file('filepath');
            $data['file_extension'] = $file->extension();
            $data['filepath'] = $file->store('upload');

            // $file = $request->file('filepath');
            // $data['file_extension'] = $data['filepath']->extension();
            // $data['filepath'] = $data['filepath']->store('upload');
        }

        $data['finished'] = empty($data['finished']) ? 0 : $data['finished'];
        $data['user_id'] = Auth::user()->id;

        Task::create($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, $id)
    {
        $data = $request->validated();
        ray('data um', $data);
        $task = Task::findOrFail($id);
        $oldFile = $task->filepath;

        if ($request->hasFile('filepath')) {
            $file = $request->file('filepath');
            $data['file_extension'] = $file->extension();
            $data['filepath'] = $file->store('upload');

            // delete old file
            if ($oldFile) {
                Storage::delete($oldFile);
            }
        }

        $data['finished'] = empty($data['finished']) ? 0 : $data['finished'];
        ray('data dois', $data);
        $task->update($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $oldFile = $task->filepath;
        $task->delete();

        if ($oldFile) {
            Storage::delete($oldFile);
        }
        return redirect()->route('tasks.index');
    }
}
