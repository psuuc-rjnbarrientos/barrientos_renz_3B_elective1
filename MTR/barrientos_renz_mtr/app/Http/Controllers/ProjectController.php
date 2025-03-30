<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    // Ensure user is logged in before accessing any function
    private function checkAuth()
    {
        if (!session()->has('user')) {
            return redirect()->route('login.show')->with('error', 'You must be logged in first.');
        }
        return null;
    }

    // 📌 Show all projects for the logged-in user
    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $user = session('user');

        // Fetch projects where the user is the creator OR assigned
        $projects = DB::table('projects')
            ->where('created_by', $user->id)
            ->orWhere('assigned_to', $user->id)
            ->get();

        return view('projects.index', compact('projects'));
    }

    // 📌 Show the create project form
    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        return view('projects.create');
    }

    // 📌 Store a new project in the database
    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high,critical',
            'assigned_to' => 'nullable|exists:users,id' // Ensure assigned user exists
        ]);

        $user = session('user');

        DB::table('projects')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'priority' => $request->input('priority'),
            'status' => 'pending', // Default status
            'created_by' => $user->id, // Set creator
            'assigned_to' => $request->input('assigned_to'), // Optional assignee
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    // 📌 Show the edit form for a project
    public function edit($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $project = DB::table('projects')->where('id', $id)->first();

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }

        return view('projects.edit', compact('project'));
    }

    // 📌 Update project details
    public function update(Request $request, $id)
    {
        // dd("Update function triggered!", $request->all());

        // if ($redirect = $this->checkAuth()) return $redirect;

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'start_date' => 'nullable|date',
        //     'end_date' => 'nullable|date|after_or_equal:start_date',
        //     'priority' => 'required|in:low,medium,high,critical',
        //     'status' => 'required|in:pending,in-progress,completed,archived',
        //     'assigned_to' => 'nullable|exists:users,id'
        // ]);

        // DB::table('projects')->where('id', $id)->update([
        //     'name' => $request->input('name'),
        //     'description' => $request->input('description'),
        //     'start_date' => $request->input('start_date'),
        //     'end_date' => $request->input('end_date'),
        //     'priority' => $request->input('priority'),
        //     'status' => $request->input('status'),
        //     'assigned_to' => $request->input('assigned_to'),
        //     'updated_at' => now()
        // ]);

        // return redirect()->route('projects.index')->with('success', 'Project updated successfully!');

        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$id]);

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }


        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high,critical',
        ]);

        // Update the project in the database
        $updated = DB::update("
        UPDATE projects 
        SET name = ?, description = ?, start_date = ?, end_date = ?, priority = ?, updated_at = NOW()
        WHERE id = ?
    ", [
            $request->input('name'),
            $request->input('description'),
            $request->input('start_date'),
            $request->input('end_date'),
            $request->input('priority'),
            $id
        ]);

        if ($updated) {
            return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
        } else {
            return redirect()->back()->with('error', 'No changes were made.');
        }
    }

    // 📌 Delete a project
    public function destroy($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        DB::table('projects')->where('id', $id)->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
}
