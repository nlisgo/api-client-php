<?php

namespace eLife\ApiClient\ApiClient;

use eLife\ApiClient\ApiClient;
use GuzzleHttp\Promise\PromiseInterface;

final class InterviewsClient
{
    const TYPE_INTERVIEW = 'application/vnd.elife.interview+json';
    const TYPE_INTERVIEW_LIST = 'application/vnd.elife.interview-list+json';

    use ApiClient;

    public function getInterview(array $headers, string $id) : PromiseInterface
    {
        return $this->getRequest('interviews/'.$id, $headers);
    }

    public function listInterviews(
        array $headers = [],
        int $page = 1,
        int $perPage = 20,
        bool $descendingOrder = true
    ) : PromiseInterface {
        return $this->getRequest(
            'interviews?page='.$page.'&per-page='.$perPage.'&order='.($descendingOrder ? 'desc' : 'asc'),
            $headers
        );
    }
}
