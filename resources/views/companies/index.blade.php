<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold mb-6">My Companies</h1>

            <a href="{{ route('companies.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition mb-4">
                Create Company
            </a>
        </div>
        <ul class="space-y-2 mb-8">
            @forelse($companies as $company)
                <li
                    class="flex justify-between items-center p-4 bg-white border rounded-lg shadow-sm hover:shadow-md transition">
                    <div>
                        <a href="{{ route('companies.show', $company) }}"
                            class="text-blue-600 font-medium hover:underline">
                            {{ $company->name }}
                        </a>
                        <p class="text-gray-600 text-sm">{{ $company->industry }}</p>
                    </div>

                    <div>
                        @if ($current && $current->id === $company->id)
                            <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full">
                                Active
                            </span>
                        @else
                            <form action="{{ url('/companies/' . $company->id . '/switch') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                    Switch
                                </button>
                            </form>
                        @endif
                    </div>
                </li>
            @empty
                <li class="p-4 bg-gray-100 text-gray-600 rounded-lg">
                    No companies yet.
                </li>
            @endforelse
        </ul>


        <h2 class="text-xl font-bold mb-4">Switch Active Company</h2>

        <div class="mb-6">
            <p class="text-gray-700">
                <strong>Current Active Company:</strong>
                @if ($current)
                    <span class="text-green-600">{{ $current->name }}</span>
                @else
                    <span class="text-red-600">None selected</span>
                @endif
            </p>
        </div>
    </div>
</x-app-layout>
