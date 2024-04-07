<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        //  $this->middleware(['auth', 'role:company']);
        //  $this->middleware(['auth', 'role:admin']);
     }
    


        
     public function index()
     {
         $user = Auth::user();
         
         if ($user->hasRole('admin')) {
             // Agar foydalanuvchi admin bo'lsa, barcha xodimlarni paginate qilib ko'rsatadi
             $employees = Employee::paginate(10);
         } elseif ($user->hasRole('company')) {
             // Agar foydalanuvchi company roliga ega bo'lsa, va uning kompaniyasi mavjud bo'lsa, 
             // faqat o'z xodimlarini paginate qilib ko'rsatadi. Aks holda, bo'sh to'plam qaytaradi.
             $employees = optional($user->company)->employees()->paginate(10) ?? collect();
         } else {
             // Agar hech qanday roli yo'q yoki boshqa roli bo'lsa, bo'sh natija qaytaradi
             $employees = collect();
         }
     
         return view('employee.index', compact('employees'));
     }
     
     
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $user = auth()->user()->getU; // Foydalanuvchi obyektini olish
        // $roles = Auth::user()->getRoleNames(); // Bu Collection qaytaradi

        
        
        $companies = Company::all();

        // @dd($companies);
        return view('employee.create', compact('companies') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {

        // dd($request->all());
        // Ma'lumotlarni tekshirish
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'positon' => 'required|max:255',
            'phone' => 'required|numeric',
            'passport_number' => ['required', 'regex:/^[A-Z]{2}[0-9]{7}$/'],
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $employee = Employee::create($validatedData);

        // Redirect qilish
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $employees = Employee::paginate(5);
        $employee = Employee::findOrFail($id);
        $company = $employee->company; // Agar Employee va Company o'rtasida munosabat (relationship) o'rnatilgan bo'lsa
    
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
    public function update(Request $request, string $id)
    {
         $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'positon' => 'required',
            'phone' => 'required|numeric',
            'passport_number' => ['required', 'regex:/^[A-Z]{2}[0-9]{7}$/'],
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);



        $employee = Employee::findOrFail($id);

        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');



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
