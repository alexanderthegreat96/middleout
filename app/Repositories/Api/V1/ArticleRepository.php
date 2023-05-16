<?php

namespace App\Repositories\Api\V1;


use App\Interfaces\Api\V1\ArticleRepositoryInterface;
use App\Models\Api\V1\Article;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @param array $articleData
     * @return array|true[]
     */
    public function createArticle(array $articleData = [])
    {
        try {
            DB::insert(
                'insert into articles (title, body, user_id, published_at) values (?, ?, ?, ?)',
                [$articleData['title'], $articleData['body'], $articleData['user_id'], date('Y-m-d H:i:s')]
            );

            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }

    public function updateArticle(int $articleId = 0, array $articleData = [])
    {
        return Article::whereId($articleId)->update($articleData);
    }

    /**
     * @param int $articleId
     * @return mixed
     */
    public function getArticleById(int $articleId = 0)
    {
        return Article::findOrFail($articleId);
    }


    /**
     * @param string $keyword
     * @return \Illuminate\Support\Collection
     */
    public function getAllArticles(string $keyword = '')
    {
        $articles = DB::table('articles');
        $articles = $articles->select('articles.id as articleId', 'articles.title as articleTitle', 'users.email as userMail');

        if ($keyword) {
            $articles->orWhere('articles.title', 'LIKE', '%' . $keyword . '%');
            $articles->orWhere('articles.body', 'LIKE', '%' . $keyword . '%');
        }

        $articles = $articles->leftJoin('users', 'articles.user_id', '=', 'users.id');
        $articles = $articles->orderByDesc('published_at');
        return $articles->get();
    }

    /**
     * @param int $articleId
     * @return void
     */
    public function deleteArticle(int $articleId = 0)
    {
        Article::destroy($articleId);
    }

    /**
     * @return \Illuminate\Support\Collection|mixed
     */
    public function countArticles()
    {
       return DB::table('articles')->select(DB::raw("count(id) as count"))->get();
    }
}
