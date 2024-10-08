@extends('layouts.app')
@section('title', 'Fruitables - Chackout')

@section('content')
<style>
    /* Hide spinners for Chrome, Safari, and Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Hide spinners for Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <div class="container-fluid py-5">
                <div class="container py-5">
                    @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                    <h1 class="mb-4">Billing details</h1>
                    @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>

                    @endif
            <form action="{{route('place.order')}}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div class="form-item">
                            <label class="form-label my-3">Full Name<sup>*</sup></label>
                            <input type="text" class="form-control" name="fullname">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="House Number Street Name" name="address">
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Town/City<sup>*</sup></label>
                                    <input type="text" class="form-control" name="city">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">District<sup>*</sup></label>
                                    <input type="text" class="form-control" name="district">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label for="stateSelect" class="form-label my-3">State</label>
                                        <select id="stateSelect" class="form-control" name="state">
                                            <option value=""> Select your state </option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Postalcode/Zip<sup>*</sup></label>
                                    <input type="number" class="form-control" name="postalcode">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="number" class="form-control" name="mobile">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th></th>
                                        <th></th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalCost = 0;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <th class="">
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($product->images[0]->image_path) }}"
                                                        class="img-fluid rounded-circle" style="width: 40px; height: 40px;"
                                                        alt="">
                                                </div>
                                            </th>
                                            <td class="">{{ $product->product_name }}</td>
                                            <td colspan="3"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i>:{{ $product->selling_price }}
                                            </td>
                                            <td class="">{{ $product->count }}</td>
                                            <td class=""> <i class="fa-solid fa-indian-rupee-sign"></i> :
                                                {{ $product->selling_price * $product->count }}</td>
                                        </tr>
                                        @php
                                            $totalCost += $product->selling_price * $product->count;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="6"> <h6> Sub Total </h6> </td>
                                        <td> <h6> <i class="fa-solid fa-indian-rupee-sign"></i> : {{ $totalCost }} /- </h6> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"> <h6> GST 18% </h6> </td>
                                        <td> <h6> <i class="fa-solid fa-indian-rupee-sign"></i> : {{ ($totalCost* 18) / 100 }} /- </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"> <h6> Shiping Charge </h6> </td>
                                        <td> <h6> <i class="fa-solid fa-indian-rupee-sign"></i> : 30/- </h6> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h4> Grand Total </h4>
                                        </td>
                                        <td>
                                            <h5> <i class="fa-solid fa-indian-rupee-sign"></i> :
                                                {{ ($totalCost + ($totalCost * 18) / 100)+ 30 }} /- </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-7 col-7">
                                <div class="form-item">
                                    <label for="coupon">Coupon Code</label>
                                    <input type="text" name="coupon" class="form-control" id="coupon"
                                        placeholder="Coupon Code">
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <button type="button" class="btn btn-success" style="background-color:  #81c408;position: relative;right: -47%;top: 23px;">Apply Coupon</button>
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1"
                                        name="payMethod" value="Delivery">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="sumbit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
    <script>
        const states = [
            "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh",
            "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand",
            "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur",
            "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab",
            "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura",
            "Uttar Pradesh", "Uttarakhand", "West Bengal",
            "Andaman and Nicobar Islands", "Chandigarh",
            "Dadra and Nagar Haveli and Daman and Diu", "Lakshadweep",
            "Delhi", "Puducherry", "Jammu and Kashmir", "Ladakh"
        ];

        const selectElement = document.getElementById('stateSelect');

        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            selectElement.appendChild(option);
        });
    </script>


@endsection
