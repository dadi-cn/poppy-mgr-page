<?php namespace Poppy\Area\Models\Filters;

use EloquentFilter\ModelFilter;

/**
 * 地区filter
 */
class AreaContentFilter extends ModelFilter
{
    /**
     * @param int $parent_id 父级id
     * @return $this
     */
    public function parent($parent_id)
    {
        $parent_id = (int) $parent_id;

        return $this->where('parent_id', $parent_id);
    }

    /**
     * @param int $id id
     * @return $this
     */
    public function id($id)
    {
        return $this->where('parent_id', $id);
    }

    /**
     * @param string $title 标题
     * @return $this
     */
    public function title($title)
    {
        return $this->where('title', $title);
    }
}