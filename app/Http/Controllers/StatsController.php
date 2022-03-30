<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatIncrement;
use App\MiamiOH\Stats;

class StatsController extends Controller
{
    /**
     * @var Stats
     */
    private $stats;

    public function __construct(Stats $stats)
    {
        $this->stats = $stats;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StatIncrement $request)
    {
        try {
            $this->stats->increment($request);
        } catch (\Throwable $e) {
            return response()->json(null, 400);
        }

        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $source)
    {
        $count = $this->stats->get($source);

        return response()->json(['source' => $source, 'count' => $count]);
    }
}
