<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        $title = 'Hall';
        $books = Book::all();

        return view('hall', [
            'title' => $title,
            'books' => $books
        ]);
    }

    public function singleBook(Book $book)
    {
        $title = $book->name;
        return dd($book);
    }

    public function hallCategory(Category $category)
    {
        $books = Book::where('category_id', $category->id)->get();
        $title = 'Books of ' . $category->name;
        return view(
            'hall',
            compact('title', 'books')
        );
    }

    public function hallAuthor(Author $author)
    {
        $books = Book::where('author_id', $author->id)->get();
        $title = 'Books by ' . $author->name;
        return view(
            'hall',
            compact('title', 'books')
        );
    }
}
