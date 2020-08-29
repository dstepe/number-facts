<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nipwaayoni\ElasticApmLaravel\Middleware\RecordTransaction;

class CustomRecordTransaction extends RecordTransaction
{
    protected function userContext(Request $request): array
    {
        $context = parent::userContext($request);

        if (empty($context['username'])) {
            $context['username'] = 'anonymous';
        }

        return $context;
    }

    protected function customContext(Request $request, Response $response): array
    {
        return [
            'my-key' => 'some value'
        ];
    }


}
