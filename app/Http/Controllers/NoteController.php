<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Employee;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request){
        return new NoteResource(Note::create($request->all()));
    }

    public function getNotesByEmployee($employee)
    {
        $employeeSearch = Employee::with('notes')->findOrFail($employee);
        $notes = $employeeSearch->notes;
        return NoteResource::collection($notes);
    }

    public function update(){

    }

    public function destroy(){

    }

}
