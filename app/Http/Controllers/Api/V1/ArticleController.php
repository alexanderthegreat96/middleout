<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ArticleRequest;
use App\Interfaces\Api\V1\ArticleRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepositoryInterface
     */
    private ArticleRepositoryInterface $articleRepository;

    /**
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository) {
        return $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $keyword = '';

        if($request->has('search')) {
            $keyword = $request->get('search');
        }

        $data = $this->articleRepository->getAllArticles($keyword);

//        $cached = Cache::get('articles');
//        if($cached) {
//            if(count($data) != count($cached)) {
//
//            }
//        } else {
//            Cache::forever('articles', json_encode($data));
//        }

        return response()->json([
            'data' => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request) : JsonResponse
    {
        $articleData = $request->only(['title', 'body', 'user_id']);

        return response()->json([
            'data' => $this->articleRepository->createArticle($articleData)
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->articleRepository->getArticleById($id)
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $articleData = $request->only(['title', 'body', 'user_id']);

        return response()->json([
            'data' => $this->articleRepository->updateArticle($id,$articleData)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->articleRepository->deleteArticle($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @return JsonResponse
     */
    public function count(){
        return response()->json([
            'data' => $this->articleRepository->countArticles()
        ]);
    }
}
