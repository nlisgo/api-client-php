<?php

namespace spec\eLife\ApiSdk\ApiClient;

use eLife\ApiSdk\HttpClient;
use eLife\ApiSdk\MediaType;
use eLife\ApiSdk\Result\ArrayResult;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Psr7\Request;
use PhpSpec\ObjectBehavior;

final class PodcastClientSpec extends ObjectBehavior
{
    private $httpClient;

    public function let(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        $this->beConstructedWith($httpClient);
    }

    public function it_gets_a_podcast_episode()
    {
        $request = new Request('GET', 'podcast-episodes/3',
            ['Accept' => 'application/vnd.elife.podcast-episode+json; version=2']);
        $response = new FulfilledPromise(new ArrayResult(new MediaType('application/vnd.elife.podcast-episode+json',
            2), ['foo' => ['bar', 'baz']]));

        $this->httpClient->send($request)->willReturn($response);

        $this->getEpisode(2, 3)->shouldBeLike($response);
    }

    public function it_lists_episodes()
    {
        $request = new Request('GET', 'podcast-episodes?page=1&per-page=20&order=desc&subject=cell-biology',
            ['Accept' => 'application/vnd.elife.podcast-episode-list+json; version=2']);
        $response = new FulfilledPromise(new ArrayResult(new MediaType('application/vnd.elife.podcast-episode-list+json',
            2), ['foo' => ['bar', 'baz']]));

        $this->httpClient->send($request)->willReturn($response);

        $this->listEpisodes(2, 1, 20, true, 'cell-biology')->shouldBeLike($response);
    }
}