<div class="space-y-4">

    {{-- Name --}}
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700">
            Name
        </label>

        <input type="text"
               id="name"
               name="name"
               value="{{ old('name', isset($lead) ? $lead->name : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
               required>

        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block font-medium text-sm text-gray-700">
            Email
        </label>

        <input type="email"
               id="email"
               name="email"
               value="{{ old('email', isset($lead) ? $lead->email : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
               required>

        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Phone --}}
    <div>
        <label for="phone" class="block font-medium text-sm text-gray-700">
            Phone
        </label>

        <input type="text"
               id="phone"
               name="phone"
               value="{{ old('phone', isset($lead) ? $lead->phone : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        @error('phone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Company --}}
    <div>
        <label for="company" class="block font-medium text-sm text-gray-700">
            Company
        </label>

        <input type="text"
               id="company"
               name="company_name"
               value="{{ old('company_name', isset($lead) ? $lead->company_name : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

        @error('company_name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="block font-medium text-sm text-gray-700">
            Status
        </label>

        <select id="status"
                name="status"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="new" {{ old('status', isset($lead) ? $lead->status : '') === 'new' ? 'selected' : '' }}>New</option>
            <option value="contacted" {{ old('status', isset($lead) ? $lead->status : '') === 'contacted' ? 'selected' : '' }}>Contacted</option>
            <option value="qualified" {{ old('status', isset($lead) ? $lead->status : '') === 'qualified' ? 'selected' : '' }}>Qualified</option>
            <option value="lost" {{ old('status', isset($lead) ? $lead->status : '') === 'lost' ? 'selected' : '' }}>Lost</option>
        </select>

        @error('status')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="source" class="block font-medium text-sm text-gray-700">
            Source
        </label>

        <select id="source"
                name="source"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="website" {{ old('source', isset($lead) ? $lead->source : '') === 'website' ? 'selected' : '' }}>Website</option>
            <option value="referral" {{ old('source', isset($lead) ? $lead->source : '') === 'referral' ? 'selected' : '' }}>Referral</option>
            <option value="social_media" {{ old('source', isset($lead) ? $lead->source : '') === 'social_media' ? 'selected' : '' }}>Social Media</option>
            <option value="other" {{ old('source', isset($lead) ? $lead->source : '') === 'other' ? 'selected' : '' }}>Other</option>
        </select>

        @error('source')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="assigned_to" class="block font-medium text-sm text-gray-700">
            Assigned To
        </label>

        <select id="assigned_to"
                name="assigned_to"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('assigned_to', isset($lead) ? $lead->assigned_to : '') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        @error('assigned_to')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="notes" class="block font-medium text-sm text-gray-700">
            Notes
        </label>

        <textarea id="notes"
                  name="notes"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', isset($lead) ? $lead->notes : '') }}</textarea>

        @error('notes')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 pt-2">
        <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            {{ isset($lead) ? 'Update Lead' : 'Save Lead' }}
        </button>

        <a href="{{ route('leads.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">
            Cancel
        </a>
    </div>

</div>