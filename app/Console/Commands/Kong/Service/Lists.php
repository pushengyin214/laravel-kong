<?php

namespace App\Console\Commands\Kong\Service;

use App\Console\Kong;
use App\Support\Clients\KongClient;

class Lists extends Kong
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kong:service:lists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'kong lists';

    /**
     * @var array
     */
    public $params = [
        'offset' => 'A cursor used for pagination. offset is an object identifier that defines a place in the list.',
        'size' => 'A limit on the number of objects to be returned per page.',
    ];

    /**
     * @return mixed|void
     */
    public function init()
    {
        $client = KongClient::getInstance();
        $res = $client->services([
            'size' => 2,
        ]);

        $next = $res['next'];
        $data = $res['data'];

        dump("next: {$next}");
        dump("data:");
        foreach ($data as $item) {
            foreach ($item as $key => $val) {
                dump("{$key}: {$val}");
            }
            echo PHP_EOL;
        }
    }
}