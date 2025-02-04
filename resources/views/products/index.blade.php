@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
  <!-- Breadcrumb Start -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
    <nav>
      <ol class="flex items-center gap-2">
        <li>
          <a class="font-medium" href="index.html">Dashboard /</a>
        </li>
        <li class="font-medium text-primary">Products</li>
      </ol>
    </nav>
  </div>
  <!-- Breadcrumb End -->

  <!-- ====== Table Section Start -->
  <div class="flex flex-col gap-10">
    <!-- ====== Table Two Start -->
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
      <div class="px-4 py-6 md:px-6 xl:px-7.5 flex items-center gap-2">
        <h4 class="text-xl font-bold text-black dark:text-white">Products</h4>

        <a href="{{ route('products.create') }}"
          class="bg-primary inline-block text-white hover:bg-primary/90 transition-colors py-1 px-2 rounded-lg">
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <div
        class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
        <div class="col-span-4 flex items-center">
          <p class="font-medium">Name</p>
        </div>
        <div class="col-span-1 hidden items-center sm:flex">
          <p class="font-medium">Active</p>
        </div>
        <div class="col-span-2 flex items-center">
          <p class="font-medium">Created At</p>
        </div>
        <div class="col-span-1 flex items-center">
          <p class="font-medium">Action</p>
        </div>
      </div>

      @if ($products->isEmpty())
      <div class="text-center h-40 flex items-center justify-center">
        <p class="text-lg font-medium text-gray-500 dark:text-gray-300">Product not found</p>
      </div>
      @else
      @foreach ($products as $product)
      <div
        class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
        <div class="col-span-4 flex items-center gap-5">
          <img src="{{ '/storage/' . $product->images[0] }}" class="w-[100px] h-[100px] object-cover rounded-lg" alt="">
          <p class="text-sm font-medium text-black dark:text-white">
            {{ $product->name }}
          </p>
        </div>
        <div class="col-span-1 hidden items-center sm:flex">
          {{ $product->is_active ? "Yes" : "No" }}
        </div>
        <div class="col-span-2 flex items-center">
          <p class="text-sm font-medium text-black dark:text-white">
            {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}
          </p>
        </div>
        <div class="col-span-1 flex items-center gap-2">
          <a href="{{ route('products.edit', parameters: $product->id) }}"
            class="bg-yellow-500 text-white inline-block py-1 px-2 rounded-lg hover:bg-yellow-500/90 transition-colors">
            <i class="fa-solid fa-pencil"></i>
          </a>
          <form class="delete-product-form-button" action="{{ route('products.destroy', $product->id) }}" method="POST">
            @method("DELETE")
            @csrf
            <button type="button"
              class="bg-red-500 hover:bg-red-500/90 transition-colors text-white py-1 px-2 rounded-lg">
              <i class="fa-solid fa-trash"></i>
            </button>
          </form>
        </div>
      </div>
      @endforeach
      @endif

    </div>

    <!-- ====== Table Two End -->
  </div>
  <!-- ====== Table Section End -->
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
      $('.delete-product-form-button').on('click', function(e) {
        e.preventDefault()

        Swal.fire({
          title: "Are you sure?",
          text: "This will permanently delete the product!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            $(this).closest('form').submit()
          }
        })
      })
    })
</script>
@endsection