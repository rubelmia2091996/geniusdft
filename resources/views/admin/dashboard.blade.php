<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- Table --}}
                <h3 class="text-lg font-semibold mt-8 mb-4">Marchant Table</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Sl No.</th>
                            <th class="border p-2">Marchant Name</th>
                            <th class="border p-2">Marchant Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key=>$item)
                            
                        <tr>
                            <td class="border p-2">{{ $key+1 }}</td>
                            <td class="border p-2">{{ $item->name }}</td>
                            <td class="border p-2">{{ $item->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>