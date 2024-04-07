






@extends('dashboard')

@section('crud')


<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full max-w-4xl">
               
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <a href="{{ route('employee.index') }}" class="mb-E3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back
                    </a>
                    <h2 class="block text-gray-700 text-xl font-bold mb-6">Employe info details</h2>
                    
                    <table class="table-auto w-full mb-6">
                        <tbody class="text-gray-700">
                            
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Last Name </td>
                                <td class="border px-4 py-2">{{ $employee->last_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> First Name</td>
                                <td class="border px-4 py-2">{{ $employee->first_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Father name</td>
                                <td class="border px-4 py-2">{{ $employee->father_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Position</td>
                                <td class="border px-4 py-2">{{ $employee->positon }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Phone</td>
                                <td class="border px-4 py-2">{{ $employee->phone }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Address</td>
                                <td class="border px-4 py-2">{{ $employee->address }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Company name</td>
                                <td class="border px-4 py-2">{{ $company->name}}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Passport number</td>
                                <td class="border px-4 py-2">{{ $employee->passport_number }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Createt ad</td>
                                <td class="border px-4 py-2">{{ $employee->created_at }}</td>
                            </tr>
                            <!-- Bu yerga boshqa kompaniya ma'lumotlari qo'shiladi -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>






@endsection