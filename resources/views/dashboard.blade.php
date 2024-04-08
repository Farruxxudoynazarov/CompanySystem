<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <div class="mt-4">
            <button id="adminButton" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md">
                {{ __('Administrator') }}
            </button>

            <a href="{{ route('company.index') }}" class="px-4 py-2 ml-3 bg-green-500 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md">
                {{ __('Company') }}
            </a>
            <a href="{{ route('employee.index') }}" class="px-4 py-2 ml-3 bg-purple-500 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md">
                {{ __('Employee') }}
            </a>

           
        </div>
    </x-slot>

    <div class="py-12">

        @yield('crud')
    
    </div>
</x-app-layout>


<script>
    document.getElementById('adminButton').addEventListener('click', function() {
        document.getElementById('adminOptions').classList.toggle('hidden');
    });
</script>
