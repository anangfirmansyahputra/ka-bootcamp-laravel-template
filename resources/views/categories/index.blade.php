@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
  <!-- Breadcrumb Start -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
    {{-- <h2 class="text-title-md2 font-bold text-black dark:text-white">
      Tables
    </h2> --}}

    <nav>
      <ol class="flex items-center gap-2">
        <li>
          <a class="font-medium" href="index.html">Dashboard /</a>
        </li>
        <li class="font-medium text-primary">Tables</li>
      </ol>
    </nav>
  </div>
  <!-- Breadcrumb End -->

  <!-- ====== Table Section Start -->
  <div class="flex flex-col gap-10">
    <!-- ====== Table Two Start -->
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
      <div class="px-4 py-6 md:px-6 xl:px-7.5 flex justify-between items-center">
        <h4 class="text-xl font-bold text-black dark:text-white">Categories</h4>

        <button
          class="bg-primary px-10 py-2 rounded-lg text-white hover:bg-primary/90 transition-colors">Create</button>
      </div>

      <div
        class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
        <div class="col-span-4 flex items-center">
          <p class="font-medium">Name</p>
        </div>
        <div class="col-span-2 hidden items-center sm:flex">
          <p class="font-medium">Active</p>
        </div>
        <div class="col-span-1 flex items-center">
          <p class="font-medium">Created At</p>
        </div>
        <div class="col-span-1 flex items-center">
          <p class="font-medium">Action</p>
        </div>
      </div>

      @foreach ($categories as $category)
      <div
        class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
        <div class="col-span-4 flex items-center">
          <p class="text-sm font-medium text-black dark:text-white">
            {{ $category->name }}
          </p>
        </div>
        <div class="col-span-2 hidden items-center sm:flex">
          @if ($category->is_active)
          <button
            class="inline-flex rounded-full bg-[#3CA745] px-3 py-1 text-sm font-medium text-white hover:bg-opacity-90">
            Active
          </button>
          @else
          <button
            class="inline-flex rounded-full bg-[#DC3545] px-3 py-1 text-sm font-medium text-white hover:bg-opacity-90">
            Non Active
          </button>
          @endif
        </div>
        <div class="col-span-1 flex items-center">
          <p class="text-sm font-medium text-black dark:text-white">
            {{ \Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
          </p>
        </div>
        <div class="col-span-1 flex items-center">

        </div>
      </div>
      @endforeach

    </div>

    <!-- ====== Table Two End -->
  </div>
  <!-- ====== Table Section End -->
</div>
@endsection