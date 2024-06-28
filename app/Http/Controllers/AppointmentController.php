<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller{
    public function index(){

    }

    // Request/Add meeting
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'agenda' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        if($validator){
            $appointment = Appointment::create([
                'agenda' => $request->get('agenda'),
                'date' => $request->get('date'),
                'time' => $request->get('time'),
                'user_id' => Auth::user()->id,
                'lawyer_id' => $request->get('lawyer_id'),
            ]);

            return redirect()->back()->with([
                'message' => 'Appointment requested'
            ]);

        }

    }

    public function update(Request $request, $id){
        $appointment = Appointment::where('id', $id)->first();
        $appointment->status = $request->get('status');
        $appointment->save();
        return redirect()->back()->with([
           'message' => 'Appointment updated'
        ]);
    }
}


