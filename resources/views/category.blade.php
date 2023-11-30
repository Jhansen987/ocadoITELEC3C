<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('success')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @php
            $i = 1;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align:center;" scope="col">Id</th>
                    <th style="text-align:center;" scope="col">Category Image</th>
                    <th style="text-align:center;" scope="col">Category Name</th>
                    <th style="text-align:center;" scope="col">Created on</th>
                    <th style="text-align:center;" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($categories as $category)
                <tr>
                    <th style="vertical-align:middle;text-align:center;" scope="row">{{$i}}</th>
                    <td style="vertical-align:middle;text-align:center;"><img src="{{$category->category_image_path}}" alt="" style="width:100px;height:100px;border-radius:4px;margin:auto;"></td>
                    <td style="vertical-align:middle;text-align:center;">{{$category->category_name}}</td>
                    <td style="vertical-align:middle;text-align:center;">{{$category->created_at->diffForHumans()}}</td>
                    <td style="vertical-align:middle;text-align:center;">
                        <button onclick ="window.location.href='{{url('editCategory/'.$category->id)}}';" style="color:#fff;background-color:#2764d8;padding:10px;display:inline-block;">Update</button>
                        <button onclick ="window.location.href='{{url('editCategory/delete/'.$category->id)}}';" style="color:#fff;background-color:#dd3822;padding:10px;display:inline-block;">Delete</button>
                    </td>
                </tr>
                @php
                $i++;
                @endphp
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</x-app-layout>
