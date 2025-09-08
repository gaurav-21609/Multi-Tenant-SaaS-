<x-app-layout>

<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Company</h1>

    <form action="{{ route('companies.update', $company) }}" method="POST" class="space-y-6">
        @csrf 
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" required
                   value="{{ old('name', $company->name) }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" name="address" id="address"
                   value="{{ old('address', $company->address) }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
            <input type="text" name="industry" id="industry"
                   value="{{ old('industry', $company->industry) }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <div>
            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 px-4 rounded-lg shadow hover:bg-green-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
</x-app-layout>
