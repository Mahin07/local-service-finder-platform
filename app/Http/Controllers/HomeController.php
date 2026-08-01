<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        try {
            $categories = Category::query()
                ->where('status', 1)
                ->orderBy('name')
                ->get();
        } catch (Throwable $exception) {
            $categories = collect();
        }

        return view('user.index', [
            'categories' => $categories,
        ]);
    }
}
