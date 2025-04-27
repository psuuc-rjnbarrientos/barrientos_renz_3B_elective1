<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Search by first name, last name, or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by degree
        if ($request->filled('degree')) {
            $query->where('degree', 'like', "%{$request->input('degree')}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by date of birth range
        if ($request->filled('min_date_of_birth')) {
            $query->where('date_of_birth', '>=', $request->input('min_date_of_birth'));
        }
        if ($request->filled('max_date_of_birth')) {
            $query->where('date_of_birth', '<=', $request->input('max_date_of_birth'));
        }

        // Paginate results
        $students = $query->paginate(10)->appends($request->query());

        // Add QR code with JSON data to each student
        $students->getCollection()->transform(function ($student) {
            $student->qr = QrCode::size(100)->generate(
                json_encode([
                    'student_id' => $student->student_id,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'email' => $student->email,
                    'date_of_birth' => $student->date_of_birth?->format('Y-m-d'),
                    'degree program' => $student->degree,
                    'status' => $student->status,
                ])
            );
            return $student;
        });

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'date_of_birth' => 'nullable|date',
            'degree' => 'required|string|max:255',
            'status' => 'required|in:graduate,undergraduate',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $qr = QrCode::size(200)->generate(
            json_encode([
                'student_id' => $student->student_id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'email' => $student->email,
                'date_of_birth' => $student->date_of_birth?->format('Y-m-d'),
                'degree' => $student->degree,
                'status' => $student->status,
            ])
        );

        return view('students.show', compact('student', 'qr'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'nullable|date',
            'degree' => 'required|string|max:255',
            'status' => 'required|in:graduate,undergraduate',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
