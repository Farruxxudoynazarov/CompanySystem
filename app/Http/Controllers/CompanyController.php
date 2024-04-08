<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Console\Command;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
{
    if (Auth::user()->hasRole('admin')) {
        // Admin uchun barcha kompaniyalar
        $companies = Company::all();
    } elseif (Auth::user()->hasRole('company')) {
        // Company uchun faqat o'z kompaniyasi
        $companies = Auth::user()->company()->get();
    } else {
        // Agar foydalanuvchi hech qanday roliga ega bo'lmasa bosh qolaid
        $companies = collect();
    }

    return view('company.index', compact('companies'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(!auth()->user()->can('create companies')){
            abort(403);
        }

            return view('company.create');
    
        // $this->authorize('create companies');
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(StoreCompanyRequest $request)
     {
         $validated= $request->validated();
     
         $company = Company::create($validated);
     
         // Kompaniya uchun foydalanuvchi company role ni  yaratish
         $user = User::create([
             'name' => $validated['name'],
             'email' => $validated['email'],
             'password' => Hash::make($request->password),
             'company_id' => $company->id,
         ]);
     
         // "company" nomli rolni topishh va foydalanuvchiga bu rolni berish
         $companyRole = Role::firstOrCreate(['name' => 'company', 'guard_name' => 'web']);
         $user->assignRole($companyRole);
     
         return redirect()->route('company.index')->with('success', 'Kompaniya muvaffaqiyatli qo\'shildi');
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


        $user = Auth::user();
        if($user->hasRole('admin') || $user->hasRole('company') ){
            $company = Company::findOrFail($id);        
        }
        else {
            abort(403, 'sizda bu amalni bajarish ruxsati yoq'); 
        }
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
       $validated = $request->validated();
    
       if(Auth::user()->hasRole('admin')){
        $company = Company::findOrFail($id);
       }
       else {
        $company =  Auth::user()->company;
        
        if($company->id !=$id){
            abort(403, 'Siz bu kompaniyani yangilash huquqiga ega emasisz');
        }
    }
    $company->update($validated);

    return redirect()->route('company.index')->with('succes', 'Kompaniya muvaffaqiyatli yangilandi');

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $company = Company::findOrFail($id);

    if(!Auth::user()->hasRole('admin') && Auth::user()->company_id != $company->id){
        abort(403, 'Bu kompaniyani o\'chirishga ruxsatiz yo\'q');
    }

    $company->delete();

    return redirect()->route('company.index')->with('success', 'Kompaniya muvaffaqiyatli o\'chirildi');
    
}


   

}
