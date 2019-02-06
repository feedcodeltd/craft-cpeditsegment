<?php
namespace tinydots\cpeditsegment;

use tinydots\cpeditsegment\models\Settings;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use yii\base\Event;

/**
 * Class CpEditSegment
 * @package tinydots\cpeditsegment
 */
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
            $event->rules = \array_merge($event->rules, $this->getSiteUrlRules());
        });
    }

    /**
     * @param string|null $trigger
     * @return array
     */
    public function getSiteUrlRules()
    {
        $rules = [];
        $trigger = $this->getSettings()->trigger;

        $rules["<elementUri:.*>/$trigger"] = 'cpeditsegment/cp-edit-segment/redirect';

        if ($trigger !== $this->cpTrigger) {
            $rules[$trigger] = 'cpeditsegment/cp-edit-segment/redirect';
        }

        return $rules;
    }

    /**
     * @return mixed|\yii\web\Response
     */
    public function getSettingsResponse()
    {
        return \Craft::$app->controller->renderTemplate('cpeditsegment/bookmarklet');
    }

    /**
     * @return Settings
     */
    public function getSettings()
    {
        return parent::getSettings();
    }

    /**
     * @return Settings
     */
    protected function createSettingsModel()
    {
        $settings = new Settings();
        $settings->trigger = $this->cpTrigger;

        return $settings;
    }
}