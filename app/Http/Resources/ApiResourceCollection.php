<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Classes\ApiPaginatedResourceResponse;

class ApiResourceCollection extends ResourceCollection
{
    /**
     * Override the toResponse method to use ApiPaginatedResourceResponse.
     *
     * @param \Illuminate\Http\Request $request
     * @return App\Classes\ApiPaginatedResourceResponse|\Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return $this->resource instanceof \Illuminate\Pagination\AbstractPaginator
            ? (new ApiPaginatedResourceResponse($this))->toResponse($request)
            : parent::toResponse($request);
    }
}
