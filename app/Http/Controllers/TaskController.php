<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Get ALL Data
    public function getAllData()
    {
        $task_data = Task::get();
        return view('get_all_data', ['task_data' => $task_data]);
    }
    // show create Form
    public function createForm()
    {
        return view('createForm');
    }
    // create and store the data in DB
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::create($validatedData);

        // Assuming you have a route named 'tasks.index' to view a single task
        $url = route('tasks.index', ['task' => $task->id]);

        // Return the URL as a JSON response
        return response()->json(['url' => $url]);
    }

    // show create Form
    public function edit($id)
    {
        $data_list = Task::find($id);
        return view('editForm', ['dataList' => $data_list]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data_finded = Task::find($id);
        // updating here;
        $data_finded->update($validatedData);


        if (!$data_finded) {
            // Task not found, return an error response
            return response()->json(['error' => 'Task not found'], 404);
        }

        // Update the task
        $data_finded->update($validatedData);

        // Assuming you have a route named 'tasks.index' to view a single task
        $url = route('tasks.index');

        // Return the URL as a JSON response

        return response()->json([
            'url' => $url,
            'message' => 'Task updated successfully'
        ]);
    }


    // tasks.destroy
    public function delete($id)
    {
        $delete_data = Task::find($id);
        $delete_data->delete();

        // You can return a JSON response or any other response you need
        // return response()->json(['message' => 'Task deleted successfully']);
        return back();
    }
}
