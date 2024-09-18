@extends('layouts.app')
@section('content')

<div class="container">
    <form action="{{ route('comment.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="message">Comment</label>
                <input type="text" name="message" class="form-control" id="message" placeholder=""
                    aria-describedby="nameHint">
                <br>
            </div>
            <div class="form-group">
                <label for="category">{{ $product->id }}">{{ $product->product_name }}</label>
                <input type="text" name="category" class="form-control" id="category" placeholder=""
                    aria-describedby="nameHint">
                <br>
            </div>

            <div class="form-group">
                <select name="rating" id="">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button class="btn text-white" style="background-color:  #81c408"> Add Products</button>

    </form>

</div>

@endsection
