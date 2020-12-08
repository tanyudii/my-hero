<?php

namespace tanyudii\Hero\Utilities\Traits;

use Nicolaslopezj\Searchable\SearchableTrait;

trait WithSearchable
{
    use SearchableTrait;

    /**
     * @return array
     */
    public function getSearchable() : array
    {
        if (isset($this->searchable)) {
            return $this->searchable;
        }

        return [];
    }
}
