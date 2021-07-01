<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->Sortbydesc('created_at');
        $tasks = Task::all()->Sortbydesc('created_at');

        return response()->json([
            'tasks' => $tasks,
            'users' => $users
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tasks = Task::all()->Sortbydesc('created_at');

        Task::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'status' => 0
        ]);

        $tasks = Task::where('user_id',$request->user_id)->get();

        User::find($request->user_id)->update([
            'task_count' => $tasks->count()
        ]);

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if ($task->status == 0) {
            $task->update([
                'status' => 1,
            ]);
        }

        else {
            $task->update([
                'status' => 0,
            ]);
        }


        $new_tasks = Task::all()->Sortbydesc('created_at');

        return response()->json([
            'tasks' => $new_tasks
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $task = Task::find($id);

        $task->delete();

        $tasks = Task::where('user_id',$task->user_id)->get();

        User::find($task->user_id)->update([
            'task_count' => $tasks->count()
        ]);

        $new_tasks = Task::all()->Sortbydesc('created_at');

        return response()->json([
            'tasks' => $new_tasks
        ], 200);
    }
}
