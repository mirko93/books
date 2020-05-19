<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {
        $data = $this->validateRequest();

        Book::create($this->validateRequest());
    }

    public function update(Book $book)
    {
        $data = $this->validateRequest();

        $book->update($this->validateRequest());
    }

    /**
     * @return mixed
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }
}
