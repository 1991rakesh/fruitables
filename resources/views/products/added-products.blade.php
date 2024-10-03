<x-app-layout>
    <div class="container" style="margin-top: 150px">
        <div class="row">
            <div class="text-center">
                <h1>Your Added Products</h1>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <h2>{{ $product->product_name }}</h2>
                        <p>{{ $product->short_description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
