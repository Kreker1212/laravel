<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

use Illuminate\Http\Request;

class AdminController extends Controller
{

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

    public function createDoctor(\App\Http\Requests\DoctorRequest $request)
    {
        $doctor = $request->validated();
        Doctor::create([
            'name' => $doctor['name'],
            'surname' => $doctor['surname'],
            'experience' => $doctor['experience']
        ]);

        return redirect(route('admin'));
    }

    public function deleteDoctor($id)
    {

        Doctor::find($id)->delete();
        return redirect(route('admin'));

    }

    public function update(\App\Http\Requests\DoctorRequest $request, $id)
    {
        $doctor = $request->validated();

        Doctor::find($id)->update([
            'name' => $doctor['name'],
            'surname' => $doctor['surname'],
            'experience' => $doctor['experience']
        ]);

        return redirect(route('admin'));
    }
}
