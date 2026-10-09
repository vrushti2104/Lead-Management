<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lead Details
            </h2>

            <a href="{{ route('leads.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Back to Leads
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Lead #{{ $lead->id }}
                    </h3>

                    <a href="{{ route('leads.edit', $lead->id) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Edit Lead
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <tbody>
                            <tr class="border-b">
                                <th class="w-1/3 bg-gray-50 p-3 text-left">Name</th>
                                <td class="p-3">{{ $lead->name }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Email</th>
                                <td class="p-3">{{ $lead->email }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Phone</th>
                                <td class="p-3">{{ $lead->phone }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Company</th>
                                <td class="p-3">{{ $lead->company_name }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Status</th>
                                <td class="p-3">
                                    <span class="inline-block px-3 py-1 rounded text-sm
                                        @if($lead->status === 'new') bg-blue-100 text-blue-800
                                        @elseif($lead->status === 'contacted') bg-yellow-100 text-yellow-800
                                        @elseif($lead->status === 'converted') bg-green-100 text-green-800
                                        @elseif($lead->status === 'lost') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($lead->status) }}
                                    </span>
                                </td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Source</th>
                                <td class="p-3">
                                    {{ ucwords(str_replace('_', ' ', $lead->source)) }}
                                </td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Assigned To</th>
                                <td class="p-3">
                                    {{ $lead->assignedTo?->name ?? 'Unassigned' }}
                                </td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Created By</th>
                                <td class="p-3">
                                    {{ $lead->createdBy?->name ?? 'Unknown' }}
                                </td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Notes</th>
                                <td class="p-3 whitespace-pre-wrap">{{ $lead->notes ?: 'No notes available' }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="bg-gray-50 p-3 text-left">Created At</th>
                                <td class="p-3">
                                    {{ $lead->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-gray-50 p-3 text-left">Last Updated</th>
                                <td class="p-3">
                                    {{ $lead->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('leads.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                        Back to Leads
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>