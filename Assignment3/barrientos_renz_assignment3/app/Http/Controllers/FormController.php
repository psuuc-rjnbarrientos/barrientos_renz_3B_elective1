<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showForm() {
        return view('form');
    }

    public function handleForm(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'sex' => 'in:male,female', 
            'mobilePhone' => [
                'required',
                'regex:/^(0998|0999|0920)-\d{3}-\d{4}$/',
            ],
            'telNo' => 'required|numeric',
            'birthDate' => 'required|date|date_format:Y-m-d',
            'address' => 'required|string|max:100',
            'email' => 'required|email',
            'website' => 'required|url',
        ]);


        return back()->with('success', 'Form submitted successfully!');
    }
}
