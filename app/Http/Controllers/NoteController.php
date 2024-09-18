<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(){

    }

    public function show(Note $notes){
        return new NoteResource($notes);
    }

    public function update(){

    }

    public function destroy(){

    }

}
