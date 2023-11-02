<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;

use App\Models\Record;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewJs()
    {
      return view('js');
    }

    public function viewUpdate($id)
    {
        $doctor = Doctor::find($id);

        return view('admin.update_doctor',
            ['doctor' => $doctor]);
    }

    public function view()
    {
        $doctors = Doctor::all();

        return view('admin.admin',
            ['doctors' => $doctors]);
    }

    public function createDoctor(DoctorRequest $request)
    {
        $dataDoctor = $request->validated();

        $doctor = Doctor::create([
            'name' => $dataDoctor['name'],
            'surname' => $dataDoctor['surname'],
            'experience' => $dataDoctor['experience']
        ]);


//        $doctor = Doctor::where('name', $dataDoctor['name'])->firstOrCreate();

        return response()->json($doctor);
    }

    public function deleteDoctor($id)
    {

        Doctor::find($id)->delete();

        return response()->json(['status' => 'ok']);
    }

    public function update(DoctorRequest $request, $id)
    {
        $doctor = $request->validated();

        if (isset($doctor['name'])) {
            Doctor::find($id)->update([
                'name' => $doctor['name'],
            ]);


        }
        if (isset($doctor['surname'])) {
            Doctor::find($id)->update([
                'surname' => $doctor['surname'],
            ]);

        }
        if (isset($doctor['experience'])) {
            Doctor::find($id)->update([
                'experience' => $doctor['experience']
            ]);

        }
    }
}
