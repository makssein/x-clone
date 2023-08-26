<?php

namespace App\Http\Controllers\Web\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreateRequest;
use App\Models\PostsModel;
use App\Models\User;

class PostsController extends Controller {
    public function feed() {
        return auth()->user()->feed();
    }

    public function get($id) {
        return User::find($id)->posts;
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
