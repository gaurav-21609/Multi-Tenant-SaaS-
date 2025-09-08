<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">{{ $company->name }}</h1>

        <div class="space-y-2 mb-6">
            <p><span class="font-semibold">Address:</span> {{ $company->address ?? 'N/A' }}</p>
            <p><span class="font-semibold">Industry:</span> {{ $company->industry ?? 'N/A' }}</p>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('companies.edit', $company) }}"
               class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition">
                Edit
            </a>

            <form action="{{ route('companies.destroy', $company) }}" method="POST"
                  onsubmit="return confirm('Delete this company?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
