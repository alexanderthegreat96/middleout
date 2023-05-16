<?php
namespace App\Interfaces\Api\V1;

interface ArticleRepositoryInterface
{
    /**
     * @param string $keyword
     * @return mixed
     */
    public function getAllArticles(string $keyword = '');

    /**
     * @param int $articleId
     * @return mixed
     */
    public function getArticleById(int $articleId = 0);

    /**
     * @param array $articleData
     * @return mixed
     */
    public function createArticle(array $articleData = []);

    /**
     * @param int $articleId
     * @param array $articleData
     * @return mixed
     */
    public function updateArticle(int $articleId = 0, array $articleData = []);

    /**
     * @param int $articleId
     * @return mixed
     */
    public function deleteArticle(int $articleId = 0);

    /**
     * @return mixed
     */
    public function countArticles();
}
