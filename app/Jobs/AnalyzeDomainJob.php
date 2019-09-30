<?php

namespace App\Jobs;

use App\Domain;
use GuzzleHttp\Exception\RequestException;

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
            
            $htmlDoc = app('HtmlParser')->loadHtml($bodyString);
            $h1Tag = $htmlDoc->first('h1');
            $h1Content = $h1Tag ? $h1Tag->text() : null;
            $keywordsMetaTag = $htmlDoc->first('meta[name=keywords]');
            $keywordsContent = $keywordsMetaTag ? $keywordsMetaTag->attr('content') : null;
            $descriptionMetaTag = $htmlDoc->first('meta[name=description]');
            $descriptionContent = $descriptionMetaTag ? $descriptionMetaTag->attr('content') : null;

            $this->domain->status = $status;
            $this->domain->content_length = $contentLength;
            $this->domain->body = $bodyString;
            $this->domain->h1 = $h1Content;
            $this->domain->keywords = $keywordsContent;
            $this->domain->description = $descriptionContent;
            $this->domain->save();
        } catch (RequestException $e) {
            $this->domain->status = $e->getMessage();
            $this->domain->save();
        }       
    }
}
