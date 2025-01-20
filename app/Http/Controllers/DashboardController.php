<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $search = $request->get('search', '');

        $posts = Post::where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%')
            ->orderBy($sortField, $sortDirection)
            ->paginate(10);

        return view('dashboard', compact('posts', 'sortField', 'sortDirection', 'search'));
    }
}
