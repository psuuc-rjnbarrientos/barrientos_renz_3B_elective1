<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function insertForm() {
        return view('stud_create');
    }
    public function insert(Request $request) {
        $name = $request ->input("stud_name");
        DB::insert('insert into student (name) values(?)', [$name]);
        echo "Record inserted successfully <br/>";
        echo '<a href= "/insert"> Click Here </a> to go back';
        return redirect('/view-records');
    }

    public function select( ) {
        $users = DB::select('select * from student');
        return view('stud_view', ['users'=>$users]);
    }

    public function destroy($id) {
        $users = DB::delete('delete from student where id = ?',[$id]);
        echo "Record deleted successfully <br/>";
        echo '<a href= "/view-records"> Click Here </a> to go back';
    }

    public function show($id)
    {
        $users = DB::select('select * from student where id = ?', [$id]);
        return view('stud_update', ['users' => $users]);
    }

    public function edit(Request $request, $id)
    {
        $name = $request->input('stud_name');
        DB::update('update student set name = ? where id = ?', [$name, $id]);
        echo "Record updated successfully.<br/>";
        echo '<a href = "/view-records">Click Here</a> to go back.';
    }
}
