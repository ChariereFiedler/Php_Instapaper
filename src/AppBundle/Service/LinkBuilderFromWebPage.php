<?php

namespace AppBundle\Service;

use AppBundle\Entity\Link;
use Essence\Essence;
use Goutte\Client;
use Symfony\Component\CssSelector\CssSelectorConverter;

class LinkBuilderFromWebPage {


    public function buildAll(array $links) {
        foreach($links as $link ){
            $this->build($link);
        }
    }

    public function build(Link &$link):Link
    {
            $Essence = new Essence();
            $media = $Essence->extract($link->getUrl());

            if($media) {
                $link->setTitle($media->title);
                $link->setContent($media->html);
            } else {
                $client = new Client();
                $crawler = $client->request("GET", $link->getUrl());

                $title = $crawler->filter("h2")->first()->text();

                $converter = new CssSelectorConverter();
                $content = $crawler->filterXPath("//div[contains(@class, 'content')]");
                if($content->count() > 0) {
                    $content = $content->first()->html();
                    $link->setContent($content);
                }


                $link->setTitle($title);
                $link->setBuilt(true);
            }

        return $link;

    }



}