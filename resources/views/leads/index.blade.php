<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leads List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-end mb-4">
                    <a href="{{ route('leads.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Add New Lead
                    </a>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">

                    <div>
                        <label for="status-filter" class="block text-sm font-medium mb-1">
                            Filter by Status
                        </label>

                        <select id="status-filter" class="w-full rounded-md border-gray-300">
                            <option value="">All Statuses</option>
                            <option value="new">New</option>
                            <option value="contacted">Contacted</option>
                            <option value="converted">Converted</option>
                            <option value="lost">Lost</option>
                        </select>
                    </div>

                    <div>
                        <label for="source-filter" class="block text-sm font-medium mb-1">
                            Filter by Source
                        </label>

                        <select id="source-filter" class="w-full rounded-md border-gray-300">
                            <option value="">All Sources</option>
                            <option value="website">Website</option>
                            <option value="referral">Referral</option>
                            <option value="social_media">Social Media</option>
                            <option value="cold_call">Cold Call</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="assigned-filter" class="block text-sm font-medium mb-1">
                            Assigned To
                        </label>

                        <select id="assigned-filter" class="w-full rounded-md border-gray-300">
                            <option value="">All Users</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mb-4 flex gap-3">
                    <button type="button" id="reset-filters" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">
                        Reset Filters
                    </button>
                    
                </div>

                <div class="overflow-x-auto">
                    <table id="leads-table" class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">ID</th>
                                <th class="border p-3 text-left">Name</th>
                                <th class="border p-3 text-left">Email</th>
                                <th class="border p-3 text-left">Phone</th>
                                <th class="border p-3 text-left">Company</th>
                                <th class="border p-3 text-left">Status</th>
                                <th class="border p-3 text-left">Source</th>
                                <th class="border p-3 text-left">Assigned To</th>
                                <th class="border p-3 text-left">Created At</th>
                                <th class="border p-3 text-left">Actions</th>
                            </tr>
                        </thead>

                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>