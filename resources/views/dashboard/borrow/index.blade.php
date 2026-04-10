@extends('dashboard.layouts.main')

@section('content')
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-9 p-4">
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-11 p-4">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 mb-3 px-4 py-3 rounded relative"
                    role="alert">
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
                                Nama Peminjam
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Buku
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Peminjaman
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Deadline
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($borrows->count())
                            @foreach ($borrows as $borrow)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $borrow->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img class="w-11" src="" alt="">
                                        {{ $borrow->book->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $borrow->borrow_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $borrow->due_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 capitalize text-black font-bold">
                                        @if ($borrow->status == 'diajukan')
                                            <p class="bg-yellow-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                        @elseif ($borrow->status == 'dipinjam')
                                            <p class="bg-green-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                        @elseif ($borrow->status == 'dikembalikan')
                                            <p class="bg-blue-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                        @elseif ($borrow->status == 'ditolak')
                                            <p class="bg-red-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        @if ($borrow->status == 'diajukan' || $borrow->status == 'dipinjam')
                                            <div class="text-yellow-500 hover:cursor-pointer hover:bg-yellow-300 hover:text-black p-1 rounded-sm transition">
                                                <a href="/dashboard/borrow/{{ $borrow->id }}/edit"><i
                                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                                            </div>
                                        @elseif ($borrow->status == 'ditolak' || $borrow->status == 'dikembalikan')
                                            <div class="text-rose-500">
                                                <form action="/dashboard/borrow/{{ $borrow->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="hover:cursor-pointer hover:bg-red-500 hover:text-black p-1 rounded-sm transition"
                                                        onclick="return confirm('Are you sure?')" type="submit"><i
                                                            class="fa-solid fa-trash"></i> Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td colspan="9" class="text-center p-4 font-semibold">
                                    Tidak ada Peminjaman
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
