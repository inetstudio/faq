<?php

namespace InetStudio\FAQ\Tags\Models\Traits;

use ArrayAccess;
use Illuminate\Support\Collection;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;

/**
 * Trait HasTagsCollection.
 */
trait HasTagsCollection
{
    /**
     * Determine if the model has any the given tags.
     *
     * @param  int|string|array|ArrayAccess|TagModelContract  $tags
     *
     * @return bool
     */
    public function hasTag($tags): bool
    {
        if ($this->isTagsStringBased($tags)) {
            return ! $this->tags->pluck('name')->intersect((array) $tags)->isEmpty();
        }

        if ($this->isTagsIntBased($tags)) {
            return ! $this->tags->pluck('id')->intersect((array) $tags)->isEmpty();
        }

        if ($tags instanceof TagModelContract) {
            return $this->tags->contains('name', $tags['name']);
        }

        if ($tags instanceof Collection) {
            return ! $tags->intersect($this->tags->pluck('name'))->isEmpty();
        }

        return false;
    }

    /**
     * Determine if the model has any the given tags.
     *
     * @param  int|string|array|ArrayAccess|TagModelContract  $tags
     *
     * @return bool
     */
    public function hasAnyTag($tags): bool
    {
        return $this->hasTag($tags);
    }

    /**
     * Determine if the model has all of the given tags.
     *
     * @param  int|string|array|ArrayAccess|TagModelContract  $tags
     *
     * @return bool
     */
    public function hasAllTags($tags): bool
    {
        if ($this->isTagsStringBased($tags)) {
            $tags = (array) $tags;

            return $this->tags->pluck('name')->intersect($tags)->count() == count($tags);
        }

        if ($this->isTagsIntBased($tags)) {
            $tags = (array) $tags;

            return $this->tags->pluck('id')->intersect($tags)->count() == count($tags);
        }

        if ($tags instanceof TagModelContract) {
            return $this->tags->contains('name', $tags['name']);
        }

        if ($tags instanceof Collection) {
            return $this->tags->intersect($tags)->count() == $tags->count();
        }

        return false;
    }

    /**
     * Determine if the given tag(s) are string based.
     *
     * @param  int|string|array|ArrayAccess|TagModelContract  $tags
     *
     * @return bool
     */
    protected function isTagsStringBased($tags): bool
    {
        return is_string($tags) || (is_array($tags) && isset($tags[0]) && is_string($tags[0]));
    }

    /**
     * Determine if the given tag(s) are integer based.
     *
     * @param  int|string|array|ArrayAccess|TagModelContract  $tags
     *
     * @return bool
     */
    protected function isTagsIntBased($tags): bool
    {
        return is_int($tags) || (is_array($tags) && isset($tags[0]) && is_int($tags[0]));
    }
}
