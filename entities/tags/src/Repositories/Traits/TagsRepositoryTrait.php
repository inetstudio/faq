<?php

namespace InetStudio\FAQ\Tags\Repositories\Traits;

/**
 * Trait TagsRepositoryTrait.
 */
trait TagsRepositoryTrait
{
    /**
     * Получаем объекты по тегу.
     *
     * @param string $slug
     * @param array $params
     *
     * @return mixed
     */
    public function getItemsByTag(string $slug, array $params = [])
    {
        $builder = $this->getItemsQuery($params)
            ->withTags($slug);

        return $builder->get();
    }

    /**
     * Получаем объекты с любыми тегами.
     *
     * @param $tags
     * @param array $params
     *
     * @return mixed
     */
    public function getItemsByAnyTag($tags, array $params = [])
    {
        $builder = $this->getItemsQuery($params)
            ->withAnyTags($tags, 'faq_tags.slug');

        return $builder->get();
    }
}
