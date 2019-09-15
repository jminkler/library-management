<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Queries\StatusQuery;
use App\Transformers\StatusTransformer;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $page = $request->page ?: 1;
        $offset = $perPage * $page;

        $statuses = StatusQuery::recent()
            ->offset($offset)
            ->paginate($perPage);

        return $this->response->withPaginator(
            $statuses,
            new StatusTransformer
        );
    }
}
