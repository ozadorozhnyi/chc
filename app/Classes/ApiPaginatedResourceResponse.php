<?php

namespace App\Classes;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class ApiPaginatedResourceResponse extends PaginatedResourceResponse
{
    protected function paginationLinks($paginated)
    {
        return [
            'next' => $paginated['next_page_url'] ?? null,
            'prev' => $paginated['prev_page_url'] ?? null,
            'first' => $paginated['first_page_url'] ?? null,
            'last' => $paginated['last_page_url'] ?? null,
        ];
    }

    protected function meta($paginated)
    {
        return [
            'current_page' => $paginated['current_page'] ?? null,
            'last_page' => $paginated['last_page'] ?? null,
            'per_page' => $paginated['per_page'] ?? null,
            'from' => $paginated['from'] ?? null,
            'to' => $paginated['to'] ?? null,
            'total_items' => $paginated['total'] ?? null,
        ];
    }

    public function toResponse($request)
    {
        $data = $this->wrap(
            $this->resource->resolve(),
            array_merge_recursive([
                'pagination' => [
                    'meta' => $this->meta($this->resource->resource->toArray()),
                    'links' => $this->paginationLinks($this->resource->resource->toArray()),
                ],
            ], $this->resource->with($request)),
        );

        return tap(response()->json($data, $this->calculateStatus()
        ), function ($response) use ($request) {
            $this->resource->withResponse($request, $response);
        });
    }
}
