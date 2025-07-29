<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyword;
use App\Services\VectorService;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $vectorService = new VectorService();
        $queryEmbedding = $vectorService->getEmbedding($query);

        $bestMatch = null;
        $highestScore = 0;

        foreach (Keyword::all() as $keyword) {
            if (!$keyword->embedding) continue;
            $score = $vectorService->cosineSimilarity($queryEmbedding, $keyword->embedding);
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $keyword;
            }
        }

        return view('search', [
            'query' => $query,
            'result' => $bestMatch,
            'score' => round($highestScore, 3),
        ]);
    }
}
