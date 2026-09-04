<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\BackgroundImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:240'],
            'background_type' => ['nullable', 'string', 'in:couleur,degrade,image'],
            'background_value' => ['nullable', 'string', 'max:191'],
            'background_image_id' => ['nullable', 'integer'],
        ]);

        $backgroundImageId = null;

        if (($validated['background_type'] ?? null) === 'image') {
            $backgroundImageId = BackgroundImage::where('id', $validated['background_image_id'] ?? null)
                ->where('is_active', true)
                ->value('id');

            if (!$backgroundImageId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image de fond non autorisée.',
                ], 422);
            }
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'type' => 'card',
            'content' => $validated['content'],
            'background_type' => $validated['background_type'] ?? null,
            'background_value' => ($validated['background_type'] ?? null) === 'image' ? null : ($validated['background_value'] ?? null),
            'background_image_id' => $backgroundImageId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Publication créée avec succès',
            'html' => view('components.post-card', ['post' => $post->load('user', 'backgroundImage')])->render(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:240'],
            'background_type' => ['nullable', 'string', 'in:couleur,degrade,image'],
            'background_value' => ['nullable', 'string', 'max:191'],
            'background_image_id' => ['nullable', 'integer'],
        ]);

        $backgroundImageId = null;

        if (($validated['background_type'] ?? null) === 'image') {
            $backgroundImageId = BackgroundImage::where('id', $validated['background_image_id'] ?? null)
                ->where('is_active', true)
                ->value('id');

            if (!$backgroundImageId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image de fond non autorisée.',
                ], 422);
            }
        }

        $post->update([
            'content' => $validated['content'],
            'background_type' => $validated['background_type'] ?? null,
            'background_value' => ($validated['background_type'] ?? null) === 'image' ? null : ($validated['background_value'] ?? null),
            'background_image_id' => $backgroundImageId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Publication modifiée avec succès',
            'html' => view('components.post-card', ['post' => $post->fresh()->load('user', 'backgroundImage')])->render(),
        ]);
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return response()->json(['success' => true]);
    }
}
