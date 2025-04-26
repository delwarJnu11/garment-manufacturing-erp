<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Models\Hrm_employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        try {
            $employees = Hrm_employees::query();

            if($search=trim($request->search)){
                $employees->where('name', 'like', "%{$search}%");
            }
            return response()->json(['res' => $employees->paginate(2)]);

        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $certificatePath = null;
            $resumePath = null;
            $photoPath = null;

            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/employee'), $fileName);
                $certificatePath = 'uploads/employee/' . $fileName;
            }

            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/employee'), $fileName);
                $resumePath = 'uploads/employee/' . $fileName;
            }
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/employee'), $fileName);
                $photoPath = 'uploads/employee/' . $fileName;
            }

            $employees = new Hrm_employees();
            $employees->employee_id_number = $request->employee_id_number;
            $employees->name = $request->name;
            $employees->email = $request->email;
            $employees->phone = $request->phone;
            $employees->gender = $request->gender;
            $employees->date_of_birth = $request->date_of_birth;
            $employees->joining_date = $request->joining_date;
            $employees->designations_id = $request->designations_id;
            $employees->salary = $request->salary;
            $employees->branch = $request->branch;
            $employees->statuses_id = $request->statuses_id;
            $employees->department_id = $request->department_id;
            $employees->address = $request->address;
            $employees->city = $request->city;
            $employees->photo = $photoPath;
            $employees->certificate = $certificatePath;
            $employees->resume = $resumePath;

            $employees->save();

            return response()->json(['res'=>$employees]);

        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employees = Hrm_employees::find($id);
            if(!$employees){
                $employees="No Data Found";
            }
            return response()->json(['res'=>$employees]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $employee = Hrm_employees::findOrFail($id);

            // Upload new files if provided
            if ($request->hasFile('photo')) {
                if ($employee->photo && file_exists(public_path($employee->photo))) {
                    unlink(public_path($employee->photo)); // delete old photo
                }
                $file = $request->file('photo');
                $photoName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/employee'), $photoName);
                $employee->photo = 'uploads/employee/' . $photoName;
            }

            if ($request->hasFile('certificate')) {
                if ($employee->certificate && file_exists(public_path($employee->certificate))) {
                    unlink(public_path($employee->certificate)); // delete old certificate
                }
                $file = $request->file('certificate');
                $certName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/employee'), $certName);
                $employee->certificate = 'uploads/employee/' . $certName;
            }

            if ($request->hasFile('resume')) {
                if ($employee->resume && file_exists(public_path($employee->resume))) {
                    unlink(public_path($employee->resume)); // delete old resume
                }
                $file = $request->file('resume');
                $resumeName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/employee'), $resumeName);
                $employee->resume = 'uploads/employee/' . $resumeName;
            }

            // Update other fields
            $employee->employee_id_number = $request->employee_id_number;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->gender = $request->gender;
            $employee->date_of_birth = $request->date_of_birth;
            $employee->joining_date = $request->joining_date;
            $employee->positions_id = $request->positions_id;
            $employee->designations_id = $request->designations_id;
            $employee->salary = $request->salary;
            $employee->branch = $request->branch;
            $employee->statuses_id = $request->statuses_id;
            $employee->department_id = $request->department_id;
            $employee->address = $request->address;
            $employee->city = $request->city;

            $employee->save();
            return response()->json(['res'=>$employee]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employees= Hrm_employees::destroy($id);
            return response()->json(['res'=>$employees]);
        } catch (\Throwable $th) {
            return response()->json(['err'=>$th->getMessage()]);
        }

    }
}
