<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Employee;
use App\Models\Note;

class NoteEmployeeController extends Controller
{
    public function storeNoteForEmployee(StoreNoteRequest $request, Employee $employee){
        $note = Note::create([
            'note_text' => $request->note_text,
            'reminder_date' =>$request->reminder_date,
            'completed' => 0,
            'noteable_id' => $employee->id,
            'noteable_type' => Employee::class,
        ]);
        return new NoteResource($note);
    }

    public function getNotesByEmployee($employee)
    {
        $employeeSearch = Employee::with('notes')->findOrFail($employee);
        $notes = $employeeSearch->notes;
        return NoteResource::collection($notes);
    }

    public function update(UpdateNoteRequest $request, Employee $employee, $noteId){
        $note = Note::find($noteId);
        if (!$note) {
            return response()->json(['message' => "Nota del empleado {$employee->id} no existe."], 404);
        }
        if ($note->noteable_id !== $employee->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $note->update($request->all());
        return response()->json(['message' => "La nota con el id {$note->id} ha sido actualizado"], 200); 
    }

    public function destroy(Employee $employee, $noteId)
    {
        $note = Note::find($noteId);
        if (!$note) {
            return response()->json(['message' => "Nota del empleado {$employee->id} no existe."], 404);
        }
        if ($note->noteable_id !== $employee->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $note->delete();
        return response()->json(['message' => 'Nota eliminada con éxito.'], 200);
    }
}
