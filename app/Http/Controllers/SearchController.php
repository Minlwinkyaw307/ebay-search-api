<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchIndexRequest;
use App\Service\EBaySearchByKeywordsService;
use App\Service\EBayService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SearchController extends Controller
{
    /**
     * @param SearchIndexRequest $request
     * @return JsonResponse
     */
    public function index(SearchIndexRequest $request): JsonResponse
    {
        $eBayService = new EBaySearchByKeywordsService(env("EBAY_SERVICE_URL"));

        return response()->json(
            $eBayService->search(
                $request->get('keywords'),
                $request->except('keywords')
            )
        );
    }
}
