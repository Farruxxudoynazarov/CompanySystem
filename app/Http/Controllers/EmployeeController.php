<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    


        
     public function index()
     {
         $user = Auth::user();
         
         if ($user->hasRole('admin')) {

            $employees = Employee::paginate(10);

         } elseif ($user->hasRole('company')) {
 
             // o'z xodimlari ko'rinadi yoki bosh qoladi
             $employees = optional($user->company)->employees()->paginate(10) ?? collect();
         } else {
             // Agar hech qanday roli yo'q bo'lsa yoki boshqa roli bo'lsa, bo'sh natija qaytaradi
             $employees = collect();
         }
     
         return view('employee.index', compact('employees'));
     }
     
     
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create employees')) {
            abort(403);
        }
        
        $companies = Company::all();

        // @dd($companies);
        return view('employee.create', compact('companies') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, Employee $employee)
    {

        // dd($request->all());
        $validatedData = $request->validated();

        $employee = Employee::create($validatedData);

        return redirect()->route('employee.index')->with('success', 'Xodim muvaffaqiyatli yaratildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $employees = Employee::paginate(5);
        $employee = Employee::findOrFail($id);
        
        //  Employee va Company o'rtasida relationship o'rnatilgan bo'lsa
        $company = $employee->company;
    
        return view('employee.show', compact('employee', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    
    $employee = Employee::findOrFail($id);
    $companies = Company::all()->toArray();

    return view('employee.edit', compact('employee', 'companies'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
         $request->validated();

        $employee = Employee::findOrFail($id);

        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success', 'Xodim muvaffaqiyatli yangilandi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $employee = Employee::find($id);
        if(!$employee){
            return redirect()->back()->with('Error', 'Xodim topilmadi');
        }
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Xodim muvaffaqiyatli uchirildi');
    }
}
