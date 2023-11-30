<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{url('editCategory/update/'.$categories->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- For image upload -->
            <div class="mb-3">
                <label for="categoryName" class="form-label">Upload Category Image</label>
                <input type="file" class="form-control" id="categoryImage" name="categoryImage" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" aria-describedby="emailHelp" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</x-app-layout>
