<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <!-- Tugmalar -->
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

            <!-- Bu div faqat adminButton bosilganda ko'rinadi -->
            {{-- <div id="adminOptions" class="hidden mt-4">
                <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md">
                    {{ __('Users') }}
                </a>
                <a href="#" class="px-4 py-2 ml-3 bg-purple-500 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md">
                    {{ __('Roles') }}
                </a>
            </div> --}}
        </div>
    </x-slot>

    <div class="py-12">
        <!-- Asosiy kontent -->
        @yield('crud')
    </div>
</x-app-layout>


<script>
    document.getElementById('adminButton').addEventListener('click', function() {
        document.getElementById('adminOptions').classList.toggle('hidden');
    });
</script>
