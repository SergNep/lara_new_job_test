<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Отображение списка всех задач пользователя.
     *
    * @param  Request  $request
    * @return Response
    */
    public function index(Request $request)
    {
        return view('tasks.index');
    }

    /**
     * Создание новой задачи.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        //echo get_class($request); exit;

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);


        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        $tasks = Task::where('user_id', $request->user()->id)->get();

        return redirect('/tasks',
            'tasks' => $tasks);

        // Создание задачи...
    }




}
