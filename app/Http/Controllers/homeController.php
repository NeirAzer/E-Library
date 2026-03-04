<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $title = 'Homepage';
        $books = Book::latest('publication_at')->take(6)->get();

        $colorClasses = [
            'bg-red-100 text-red-800',
            'bg-green-100 text-green-800',
            'bg-blue-100 text-blue-800',
            'bg-yellow-100 text-yellow-800',
            'bg-purple-100 text-purple-800',
            'bg-pink-100 text-pink-800',
        ];

        foreach ($books as $book) {
            $categoryId = $book->category->id;
            $colorindex = $categoryId % count($colorClasses);
            $book->category->color = $colorClasses[$colorindex];
        }

        return view('homepage', compact('title', 'books'));
    }
}
