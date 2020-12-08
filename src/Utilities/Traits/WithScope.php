<?php

namespace tanyudii\Hero\Utilities\Traits;

use Illuminate\Http\Request;

trait WithScope
{
    /**
     * @param $query
     * @param Request $request
     * @return void
     */
    public function scopeCriteria($query, Request $request) : void
    {
        if ($request->has('order_by')) {
            $sorted = in_array(strtolower($request->get('sorted_by')), ['desc', 'descending']) ? 'desc' : 'asc';
            $order = $request->get('order_by');

            $query->orderBy($order, $sorted);
        }
    }

    /**
     * @param $query
     * @param Request $request
     * @return void
     */
    public function scopeFilter($query, Request $request) : void
    {
        //
    }

    /**
     * @param $query
     * @param Request $request
     * @return void
     */
    public function scopeSubQueryIndex($query, Request $request) : void
    {
        //
    }

    /**
     * @param $query
     * @param Request $request
     * @return void
     */
    public function scopeSubQuerySelect($query, Request $request) : void
    {
        //
    }

    /**
     * @param $query
     * @param Request $request
     * @return void
     */
    public function scopeSubQueryShow($query, Request $request) : void
    {
        //
    }
}