@extends('dashboard.layouts.main')
 
@section('content')
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
      <a href="/dashboard/author/create" class="px-5 py-3 bg-blue-900 font-bold rounded-md text-white hover:bg-blue-800 transition">
        <i class="fa-solid fa-user-plus"></i> Tambah Author</a>
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
                        Nama Author
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
                @if ($authors->count())
                    
                @foreach ($authors as $author)               
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $author->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $author->slug }}
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <div class="text-orange-500 flex align-middle">
                            <a href="/dashboard/author/{{ $author->slug }}/edit" class="px-3 py-1 rounded-md hover:bg-orange-900 font-bold transition">
                                <i class="fa-solid fa-user-pen"></i> Edit</a>
                        </div>
                        <span>|</span>
                        <div class="text-red-500">
                            <form action="/dashboard/author/{{ $author->slug }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded-md hover:bg-red-900 font-bold transition" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-user-slash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td colspan="9" class="text-center p-4 font-semibold">
                        Tidak ada data
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-8">
            {{ $authors->links() }}
        </div>
      </div>
    </div>
  </div>
 
@endsection 