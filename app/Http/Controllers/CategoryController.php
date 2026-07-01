<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View {
        $categories = Category::all();

        return view ('categories-list', [
            'categories' => $categories
        ]);
    }


}
