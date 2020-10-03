<?php


namespace App\MiamiOH;


use Illuminate\Support\Facades\DB;

class Stats
{
    /**
     * @var StatApiClient
     */
    private $client;

    public function __construct(StatApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Handle API requests to increment the counter
     *
     * @param StatIncrementRequest $request
     */
    public function increment(StatIncrementRequest $request): void
    {
        $source = $request->source();

        DB::table('stats')->insertOrIgnore([
            ['source' => $source, 'count' => 0],
        ]);

        DB::table('stats')->where('source', '=', $source)->increment('count');
    }

    /**
     * Handle API requests to get the current count
     * @param string $source
     * @return int
     */
    public function get(string $source): int
    {
        $count = DB::table('stats')->where('source', '=', $source)->value('count');

        return $count ?? 1;
    }

    public function incrementCount(string $source): void
    {
        $this->client->incrementCount($source);
    }

    public function getCount(string $source): int
    {
        return $this->client->getCount($source);
    }
}
