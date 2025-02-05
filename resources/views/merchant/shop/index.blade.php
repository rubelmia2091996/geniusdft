<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Basic Form --}}
                <h3 class="text-lg font-semibold mb-4">Shop Creation Form</h3>
                <form action="{{ route('shop.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Store Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                </form>

                {{-- Table --}}
                <h3 class="text-lg font-semibold mt-8 mb-4">Store Table</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Sl No.</th>
                            <th class="border p-2">Store Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key=>$item)
                            
                        <tr>
                            <td class="border p-2">{{ $key+1 }}</td>
                            <td class="border p-2">{{ $item->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
