@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
  <!-- Breadcrumb Start -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
      Create Product
    </h2>

    <nav>
      <ol class="flex items-center gap-2">
        <li>
          <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
        </li>
        <li>
          <a class="font-medium" href="{{ route('products.index') }}">Products /</a>
        </li>
        <li class="font-medium text-primary">Create</li>
      </ol>
    </nav>
  </div>
  <!-- Breadcrumb End -->

  <!-- ====== Form Layout Section Start -->
  <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
    <div class="flex flex-col gap-9">
      <!-- Contact Form Two -->
      <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
          <h3 class="font-medium text-black dark:text-white">
            Product Form
          </h3>
        </div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
          <div class="p-6.5">
            <div class="mb-5 flex flex-col gap-6 xl:flex-row">
              <div class="w-full xl:w-1/2">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                  Name
                </label>
                <input type="text" placeholder="Name" name="name" value="{{ $product->name ?? old('name') }}"
                  class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
              </div>

              <div class="w-full xl:w-1/2">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                  Price
                </label>
                <input type="number" placeholder="0" name="price" value="{{ $product->price ?? old('price') }}"
                  class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
              </div>
            </div>

            <div class="mb-5.5 flex flex-col gap-6 xl:flex-row">
              <div class="w-full xl:w-1/2">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                  Company
                </label>
                <input type="text" placeholder="Company" name="company"
                  value="{{ $product->company ?? old('company') }}"
                  class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
              </div>

              <div class="w-full xl:w-1/2">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                  Active
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                  <select name="is_active"
                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <option value="1" {{ (isset($product) ? $product->is_active : old('active', 1)) == 1 ? 'selected'
                      :
                      '' }}
                      class="text-body">Yes</option>
                    <option value="0" {{ (isset($product) ? $product->is_active : old('active', 1)) == 0 ? 'selected'
                      :
                      '' }}
                      class="text-body">No</option>

                  </select>
                  <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <g opacity="0.8">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                          fill=""></path>
                      </g>
                    </svg>
                  </span>
                </div>
              </div>
            </div>

            <div class="mb-5.5">
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Category
              </label>
              <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                <select name="category_id"
                  class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

                  @foreach ($categories as $category)
                  <option {{ $product->category_id ?? old('category_id') == $category->id ? 'selected'
                    : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach

                </select>
                <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                  <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.8">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                        fill=""></path>
                    </g>
                  </svg>
                </span>
              </div>
            </div>

            <div class="mb-6">
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Description
              </label>
              <textarea rows="6" placeholder="Description" name="description"
                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">{{ $product->description ?? old('description') }}</textarea>
            </div>

            <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="flex flex-col gap-9">
      <!-- Contact Form Two -->
      <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="border-b border-stroke px-6.5 py-4 flex items-center justify-between dark:border-strokedark">
          <h3 class="font-medium text-black dark:text-white">
            Images
          </h3>
          <button id="addImageBtn" class="bg-primary text-white rounded-lg px-4 py-2">Add Image</button>
        </div>

        <div>
          <input type="file" accept="image/*" id="imageUpload" class="hidden">
        </div>

        <div id="imagePreview" class="grid grid-cols-2 gap-5.5 p-6.5">

        </div>
      </div>
    </div>
  </div>
  <!-- ====== Form Layout Section End -->

</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    var token = document.head.querySelector('meta[name="csrf-token"]').content;
    const images = [];

    function displayImages() {
      $('#imagePreview').empty(); // Bersihkan preview gambar yang sebelumnya

      // Loop untuk menampilkan gambar yang ada dalam array
      images.forEach((file, index) => {
        const reader = new FileReader(); // Membaca file sebagai URL

        reader.onload = function(e) {
          const diplayImage = $(
            `<div class="relative">
              <img class="rounded-lg object-cover aspect-square" alt="Image Preview" src=${e.target.result} />
              <button data-index=${index} class="delete-image-button bg-red-500 hover:bg-red-500/90 py-2 px-3.5 text-white rounded-full absolute -top-2 -right-2">
                <i class="fa-solid fa-x"></i>
              </button>
            </div>`)

          $('#imagePreview').append(diplayImage);
        };

        reader.readAsDataURL(file); 
      });
    }

    function deleteImages(index) {
      images.splice(index,1)
      displayImages()
    }

    $('#addImageBtn').click(function() {
      $('#imageUpload').click();
    });

  
    $('#imageUpload').change(function(event) {
      const file = event.target.files[0]; 
      if (file) {
        images.push(file);
        displayImages();
      }
    });

    $('.delete-image-button').click(function(event) {
     const index =  $(this).attr("data-index")
     deleteImages(index)
    })

    $(document).on('click', '.delete-image-button', async function(event) {
      const result = await Swal.fire({
        title: "Do you want to delete this image?",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `No`
      })

      if (result.isConfirmed) {
        const index = $(this).attr('data-index')
        deleteImages(index)
        Swal.fire("Success", "", "success")
      }
      
    })

    $('form').submit(function(event) {
      event.preventDefault()
      const formData = new FormData(this)

      images.forEach((file, index) => {
        formData.append("images[]",file)
      })

      $.ajax({
        url: '{{ route('products.store') }}',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
      })
    })
  });
</script>
@endsection