






@extends('dashboard')

@section('crud')


<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full max-w-4xl">

                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <a href="{{ route('company.index') }}" class="mb-E3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back
                    </a>
                    <h2 class="block text-gray-700 text-xl font-bold mb-6">Company info details</h2>
                    
                    <table class="table-auto w-full mb-6">
                        <tbody class="text-gray-700">
                            
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium">  Name </td>
                                <td class="border px-4 py-2">{{ $company->name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Direktor Name</td>
                                <td class="border px-4 py-2">{{ $company->director_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Address</td>
                                <td class="border px-4 py-2">{{ $company->address }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Email</td>
                                <td class="border px-4 py-2">{{ $company->email }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Website</td>
                                <td class="border px-4 py-2">{{ $company->website }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Phone</td>
                                <td class="border px-4 py-2">{{ $company->phone }}</td>
                            </tr>
                           
                            
                            <tr class="bg-gray-50">
                                <td class="border px-4 py-2 text-gray-600 font-medium"> Createt ad</td>
                                <td class="border px-4 py-2">{{ $company->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>






@endsection