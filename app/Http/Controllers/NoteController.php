<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $note = Note::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'legal_case_id' => $request->get('legal_case_id')
        ]);
        return redirect()->back()->with([
            'message' => 'Case updated - Note added'
        ]);
    }
}
