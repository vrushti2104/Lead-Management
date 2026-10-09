<div class="flex items-center gap-2">
    {{-- View Button --}}
    <a href="{{ route('leads.show', $lead->id) }}"
       class="inline-flex items-center rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white hover:bg-blue-700">
        View
    </a>

    {{-- Edit Button --}}
    <a href="{{ route('leads.edit', $lead->id) }}"
       class="inline-flex items-center rounded bg-yellow-500 px-3 py-1 text-xs font-semibold text-white hover:bg-yellow-600">
        Edit
    </a>

    {{-- Delete Button --}}
    <form action="{{ route('leads.destroy', $lead->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this lead?');">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="inline-flex items-center rounded bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700">
            Delete
        </button>
    </form>
</div>
