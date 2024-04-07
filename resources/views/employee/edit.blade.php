@extends('dashboard')

@section('crud')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full max-w-2xl">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Xatoliklar mavjud!</strong> Quyidagi maydonlarda muammolar bor.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2 class="block text-gray-700 text-xl font-bold mb-6">Edit Employee</h2>
                    <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                First Name
                            </label>
                            <input value="{{ $employee->first_name}}"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first_name" name="first_name" type="text" placeholder="First Name">
                        </div>
                        <!-- Shu uslubda qolgan maydonlar uchun inputlar qo'shing -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" >
                                Last Name
                            </label>
                            <input value="{{ $employee->last_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="last_name" type="text" placeholder="Last Name">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" >
                                Father Name
                            </label>
                            <input value="{{ $employee->father_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="father_name" type="text" placeholder="Father Name">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" >
                                Position Name
                            </label>
                            <input value="{{ $employee->positon }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="positon" type="text" placeholder="Director">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" >
                                Phone number
                            </label>
                            <input value="{{ $employee->phone }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="phone" type="tel" placeholder="+998883094848">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" >
                                Passport number
                            </label>
                            <input value="{{ $employee->passport_number }}"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="passport_number" type="text" placeholder="AC1313361">
                        </div>

                        <div class="mb-4">
                            
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Address</label>
                            <textarea  name="address" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address...">{{ $employee->address }}</textarea>
                            @error('address')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                        </div>
                        <div class="mb-4">
                            <label for="company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kompaniyangiz</label>
                            <select name="company_id" id="company_id">
                                @foreach ($companies as $company)
                                    <option value="{{ $company['id'] }}" {{ $employee->company_id == $company['id'] ? 'selected' : '' }}>
                                        {{ $company['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      
                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
