@extends('dashboard.layouts.main')
 
@section('content')
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
      <a href="/dashboard/category/create" class="px-5 py-3 bg-blue-900 font-bold rounded-md text-white hover:bg-blue-800 transition">
        <i class="fa-solid fa-plus"></i> Tambah Kategori</a>
    </div>
  </div>
 
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 mb-3 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Slug
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)               
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $category->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $category->slug }}
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <div class="text-orange-500 flex align-middle">
                            <a href="/dashboard/category/{{ $category->slug }}/edit" class="px-3 py-1 rounded-md hover:bg-orange-900 font-bold transition">
                                <i class="fa-solid fa-pen-nib"></i> Edit</a>
                        </div>
                        <span>|</span>
                        <div class="text-red-500">
                            <form action="/dashboard/category/{{ $category->slug }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded-md hover:bg-red-900 font-bold transition" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
 
@endsection 