<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Goutte;

class CrawlController extends Controller
{
    /**
     * Start crawling
     *
     * @param  int  $id
     * @return Response
     */

    static $vocab_url = "http://japanesetest4you.com/flashcard/category/learn-japanese-vocabulary/learn-japanese-n1-vocabulary/";
    static $grammar_url = "http://japanesetest4you.com/flashcard/category/learn-japanese-grammar/learn-japanese-n1-grammar/";
    private function getTotalPage() {
        $crawler = Goutte::request('GET', self::$grammar_url);
        $page_text = $crawler->filter('.wp-pagenavi > .pages')->each(function ($node) {
            return $node->text();
        });
        $no_pages = explode(' ', $page_text[0]);
        return (int) array_pop($no_pages);
    }
    public function crawl()
    {
        $total_page = $this->getTotalPage();
        foreach(range(1,$total_page) as $page) {
            $crawler = Goutte::request('GET', self::$grammar_url.'page/'.$page);
            $crawler->filter('div > p > a> img')->each(function ($node) {
                $img_url = (($node->extract(array('src'))[0]));
                echo "<img src ='".$img_url."'><br/>";
            });
        }
    }
}