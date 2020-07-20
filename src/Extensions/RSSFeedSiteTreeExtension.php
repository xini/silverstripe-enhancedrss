<?php

namespace Innoweb\EnhancedRSS\Extensions;

use SilverStripe\CMS\Model\SiteTreeExtension;
use SilverStripe\Control\RSS\RSSFeed;

class RSSFeedSiteTreeExtension extends SiteTreeExtension
{
    public function onAfterInit()
    {
        if ($this->getOwner()->hasMethod('getRSSLink')) {
            $link = $this->getOwner()->getRSSLink();
            if ($link) {
                RSSFeed::linkToFeed(
                    $link,
                    $this->getOwner()->Title . ' ' . _t('RSS.ASRSSFEED', 'as RSS feed'));
            }
        }
    }
}
