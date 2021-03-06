<?php

namespace App\Jobs;

use App\Domain;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class AnalyzeDomainJob extends Job
{
    protected $domain;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = app('HttpClient');
        try {
            $response = $client->get($this->domain->name);
            $status = $response->getStatusCode();
            $contentLength = $response->getHeader('Content-Length')[0] ?? null;
            $bodyString = $response->getBody()->getContents();
            
            $html = app('HtmlParser')->loadHtml($bodyString);
            $h1Tag = $html->first('h1');
            $h1Content = $h1Tag ? $h1Tag->text() : null;
            $keywordsMetaTag = $html->first('meta[name=keywords]');
            $keywordsContent = $keywordsMetaTag ? $keywordsMetaTag->attr('content') : null;
            $descriptionMetaTag = $html->first('meta[name=description]');
            $descriptionContent = $descriptionMetaTag ? $descriptionMetaTag->attr('content') : null;

            $this->domain->status = $status;
            $this->domain->content_length = $contentLength;
            $this->domain->body = $bodyString;
            $this->domain->h1 = $h1Content;
            $this->domain->keywords = $keywordsContent;
            $this->domain->description = $descriptionContent;
            $this->domain->stateMachine()->apply('complete');
            $this->domain->save();
            Log::info("Domain analysis {$this->domain->state}");
        } catch (RequestException $e) {
            Log::info($e->getMessage());
            $this->domain->stateMachine()->apply('fail');
            $this->domain->save();
            Log::info("Domain analysis {$this->domain->state}");
        }
    }
}
