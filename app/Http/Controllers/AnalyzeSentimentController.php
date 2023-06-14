<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jcobhams\NewsApi\NewsApi;
use Google\Cloud\Core\ServiceBuilder;

class AnalyzeSentimentController extends Controller
{
    public function index()
    {
        $newsapi = new NewsApi(getenv('NEWS_API_KEY'));
        $topheadline = $newsapi->getTopHeadLines(null, null, 'us', null, null, null);
        $articles = $topheadline->articles;
        $sentiments = [];
        foreach ($articles as $article) {
            $sentiments[] = [
                'title' => $article->title,
                'description' => $article->description,
                'score' => $this->analyzeSentiment($article->title),
                'url' => $article->url,
            ];
        }
        return view('welcome', compact('sentiments'));
    }

    public function analyzeSentiment($text)
    {
        //dd(base_path('google/credentials.json'));
        $cloud = new ServiceBuilder([
            'keyFilePath' => base_path('google/credentials.json'),
            'project_id' => 'newssetimenanalysis'
        ]);
        $language = $cloud->language();
        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();
        return $sentiment['score'];
    }
}
