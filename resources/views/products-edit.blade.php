<x-app-layout>

    @section('title', 'Fruitables - Edit Product')
    @section('content')
        <!-- products-edit.blade.php -->
    <div class="container" style="margin-top: 200px">
        <div class="row">
        <form method="POST" action="{{ route('product-update', $product->id) }}">
            @csrf
            <div>
                <label for="name" class="form">Product Name:</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ $product->product_name }}">
            </div>
            <div>
                <label for="description" class="form">Product Description:</label>
                <textarea class="form-control" id="description" name="description">{{ $product->short_description }}</textarea>
            </div>
            <!-- और फील्ड्स के लिए भी ऐसा ही करें -->
            <button type="submit">Update Product</button>
        </form>
    </div>
    </div>
    @endsection
</x-app-layout>
