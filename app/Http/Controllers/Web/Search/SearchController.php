<?php

namespace App\Http\Controllers\Web\Search;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->get('q');

        if(!$query || strlen($query) < 1 || strlen($query) > 255) return redirect('/');

        $data = User::where('username', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->limit(30)->get();

        return view('pages/other/search', compact('data'), ['query' => $query]);
    }
}
