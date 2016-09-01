<?php

namespace eLife\ApiClient\ApiClient;

use eLife\ApiClient\ApiClient;
use GuzzleHttp\Promise\PromiseInterface;

final class SearchClient
{
    const TYPE_SEARCH = 'application/vnd.elife.search+json';

    use ApiClient;

    public function query(
        array $headers = [],
        string $query = '',
        int $page = 1,
        int $perPage = 20,
        string $sort = 'relevance',
        bool $descendingOrder = true,
        array $subjects = [],
        array $types = []
    ) : PromiseInterface {
        $subjectQuery = '';
        foreach ($subjects as $subject) {
            $subjectQuery .= '&subject[]='.$subject;
        }
        $typeQuery = '';
        foreach ($types as $type) {
            $typeQuery .= '&type[]='.$type;
        }

        return $this->getRequest(
            'search?for='.$query.'&page='.$page.'&per-page='.$perPage.'&sort='.$sort.'&order='.($descendingOrder ? 'desc' : 'asc').$subjectQuery.$typeQuery,
            $headers
        );
    }
}
