<?php

namespace Fromholdio\EnhancedRSS\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Core\Manifest\ModuleLoader;

class RSSFeedEntryExtension extends Extension
{
    private static $enable_social_meta_image = true;
    private static $enable_feature_image = true;

    public function Image()
    {
        $entry = $this->getOwner()->failover;
        if ($entry->hasMethod('getRSSFeedEntryImage')) {
            $image = $entry->getRSSFeedEntryImage();
        }
        else if ($this->getOwner()->getIsSocialMetaEnabled()) {
            $image = $entry->getSocialMetaValue('Image');
        }
        else if ($this->getOwner()->getIsFeatureImageEnabled()) {
            $image = $entry->getInheritedFeatureImage();
        }
        if ($image) {
            $image->MimeType = mime_content_type($image->getFilename());
            return $image;
        }
        return null;
    }

    public function getIsSocialMetaEnabled()
    {
        $isEnabled = (bool) $this->getOwner()->config()->get('enable_social_meta_image');
        if ($isEnabled) {
            $isEnabled = ModuleLoader::inst()->getManifest()
                ->moduleExists('innoweb/silverstripe-social-metadata');
        }
        $this->getOwner()->invokeWithExtensions('updateIsSocialMetaEnabled', $isEnabled);
        return $isEnabled;
    }

    public function getIsFeatureImageEnabled()
    {
        $isEnabled = (bool) $this->getOwner()->config()->get('enable_feature_image');
        if ($isEnabled) {
            $isEnabled = ModuleLoader::inst()->getManifest()
                ->moduleExists('fromholdio/silverstripe-featureimage');
        }
        $this->getOwner()->invokeWithExtensions('updateIsFeatureImageEnabled', $isEnabled);
        return $isEnabled;
    }
}
