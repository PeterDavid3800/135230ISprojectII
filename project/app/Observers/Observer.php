<?php

namespace App;

use App\Models\Crawler;
use Psr\Http\Message\UriInterface;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Spatie\Crawler\CrawlObservers\CrawlObserver;

class Observer extends CrawlObserver
{
    /**
     * Called when the crawler will crawl the url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     */
    public function willCrawl(UriInterface $url)
    {
        // You can add any logic you need before crawling the URL
    }

    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null
    ): void {
        // Create records or perform any other actions for successful crawls
        $crawl = Crawler::updateOrCreate([
            'url' => $url->__toString() // Convert the URL to a string
        ], [
            'status' => $response->getStatusCode()
        ]);
    }

    /**
     * Called when the crawler had a problem crawling the given url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \GuzzleHttp\Exception\RequestException $requestException
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    ): void {
        // Log the URL that failed to crawl
        Log::error('crawlFailed: ' . $url->__toString());
    }

    /**
     * Called when the crawl has ended.
     */
    public function finishedCrawling(): void
    {
        // You can perform any cleanup or additional actions after crawling is finished
    }
}
