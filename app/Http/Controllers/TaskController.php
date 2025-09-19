<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
class TaskController extends Controller
{
  
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all'); 
        $query = Task::orderBy('order');
        if ($filter === 'completed') {
            $query->completed();
        } elseif ($filter === 'incomplete') {
            $query->incomplete();
        }
        $tasks = $query->get();
        return view('tasks.index', compact('tasks', 'filter'));
    }

   
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $maxOrder = Task::max('order') ?? 0;
        $data['order'] = $maxOrder + 1;
        Task::create($data);
        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

   
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $task->update($data);
        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

  
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

  
    public function toggle(Task $task)
    {
        $task->is_completed = ! $task->is_completed;
        $task->save();
        return response()->json(['success' => true, 'is_completed' => $task->is_completed]);
    }


    public function reorder(Request $request)
    {
        $order = $request->input('order'); 
        if (!is_array($order)) {
            return response()->json(['success' => false, 'message' => 'Invalid payload.'], 422);
        }
        foreach ($order as $index => $id) {
            Task::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
