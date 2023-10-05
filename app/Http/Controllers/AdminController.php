<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

use App\Models\Record;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewUpdate($id){
        $doctor = Doctor::find($id);
        return view('updateDoctor',['doctor' => $doctor]);
    }

    public function view(){
        $doctors = Doctor::all();
        return view('admin', ['doctors' => $doctors]);
    }

    public function createDoctor(Request $request){
        Doctor::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'experience' => $request->get('experience')
        ]);
        return redirect(route('admin'));
    }

    public function  deleteDoctor($id){

        Doctor::find($id)->delete();
        return redirect(route('admin'));

    }
    public function  update(){
        $id = $_POST['id'];
        Doctor::find($id)->update([
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
            'experience' => $_POST['experience'],
        ]);
        return redirect(route('admin'));
    }
}
