@extends('layouts.app')

@section('title', 'Fruitables - Add Product')
@section('content')
    <div class="container" style="margin-top: 150px">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder=""
                        value="{{ old('product_name') }}">
                    <br>
                </div>
                <div class="form-group col-6">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="Fruits">Fruits</option>
                        <option value="Meet">Meet</option>
                        <option value="Vegitables">Vegitables</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="mrp">MRP</label>
                    <input type="number" name="mrp" class="form-control" id="mrp" placeholder=""
                        value="{{ old('mrp') }}">
                    <br>
                </div>
                <div class="form-group col-6">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" name="selling_price" class="form-control" id="selling_price" placeholder="">
                    <br>
                </div>
                <div class="form-group col-6">
                    <label for="short_description">Short Description</label>
                    <input type="text" name="short_description" class="form-control" id="short_description"
                        placeholder="">
                    <br>
                </div>
                <div class="form-group col-6">
                    <label for="long_description">Long Description</label>
                    <input type="text" name="long_description" class="form-control" id="long_description" placeholder="">
                    <br>
                </div>
                <div class="form-group col-6">
                    <label for="product_images">Product Images</label>
                    <input type="file" name="product_images[]" class="form-control" id="product_images"
                        placeholder="Choose Product Image" multiple>
                    <br>
                </div>
                <div class="form-group col-6">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" class="form-control" id="tags" placeholder="">
                    <br>
                </div>
            </div>

            <button class="btn text-white" style="background-color:  #81c408"> Add Products</button>
        </form>
    </div>
@endsection











{{-- <x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="my-3">
                    <x-input-label for="product_name" :value="__('Product Name')" />
                    <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" :value="old('product_name')" />
                    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                </div>

                <div class="my-3">
                    <x-input-label for="category" :value="__('Category')" />
                    <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')" />
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div class="my-3">
                    <x-input-label for="mrp_price" :value="__('MRP')" />
                    <x-text-input id="mrp_price" class="block mt-1 w-full" type="text" name="mrp_price" :value="old('mrp_price')" />
                    <x-input-error :messages="$errors->get('mrp_price')" class="mt-2" />
                </div>

                <div class="my-3">
                    <x-input-label for="selling_price" :value="__('Selling Price')" />
                    <x-text-input id="selling_price" class="block mt-1 w-full" type="text" name="selling_price" :value="old('selling_price')" />
                    <x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
                </div>

                <div class="my-3">
                    <x-input-label for="short_description" :value="__('Short Description')" />
                    <x-text-input id="short_description" class="block mt-1 w-full" type="text" name="short_description" :value="old('short_description')" />
                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>

                <div class="my-3">
                    <x-input-label for="long_description" :value="__('Long Description')" />
                    <x-text-input id="long_description" class="block mt-1 w-full" type="text" name="long_description" :value="old('long_description')" />
                    <x-input-error :messages="$errors->get('long_description')" class="mt-2" />
                </div>


                <div class="images">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple files</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" name="product_images" multiple>
                </div>

                <div class="my-3">
                    <x-input-label for="tags" :value="__('Tags')" />
                    <x-text-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')" />
                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>

                <button type="submit" class="mt-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout> --}}

{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Your Products Hare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <x-app-layout>
        <div class="container">
        <form method="POST" action="{{ route('register') }}">
                    @csrf
                <div>
                    <x-input-label for="product_name" :value="__('Product Name')" />
                    <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" :value="old('name')"/>
                    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')"/>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="MRP" :value="__('MRP')" />
                    <x-text-input id="MRP" class="block mt-1 w-full" type="text" name="MRP" :value="old('MRP')"/>
                    <x-input-error :messages="$errors->get('MRP')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="selling_price" :value="__('Selling Price')" />
                    <x-text-input id="selling_price" class="block mt-1 w-full" type="text" name="selling_price" :value="old('selling_price')"/>
                    <x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="short_description" :value="__('Short Description')" />
                    <x-text-input id="short_description" class="block mt-1 w-full" type="text" name="short_description" :value="old('short_description')"/>
                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="long_description" :value="__('Long Description')" />
                    <x-text-input id="long_description" class="block mt-1 w-full" type="text" name="long_description" :value="old('long_description')"/>
                    <x-input-error :messages="$errors->get('long_description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="tags" :value="__('Tags')" />
                    <x-text-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')"/>
                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="file" :value="__('Choose File')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                </div>

        </form>
        </div>
    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html> --}}

{{-- <x-app-layout>
    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}">
                    @csrf
                <div>
                    <x-input-label for="product_name" :value="__('Product Name')" />
                    <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" :value="old('name')"/>
                    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')"/>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="MRP" :value="__('MRP')" />
                    <x-text-input id="MRP" class="block mt-1 w-full" type="text" name="MRP" :value="old('MRP')"/>
                    <x-input-error :messages="$errors->get('MRP')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="selling_price" :value="__('Selling Price')" />
                    <x-text-input id="selling_price" class="block mt-1 w-full" type="text" name="selling_price" :value="old('selling_price')"/>
                    <x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="short_description" :value="__('Short Description')" />
                    <x-text-input id="short_description" class="block mt-1 w-full" type="text" name="short_description" :value="old('short_description')"/>
                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="long_description" :value="__('Long Description')" />
                    <x-text-input id="long_description" class="block mt-1 w-full" type="text" name="long_description" :value="old('long_description')"/>
                    <x-input-error :messages="$errors->get('long_description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="tags" :value="__('Tags')" />
                    <x-text-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')"/>
                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="file" :value="__('Choose File')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                </div>
        </form>
    </x-guest-layout>
</x-app-layout> --}}
