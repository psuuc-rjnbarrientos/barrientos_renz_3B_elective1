<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskController extends Controller
{
    public function index($projectId, Request $request)
    {
        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$projectId]);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found!');
        }
        $project = $project[0];

        $perPage = 10;
        $page = $request->get('page', 1);

        $total = DB::selectOne("SELECT COUNT(*) as total FROM tasks WHERE project_id = ?", [$projectId])->total;

        $offset = ($page - 1) * $perPage;

        $tasks = DB::select("SELECT * FROM tasks WHERE project_id = ? LIMIT ? OFFSET ?", [$projectId, $perPage, $offset]);

        $paginatedTasks = new LengthAwarePaginator(
            $tasks,
            $total,
            $perPage,
            $page,
            ['path' => route('tasks.index', $projectId)]
        );
        return view('tasks.index', compact('project', 'paginatedTasks'));
    }

    // Show form to create a new task
    public function create($projectId)
    {
        // Check if project exists
        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$projectId]);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found!');
        }

        return view('tasks.create', ['project' => $project[0]]);
    }

    // Store a new task in the database
    public function store(Request $request, $projectId)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in-progress,completed,blocked',
        ]);

        // Ensure project exists before adding a task
        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$projectId]);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found!');
        }

        // For now, hardcode a user ID (e.g., 1) or get it from session if available
        $createdBy = 1; // Replace this with actual logic to get the user ID if possible

        // Insert task into database, including created_by
        DB::insert("
            INSERT INTO tasks (project_id, title, description, due_date, status, created_by, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            $projectId,
            $request->input('title'),
            $request->input('description'),
            $request->input('due_date'),
            $request->input('status'),
            $createdBy, // Add the created_by value here
        ]);

        return redirect()->route('tasks.index', $projectId)->with('success', 'Task created successfully!');
    }

    // Show edit task form
    public function edit($taskId)
    {
        // Fetch task from database
        $task = DB::select("SELECT * FROM tasks WHERE id = ?", [$taskId]);

        if (!$task) {
            return redirect()->route('projects.index')->with('error', 'Task not found!');
        }

        return view('tasks.edit', ['task' => $task[0]]);
    }

    // Update task in the database
    public function update(Request $request, $taskId)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in-progress,completed,blocked',
        ]);

        // Ensure task exists before updating
        $task = DB::select("SELECT * FROM tasks WHERE id = ?", [$taskId]);

        if (!$task) {
            return redirect()->route('projects.index')->with('error', 'Task not found!');
        }

        // Update task in database
        DB::update("
            UPDATE tasks 
            SET title = ?, description = ?, due_date = ?, status = ?, updated_at = NOW()
            WHERE id = ?
        ", [
            $request->input('title'),
            $request->input('description'),
            $request->input('due_date'),
            $request->input('status'),
            $taskId,
        ]);

        return redirect()->route('tasks.index', $task[0]->project_id)->with('success', 'Task updated successfully!');
    }

    // Delete a task
    public function destroy($taskId)
    {
        // Ensure task exists
        $task = DB::select("SELECT * FROM tasks WHERE id = ?", [$taskId]);

        if (!$task) {
            return redirect()->route('projects.index')->with('error', 'Task not found!');
        }

        // Delete the task
        DB::delete("DELETE FROM tasks WHERE id = ?", [$taskId]);

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }
}
