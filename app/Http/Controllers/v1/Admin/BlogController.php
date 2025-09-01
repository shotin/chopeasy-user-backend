<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Support\Str;
use App\Helpers\ImageKitHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Services\Blog\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        return response()->json($this->blogService->all($filters));
    }

    public function show($id)
    {
        return response()->json($this->blogService->find($id));
    }

    public function store(StoreBlogRequest $request)
    {
        try {
            $data = $request->validated();

            if (empty($data['image'])) {
                return response()->json(['message' => 'Image is required.'], 422);
            }

            $imageUrl = ImageKitHelper::uploadBase64Image(
                $data['image'],
                'blog_' . Str::slug($data['title'])
            );
            $data['image'] = $imageUrl;

            $blog = $this->blogService->create($data);

            return response()->json($blog, 201);
        } catch (\Throwable $e) {
            // Log::error('Blog Store Error', [
            //     'error' => $e->getMessage(),
            //     'exception' => get_class($e),
            //     'file' => $e->getFile(),
            //     'line' => $e->getLine(),
            //     'trace' => $e->getTraceAsString()
            // ]);
            return response()->json([
                'message' => 'Failed to create blog',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id, UpdateBlogRequest $request)
    {
        try {
            $data = $request->validated();

            if (!empty($data['image'])) {
                $imageUrl = ImageKitHelper::uploadBase64Image($data['image'], 'blog_' . Str::slug($data['title']));
                $data['image'] = $imageUrl;
            }
            $blog = $this->blogService->find($id);
            if (!$blog) {
                return response()->json(['message' => 'Blog not found'], 404);
            }
            $blog = $this->blogService->update($data, $id);

            return response()->json($blog);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to update blog', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $this->blogService->delete($id);
        return response()->json(['message' => 'Blog deleted']);
    }
}
