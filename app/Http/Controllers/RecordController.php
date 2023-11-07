<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Record;
use Illuminate\Routing\Redirector;

class RecordController extends Controller
{

    public function viewAdminRecords(int $id): object
    {
        $records = Record::where('doctor_id', $id)->get();

        return view('admin.admin_records', ['records' => $records, 'id' => $id]);
    }

    public function viewUserRecords(): object
    {
        $records = Record::where('user_id', null)->get();

        return view('user.user_records', ['records' => $records]);
    }

    public function createRecord( DoctorRequest $request, int $id): redirector
    {
        Record::create([
            'user_id' => NULL,
            'doctor_id' => $id,
            'date' => $request->get('date'),
            'time' => $request->get('time'),
        ]);

        return redirect(route('admin'));
    }

    public function deleteRecord($id): redirector
    {
        Record::find($id)->delete();

        return redirect(route('admin'));
    }

    public function chooseRecord(int $user_id, int $id): redirector
    {
        Record::find($id)->update([
            'user_id' => $user_id
        ]);

        return redirect(route('dashboard'));
    }

    public function viewMyRecords(int $id): object
    {
        $records = Record::where('user_id', $id)->get();

        return view('user.my_records', ['records' => $records]);
    }

    public function deleteUserRecord(int $id): redirector
    {
        Record::find($id)->update([
            'user_id' => null
        ]);

        return redirect(route('dashboard'));
    }
}
