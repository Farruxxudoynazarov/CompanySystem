

@extends('dashboard')

@section('crud')


<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
            </h2>
            <div class="flex items-center">
                <h2 class="text-2xl font-bold mb-2 text-left bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Companies list</h2>
            </div>
            <div class="text-end">
               
                {{-- @if(auth()->user()->company_id !== $company->id) --}}

                @can('create companies')
                    
                <a href="{{ route("company.create") }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Company
                </a>
                {{-- @endif --}}
                @endcan
            </div>
        </div>
        <div class="py-3">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden min-w-full leading-normal">
                    <table class="min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th  class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Company name
                </th>
                <th scope="col" class="px-6 py-3">
                    Company leader name
                </th>
                <th scope="col" class="px-6 py-3">
                    Company email
                </th>
                <th scope="col" class="px-6 py-3">
                    Company time
                </th>
                <th scope="col" class="px-6 py-3">
                    Company status
                </th>
               
            </tr>
        </thead>
     
                        <tbody>
                           
                            @foreach ($companies as $company)
                          
                            
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{  $loop->iteration }} 
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-800 whitespace-no-wrap font-bold ">
                                                    {{ $company->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $company->director_name }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $company->email }}
                                        </p>
                                    </td>
                                    

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $company->created_at->format('Y-m-d') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <div class="inline-flex">
                                            <a href="{{ route('company.show', $company->id) }}" class="mr-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                View 
                                            </a>

                                            {{-- @if(auth()->user()->company_id == $company->id) --}}
                                             {{-- //kompaniya role uchun faqat o'zini malumotlarini tahrirlay oladi  --}}


                                            {{-- @can('edit companies') --}}
                                            <a href="{{ route('company.edit', $company->id) }}" class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Edit  
                                            </a>
                                            {{-- @endcan --}}
                                            {{-- @else --}}
                                            @can('delete companies')
                                            <form action="{{ route('company.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Delete 
                                                </button>
                                            </form>
                                            @endcan
                                            {{-- @endif --}}

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        {{-- {{ $companies->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection