<section class="space-y-6">
    <div class="container">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Your Added Products') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('You can seen your added products and edit update and delete this.') }}
            </p>
        </header>
        <a href="{{ Route('added-products') }}">
            <button class="btn text-white" style="background-color:  #81c408">
                Open Your Products
            </button>
        </a>
    </div>
</section>
