<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use App\Models\Note;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class LegalCaseController extends Controller
{
    // Add Case
    public function store(Request $request)
    {
        // Policy  check
        $user = User::find($request->input('user_id'));
        if ($user->cannot('create', LegalCase::class)) {
            return redirect()->back()->withErrors(['error', 'Contact stuff for more information']);
        }

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:128',
            'case_type_id' => 'required|exists:case_types,id',
            'description' => 'required|string:255',
            'user_id' => 'required"exists:users,id'
        ]);

        if ($validator) {
            // Create a new legal case with the validated data
            $legalCase = LegalCase::create(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'user_id' => $request->input('user_id'),
                    'case_type_id' => $request->input('case_type_id')
                ]
            );
        }
        return redirect()->back()->with([
            'message' => 'Legal case created successfully',
            'legalCase' => $legalCase,
        ]);
    }

    // Show cases based on the search
    public function index(Request $request, $param)
    {
        $userCheck = Auth::user();
        // use denies instead of cannot - said by tabnine  
        if ($userCheck->cannot('viewany', LegalCase::class)) {
            abort(403, 'Unauthorized action.');
        }
        $path = $request->path();
        $urlArray = explode('/', $path);

        //$displayData = '';

        foreach ($urlArray as $key => $value) {
            switch ($value) {
                case 'type':
                    $displayData = LegalCase::where('case_type_id', $param)->with('user')->paginate(10);
                    $param = $displayData->first()?->caseType->name;
                    break;
                case 'status':
                    $displayData = LegalCase::where('status', strtolower($param))->with('user')->paginate(10);
                    break;
                case 'all':
                    $displayData = LegalCase::paginate(10);
                    break;
            }
        }
        if (!$displayData) {
            return redirect()->back()->with('message', 'No search results found');
        }

        return view('legalCase.show', ['legalCases' => $displayData, 'filter' => $param]);
    }

    // Edit/update a legal case  -- missing policy
    public function edit(Request $request, $id)
    {
        // Get the legal case with the given ID
        $legalCase = LegalCase::where('id', $id)->first();

        // Get lawyer
        $lawyer = Lawyer::where('user_id', Auth::user()->id)->first();
        if (!$legalCase) {
            return redirect()->back();
        }
        // Get path in order to filter
        $path = $request->path();
        $urlArray = explode('/', $path);
        // Walk thru elements in order to preform right action
        foreach ($urlArray as $key => $value) {
            switch ($value) {
                case 'accept':
                    $legalCase->status = 'open';
                    $legalCase->lawyer_id = $lawyer->id;
                    $legalCase->start_date = Date::now();
                    $legalCase->save();
                    break;
                case 'decline':
                    $legalCase->status = 'closed';
                    $legalCase->lawyer_id = $lawyer->id;
                    $legalCase->end_date = Date::now();
                    $legalCase->save();
                    break;
            }
        }
        return redirect('dashboard')->with('message', 'Case successfully updated');
    }

    // Legal case display
    // Show details about case
    public function details(Request $request, $id)
    {
        $legalCase = LegalCase::where('id', $id)->first();

        $user = User::where('id', Auth::user()->id)->first();
        if ($user->cannot('view', $legalCase)) {
            abort(403, 'Unauthorized action');
        }
        $notes = Note::where('legal_case_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return view('legalCase.details', ['selectedCase' => $legalCase, 'notes' => $notes]);
    }
}
