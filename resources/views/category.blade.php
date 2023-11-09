<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @php
            $i = 1;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Created on</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->user_id}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
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
