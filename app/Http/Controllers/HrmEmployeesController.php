<?php

namespace App\Http\Controllers;

use App\Models\Hrm_departments;
use App\Models\Hrm_designations;
use App\Models\Hrm_employee_positions;
use App\Models\Hrm_employees;
use App\Models\Hrm_payslips;
use App\Models\Hrm_statuses;
use Illuminate\Http\Request;

class HrmEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Hrm_employees::paginate(5);
         //print_r($employees);

         return view('pages.hrm.employee.hrm_employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=Hrm_statuses::all();
        $departments=Hrm_departments::all();
        $positions=Hrm_employee_positions::all();
        $designations=Hrm_designations::all();
        return view('pages.hrm.employee.hrm_employee.create', compact('status','departments','positions','designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'employee_id_number' => 'required|string|max:50',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:50',
            // 'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'joining_date' => 'required|date',
            'salary' => 'required|numeric',
            'branch' => 'required|string|max:50',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:200',
            'statuses_id' => 'required|integer',
            'department_id' => 'required|integer',
            'designations_id' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'certificate' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'resume' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

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
        $employees->resume = $resumePath;  // Corrected the assignment

        if ($employees->save()) {
            return redirect()->back()->with('success', 'Employee has been added successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }

    /**
     * Display the specified resource.
     */
    // public function show(Hrm_employees $Hrm_employees, $id)
    // {
    //     $employees = Hrm_employees::find($id);
    //     return view('pages.hrm.employee.hrm_employee.show', compact('employees'));
    // }

    public function show(Hrm_employees $Hrm_employees, $id)
    {
        $employees = Hrm_employees::find($id);
        return view('pages.hrm.employee.hrm_employee.employee_details', compact('employees'));
    }
    public function showEmp($id)
    {
        $employees = Hrm_employees::find($id);
        // print_r($employees);
        return view('pages.hrm.employee.hrm_employee.employee_details', compact('employees'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_employees $Hrm_employees, $id)
    {
        $employees = Hrm_employees::find($id);
        $status = Hrm_statuses::all();
        $departments=Hrm_departments::all();
        $positions=Hrm_employee_positions::all();
        $designations=Hrm_designations::all();
        return view('pages.hrm.employee.hrm_employee.update', compact('employees', 'status', 'departments','positions','designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_employees $Hrm_employees, $id)
    {
        $request->validate([
            'employee_id_number' => 'required|string|max:50',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:50',
            'gender' => 'required|string|max:50',
            'date_of_birth' => 'required|date_format:Y-M-D|before:today',
            'joining_date' => 'required|date_format:d-m-Y',
            'salary' => 'required|string|max:50',
            'branch' => 'required|string|max:50',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:200',
            'statuses_id' => 'required|string|max:200',
            'department_id' => 'required|string|max:200',
            'positions_id' => 'required|string|max:200',
            'designations_id' => 'required|string|max:200',
        ]);

        $employees = Hrm_employees::find($id);
        $employees->employee_id_number= $request->employee_id_number;
        $employees->name= $request->name;
        $employees->email= $request->email;
        $employees->phone= $request->phone;
        $employees->gender= $request->gender;
        $employees->date_of_birth= $request->date_of_birth;
        $employees->joining_date= $request->joining_date;
        $employees->positions_id= $request->positions_id;
        $employees->designations_id= $request->designations_id;
        $employees->salary= $request->salary;
        $employees->branch= $request->branch;
        $employees->statuses_id= $request->statuses_id;
        $employees->department_id= $request->department_id;
        $employees->address= $request->address;
        $employees->city= $request->city;



        if($employees->save()){
            return redirect('hrm_employees')->with('success', 'employee has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_employees $Hrm_employees, $id)
    {

        $del = Hrm_employees::destroy($id);
        if ($del) {
            return redirect('hrm_employees')->with('success', "employee has been Deleted");
        }
    }

    //  public function find_employee($id){
	// 	$employees = Hrm_employees::find($id);
	// 	return response()->json(['employees'=> $employees]);
	// }

    public function find_employee(Request $request)

{
    // $payslips=Hrm_payslips::where('employee_id', $request->id);
    $employees = Hrm_employees::find($request->id);

    if (!$employees) {
        return response()->json(['message' => 'Employee not found'], 404);
    }

    return response()->json(['employees' => $employees]);
    // return response()->json(['payslips' => $payslips]);
}
}

