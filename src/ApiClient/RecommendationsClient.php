<?php

namespace eLife\ApiClient\ApiClient;

use eLife\ApiClient\ApiClient;
use GuzzleHttp\Promise\PromiseInterface;

final class RecommendationsClient
{
    const TYPE_RECOMMENDATIONS = 'application/vnd.elife.recommendations+json';

    use ApiClient;

    public function list(
        array $headers,
        string $type,
        string $id,
        int $page = 1,
        int $perPage = 20,
        bool $descendingOrder = true
    ) : PromiseInterface {
        return $this->getRequest(
            'recommendations/'.$type.'/'.$id.'?page='.$page.'&per-page='.$perPage.'&order='.($descendingOrder ? 'desc' : 'asc'),
            $headers
        );
    }
}
