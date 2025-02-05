<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Basic Form --}}
                <h3 class="text-lg font-semibold mb-4">Product Creation Form</h3>
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    
                    <select name="store_id" class="w-full border rounded p-2" id="storeSelect">
                        <option value="">Select a Store</option>
                        @foreach($shops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-4">
                        <select name="category_id" class="w-full border rounded p-2" id="categorySelect">
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Product Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                </form>
                <h3 class="text-lg font-semibold mt-8 mb-4">Sample Table</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Sl No.</th>
                            <th class="border p-2">Product</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Shop</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key=>$item)
                        
                        <tr>
                            <td class="border p-2">{{ $key+1 }}</td>
                            <td class="border p-2">{{ $item->name }}</td>
                            <td class="border p-2">{{ $item->category->name }}</td>
                            <td class="border p-2">{{ $item->category->shop->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#storeSelect').change(function () {
                var shopId = $(this).val();
                if (shopId) {
                    $.ajax({
                        url: '/get-categories/' + shopId,
                        type: 'GET',
                        success: function (categories) {
                            $('#categorySelect').empty().append('<option value="">Select a Category</option>');
                            $.each(categories, function (key, category) {
                                $('#categorySelect').append('<option value="' + category.id + '">' + category.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#categorySelect').empty().append('<option value="">Select a Category</option>');
                }
            });
        });
    </script>
</x-app-layout>
