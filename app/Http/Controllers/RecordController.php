<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    public function viewAdminRecords($id)
    {
        $records = Record::where('doctor_id', $id)->get();
        return view('adminRecords', ['records' => $records, 'id' => $id]);
    }

    public function viewUserRecords()
    {
        $records = Record::where('record', 0)->get();
        return view('userRecords',['records' => $records]);
    }

    public function createRecord(Request $request)
    {
        Record::create([
            'record' => 0,
            'user_id' => 0,
            'doctor_id' => $request->get('id'),
            'date' => $request->get('date'),
            'time' => $request->get('time'),
        ]);
        return redirect(route('admin'));
    }

    public function deleteRecord($id)
    {

        Record::find($id)->delete();
        return redirect(route('admin'));
    }

    public function  сhooseRecord($id, $user_id)
    {
        Record::find($id)->update([
            'record' => 1,
            'user_id' => $user_id
        ]);

        return redirect(route('dashboard'));
    }
    public function viewMyRecords($id)
    {
        $records = Record::where('user_id', $id)->get();
        return view('myRecords', ['records' => $records]);
    }

    public function deleteUserRecord($id)
    {
        Record::find($id)->update([
            'record' => 0,
            'user_id' => 0
        ]);

        return redirect(route('dashboard'));
    }
}
