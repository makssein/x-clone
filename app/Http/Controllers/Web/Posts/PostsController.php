<?php

namespace App\Http\Controllers\Web\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreateRequest;
use App\Models\PostsModel;

class PostsController extends Controller {
    public function get() {
        return auth()->user()->feed();
    }

    public function create(CreateRequest $request) {
        $post = PostsModel::create([
            'user_id' => auth()->id(),
            'text' => $request->post('text')
        ]);

        if($post) {
            $post['user'] = auth()->user();
            return response()->json([
                'status' => true,
                'type' => "success",
                'message' => 'Пост успешно создан.',
                'object' => $post
            ]);
        }

        return response()->json([
            'status' => false,
            'type' => "error",
            'message' => 'Произошла ошибка. Попробуйте еще раз.'
        ]);
    }
}
