<?php
namespace tinydots\cpeditsegment;

use tinydots\cpeditsegment\models\Settings;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use yii\base\Event;

class CpEditSegment extends Plugin
{
    public static $plugin;
    public $hasCpSettings = true;
    public $cpTrigger;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;
        $this->cpTrigger = \Craft::$app->getConfig()->getGeneral()->cpTrigger;

        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_SITE_URL_RULES, function(RegisterUrlRulesEvent $event)
        {
            $trigger = $this->getSettings()->trigger;

            $event->rules["<elementUri:.*>/$trigger"] = 'cpeditsegment/cp-edit-segment/redirect';

            if ($trigger !== $this->cpTrigger) {
                $event->rules["$trigger"] = 'cpeditsegment/cp-edit-segment/redirect';
            }
        });
    }

    public function getSettingsResponse()
    {
        return \Craft::$app->controller->renderTemplate('cpeditsegment/bookmarklet');
    }

    protected function createSettingsModel()
    {
        $settings = new Settings();
        $settings->trigger = $this->cpTrigger;

        return $settings;
    }
}