<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Record;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

class RecordController extends Controller
{

    public function viewAdminRecords(int $id): View
    {
        $records = Record::where('doctor_id', $id)->get();

        return view('admin.admin_records', ['records' => $records, 'id' => $id]);
    }

    public function viewUserRecords(): View
    {
        $records = Record::where('user_id', null)->get();

        return view('user.user_records', ['records' => $records]);
    }

    public function createRecord( DoctorRequest $request, int $id): Redirector
    {
        Record::create([
            'user_id' => NULL,
            'doctor_id' => $id,
            'date' => $request->get('date'),
            'time' => $request->get('time'),
        ]);

        return redirect(route('admin'));
    }

    public function deleteRecord($id): Redirector
    {
        Record::find($id)->delete();

        return redirect(route('admin'));
    }

    public function chooseRecord(int $userId, int $id): Redirector
    {
        Record::find($id)->update([
            'user_id' => $userId
        ]);

        return redirect(route('dashboard'));
    }

    public function viewMyRecords(int $id): View
    {
        $records = Record::where('user_id', $id)->get();

        return view('user.my_records', ['records' => $records]);
    }

    public function deleteUserRecord(int $id): Redirector
    {
        Record::find($id)->update([
            'user_id' => null
        ]);

        return redirect(route('dashboard'));
    }
}
