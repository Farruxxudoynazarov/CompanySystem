@extends('dashboard')

@section('crud')


<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
            </h2>
            <div class="flex items-center">
                <h2
                    class="text-2xl font-bold mb-2 text-left bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Employee list</h2>
            </div>
            <div class="text-end">
                @can('create employees')
                <a href="{{ route('employee.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Employee
                </a>
                @endcan
            </div>

        </div>
        <div class="py-3">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden min-w-full leading-normal">
                    <table
                        class="min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employe name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Position
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employe phone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employee time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employee status
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            @php
                            $index = ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration;
                            @endphp
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $index }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-800 whitespace-no-wrap font-bold ">
                                                {{ $employee->first_name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->positon }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->phone }}
                                    </p>
                                </td>


                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $employee->created_at->format('Y-m-d') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                    <div class="inline-flex">
                                        <a href="{{ route('employee.show', $employee->id) }}"
                                            class="mr-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            View
                                        </a>
                                        {{-- @can('edit employee') --}}
                                        @can('edit employees')
                                        <a href="{{ route('employee.edit', $employee->id) }}"
                                            class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Edit
                                        </a>
                                        @endcan


                                        @can('delete employees')
                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                            onsubmit="return confirm('Haqiqatdan ham o\'chirilsinmi?');" class="d-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                Delete
                                            </button>
                                        </form>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection