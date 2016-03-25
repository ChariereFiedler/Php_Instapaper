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

                $title = $crawler->filter("title")->first()->text();

                $converter = new CssSelectorConverter();
                $content = $crawler->filterXPath("//div[contains(@class, 'content')]");
                if($content->count() > 0) {

                    $nb = 0;
                    $actualContent = NULL;

                    for ($i = 0 ; $i < $content->count() ; $i++) {
                        if (strlen($content->eq($i)->html()) > $nb) {
                            $nb = strlen($content->eq($i)->html());
                            $actualContent = $content->eq($i);
                        }
                    }

                    $link->setContent($actualContent->html());
                    $link->setResume(substr(strip_tags ( $actualContent->html()), 0, 500)." ...");

                    $urlImg = $actualContent->filterXPath("//img/@src");

                    if($urlImg->count() > 0) {
                        $link->setImgUrl($urlImg->first()->html());
                    }
                }


                $link->setTitle($title);
                $link->setBuilt(true);
            }

        return $link;

    }



}