<?php

namespace Innoweb\EnhancedRSS\Extensions;

use SilverStripe\Control\RSS\RSSFeed;
use SilverStripe\Core\Extension;

class ControllerExtension extends Extension
{
    public function onAfterInit()
    {
        if ($this->getOwner()->hasMethod('getRSSLink')) {
            $link = $this->getOwner()->getRSSLink();
            if ($link) {
                RSSFeed::linkToFeed(
                    $link,
                    $this->getOwner()->Title . ' ' . _t('RSS.ASRSSFEED', 'as RSS feed')
                );
            }
        }
    }
}
