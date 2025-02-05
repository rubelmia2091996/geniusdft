<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ tenant('name') }} - Categories</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Categories for {{ tenant('name') }}</h1>

    <ul id="category-list">
        @foreach($categories as $category)
            <li data-id="{{ $category->id }}" class="category-item btn btn-danger" style="cursor: pointer;">
                {{ $category->name }}
            </li>
        @endforeach
    </ul>

    <h2>Products</h2>
    <div id="products-list">
        <p>Select a category to view products.</p>
    </div>

    <script>
        $(document).ready(function () {
            $('.category-item').on('click', function () {
                var categoryId = $(this).data('id');
                
                $.ajax({
                    url: "{{ url('/category') }}/" + categoryId + "/products",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#products-list').empty();
                        if (data.length > 0) {
                            $.each(data, function (key, product) {
                                $('#products-list').append(
                                    '<div ><h4 class="btn btn-danger">' + product.name + '</h4></div>'
                                );
                            });
                        } else {
                            $('#products-list').html('<p>No products found for this category.</p>');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
