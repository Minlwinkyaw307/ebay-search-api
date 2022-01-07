<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchIndexRequest;
use App\Service\EBayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param SearchIndexRequest $request
     * @param EBayService $bayService
     * @return JsonResponse
     */
    public function index(SearchIndexRequest $request, EBayService $bayService): JsonResponse
    {
        return response()->json(
            $bayService->search(
                $request->get('keywords'),
                $request->only('price_min', 'price_max', 'sorting')
            )
        );
    }
}
