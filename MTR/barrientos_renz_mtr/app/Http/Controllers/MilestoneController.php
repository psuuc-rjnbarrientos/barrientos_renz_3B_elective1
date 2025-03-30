<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class MilestoneController extends Controller
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

        $total = DB::selectOne("SELECT COUNT(*) as total FROM milestones WHERE project_id = ?", [$projectId])->total;

        $offset = ($page - 1) * $perPage;

        $milestones = DB::select("SELECT * FROM milestones WHERE project_id = ? LIMIT ? OFFSET ?", [$projectId, $perPage, $offset]);

        $paginatedMilestones = new LengthAwarePaginator(
            $milestones,      
            $total,             
            $perPage,           
            $page,               
            ['path' => route('milestones.index', $projectId)] 
        );

        // Use compact() to pass $paginatedMilestones, mirroring ProjectController
        return view('milestones.index', compact('project', 'paginatedMilestones'));
    }

    public function create($projectId)
    {
        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$projectId]);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found!');
        }

        return view('milestones.create', ['project' => $project[0]]);
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,reached,overdue',
        ]);

        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$projectId]);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found!');
        }

        DB::insert("
            INSERT INTO milestones (project_id, name, description, due_date, status, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            $projectId,
            $request->input('name'),
            $request->input('description'),
            $request->input('due_date'),
            $request->input('status'),
        ]);

        return redirect()->route('milestones.index', $projectId)->with('success', 'Milestone created successfully!');
    }

    public function edit($milestoneId)
    {
        $milestone = DB::select("SELECT * FROM milestones WHERE id = ?", [$milestoneId]);
        if (!$milestone) {
            return redirect()->route('projects.index')->with('error', 'Milestone not found!');
        }

        return view('milestones.edit', ['milestone' => $milestone[0]]);
    }

    public function update(Request $request, $milestoneId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,reached,overdue',
        ]);

        $milestone = DB::select("SELECT * FROM milestones WHERE id = ?", [$milestoneId]);
        if (!$milestone) {
            return redirect()->route('projects.index')->with('error', 'Milestone not found!');
        }

        DB::update("
            UPDATE milestones 
            SET name = ?, description = ?, due_date = ?, status = ?, updated_at = NOW()
            WHERE id = ?
        ", [
            $request->input('name'),
            $request->input('description'),
            $request->input('due_date'),
            $request->input('status'),
            $milestoneId,
        ]);

        return redirect()->route('milestones.index', $milestone[0]->project_id)->with('success', 'Milestone updated successfully!');
    }

    public function destroy($milestoneId)
    {
        $milestone = DB::select("SELECT * FROM milestones WHERE id = ?", [$milestoneId]);
        if (!$milestone) {
            return redirect()->route('projects.index')->with('error', 'Milestone not found!');
        }

        DB::delete("DELETE FROM milestones WHERE id = ?", [$milestoneId]);

        return redirect()->back()->with('success', 'Milestone deleted successfully!');
    }
}