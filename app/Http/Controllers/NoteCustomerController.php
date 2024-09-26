<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Customer;
use App\Models\Note;

class NoteCustomerController extends Controller
{
    public function storeNoteForCustomer(StoreNoteRequest $request, Customer $customer)
    {
        $note = Note::create([
            'note_text' => $request->note_text,
            'reminder_date' => $request->reminder_date,
            'completed' => 0,
            'noteable_id' => $customer->id,
            'noteable_type' => Customer::class,
        ]);
        return new NoteResource($note);
    }

    public function getNotesByCustomer($customer)
    {
        $customerSearch = Customer::with('notes')->findOrFail($customer);
        $notes = $customerSearch->notes;
        return NoteResource::collection($notes);
    }

    public function update(UpdateNoteRequest $request, Customer $customer, $noteId)
    {
        $note = Note::find($noteId);
        if (!$note) {
            return response()->json(['message' => "Nota del empleado {$customer->id} no existe."], 404);
        }
        if ($note->noteable_id !== $customer->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $note->update($request->all());
        return response()->json(['message' => "La nota con el id {$note->id} ha sido actualizado"], 200);
    }

    public function destroy(Customer $customer, $noteId)
    {
        $note = Note::find($noteId);
        if (!$note) {
            return response()->json(['message' => "Nota del empleado {$customer->id} no existe."], 404);
        }
        if ($note->noteable_id !== $customer->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $note->delete();
        return response()->json(['message' => 'Nota eliminada con éxito.'], 200);
    }
}
