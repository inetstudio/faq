<?php

namespace InetStudio\FAQ\Tags\Services\Front\Traits;

/**
 * Trait TagsServiceTrait.
 */
trait TagsServiceTrait
{
    /**
     * Получаем объекты по тегу.
     *
     * @param  string  $slug
     * @param  array  $params
     *
     * @return mixed
     */
    public function getItemsByTag(string $slug, array $params = [])
    {
        return $this->model
            ->buildQuery($params)
            ->withTags($slug);
    }

    /**
     * Получаем объекты с любыми тегами.
     *
     * @param $tags
     * @param  array  $params
     *
     * @return mixed
     */
    public function getItemsByAnyTag($tags, array $params = [])
    {
        return $this->model
            ->buildQuery($params)
            ->withAnyTags($tags);
    }
}
