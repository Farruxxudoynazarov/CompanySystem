<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//      public function __construct()
// {
//     $this->middleware('permission:view companies', ['only' => ['index', 'show']]);
//     $this->middleware('permission:create companies', ['only' => ['create', 'store']]);
//     $this->middleware('permission:edit companies|view edit own company', ['only' => ['edit', 'update']]);
//     $this->middleware('permission:delete companies', ['only' => ['destroy']]);
// }




    public function index()
{
    if (Auth::user()->hasRole('admin')) {
        // Admin uchun barcha kompaniyalar
        $companies = Company::all();
    } elseif (Auth::user()->hasRole('company')) {
        // Company uchun faqat o'z kompaniyasi
        $companies = Auth::user()->company()->get();
    } else {
        // Agar foydalanuvchi hech qanday roliga ega bo'lmasa yoki boshqa holatlar
        // Bu yerda xato qaytarish yoki bo'sh natija qaytarish mumkin
        $companies = collect();
    }

    return view('company.index', compact('companies'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        

            return view('company.create');
    
        // $this->authorize('create companies');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required',
            'director_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'phone' => 'required|max:255'
        ]);
        
        $company = Company::create($validated);

        return redirect()->route('company.index')->with('success', 'Kompaniya muvaffaqiyatli qoshildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $company = Company::findOrFail($id);
        $company = Company::with('employees')->findOrFail($id);
        // dd($company);
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $company = Company::findOrFail($id);
        $company = Auth::user()->company; // Agar har bir company faqat bitta user bilan bog'langan bo'lsa

        // if (!auth()->user()->can('edit own company') || auth()->user()->company->id != $company->id) {
        //     abort(403);
        // }
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Kiruvchi ma'lumotlarni validatsiya qilish
        $validated = $request->validate([
            'name' => 'required',
            'director_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'phone' => 'required|max:255'
        ]);
    
        // Joriy foydalanuvchining kompaniyasini olish
        $company = Auth::user()->company;
    
        // Agar joriy foydalanuvchining kompaniyasi IDsi so'rov IDsi bilan mos kelmasa, 403 xato qaytarish
        if ($company->id != $id) {
            abort(403, 'Unauthorized action.');
        }
    
        // Foydalanuvchi kompaniyasini yangilash
        $company->update($validated);
    
        // Muaffaqiyatli yangilanganidan so'ng, kompaniyalar ro'yxatiga qaytish
        return redirect()->route('company.index')->with('success', 'Company updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Mavjud bo'lgan kompaniyani topish
    $company = Company::findOrFail($id);

    // Foydalanuvchining kompaniyaga ega ekanligini tekshirish
    if (auth()->user()->company_id != $company->id) {
        // Agar foydalanuvchi kompaniyaning egasi bo'lmasa, 403 xato qaytarish
        abort(403, 'You are not authorized to delete this company.');
    }

    // Kompaniyani o'chirish
    $company->delete();

    // Kompaniya muvaffaqiyatli o'chirilgandan so'ng, kompaniyalar ro'yxatiga qaytish
    return redirect()->route('company.index')->with('success', 'Company deleted successfully.');
}


    public function editProfile()
{
    $company = auth()->user()->company; // Foydalanuvchiga tegishli kompaniyani olish
    return view('company.profile.edit', compact('company')); // Kompaniya profilini tahrirlash ko'rinishini ko'rsatish
}

}
