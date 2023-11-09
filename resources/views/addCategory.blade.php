<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="insertCategory" method="post">
            @csrf
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
             <label for="userID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userID" name="userID">
            </div>
            <button type="number" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</x-app-layout>
