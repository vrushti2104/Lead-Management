<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Lead
        </h2>

        <div class="flex justify-end">
            <a href="{{ route('leads.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf

                    @include('leads.form')

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
