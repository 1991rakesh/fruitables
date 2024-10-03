<x-app-layout>
    <div class="py-12 container" style="margin-top: 150px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">Profile</button>
                </li>
                @if (Auth::check() && Auth::user()->role == 'vendor')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                        Products</button>
                </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                        Orders</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="container">
                        <div class="row">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-5 m-1">
                                <div class="max-w-xl d-flex">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-6 m-1">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-11 m-1">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <table class="table table-striped">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Actions</th>
                        </tr>
                        @php $srNo = 1; @endphp
                        @foreach ($user->products as $product)
                            <tr>
                                <td scope="row">{{ $srNo }}</td>
                                <td scope="row">
                                    <a href="{{ route('shop-detail', ['product_id' => $product->id]) }}">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($product->images[0]->image_path) }}" class="img-fluid me-5 rounded-circle" style="width: 30px; height: 30px;" alt="">
                                    </div>
                                </a>
                                </td>
                                <td>
                                    {{ $product->product_name }}
                                </td>
                                <td>
                                    <a href="{{ route('product-edit', $product->id) }}" class="btn btn-sm btn-primary">Edit Product</a> &nbsp;&nbsp;&nbsp;
                                    <a href="" class="btn btn-sm btn-primary delete-btn" data-product-id="123">Delete Product</a>
                                </td>
                            </tr>
                            @php $srNo++; @endphp
                        @endforeach

                    </table>
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">
                    <table class="table table-striped">
                        <td>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Order Date</th>
                        <th>Payment Method</th>
                        </td>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

