<?php
namespace tinydots\cpeditsegment;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use yii\base\Event;

class CpEditSegment extends Plugin
{
    public static $plugin;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_SITE_URL_RULES, function(RegisterUrlRulesEvent $event) {
            $trigger = Craft::$app->getConfig()->getGeneral()->cpTrigger;

            $event->rules["<elementUri:.*>/$trigger"] = 'cpeditsegment/cp-edit-segment/redirect';
        });
    }
}