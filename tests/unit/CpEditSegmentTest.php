<?php
namespace tinydots\cpeditsegment\tests\unit;

use Codeception\Test\Unit;
use tinydots\cpeditsegment\CpEditSegment;

class CpEditSegmentTest extends Unit
{
    /** @var CpEditSegment $plugin */
    private $plugin;

    protected function _before()
    {
        $this->plugin = new CpEditSegment('cpeditsegment');
    }

    public function testHasStaticAttributeThatIsAnInstanceOfThePlugin()
    {
        $this->assertClassHasStaticAttribute('plugin', CpEditSegment::class);
    }

    public function testHasCpSettings()
    {
        $this->assertTrue($this->plugin->hasCpSettings);
    }

    public function testSettingsUsesDefaultCpTrigger()
    {
        $this->assertEquals('admin', $this->plugin->getSettings()->trigger);
    }

    public function testRegistersCorrectSiteUrlRulesForDefaultTrigger()
    {
        $rules = $this->plugin->getSiteUrlRules();

        $this->assertEquals([
            '<elementUri:.*>/admin' => 'cpeditsegment/cp-edit-segment/redirect'
        ], $rules);
    }

    public function testRegistersCorrectSiteUrlRulesForCustomTrigger()
    {
        $this->plugin->getSettings()->trigger = 'edit';
        $rules = $this->plugin->getSiteUrlRules();

        $this->assertEquals([
            '<elementUri:.*>/edit' => 'cpeditsegment/cp-edit-segment/redirect',
            'edit' => 'cpeditsegment/cp-edit-segment/redirect'
        ], $rules);

        $this->plugin->getSettings()->trigger = 'lorem';
        $rules = $this->plugin->getSiteUrlRules();

        $this->assertEquals([
            '<elementUri:.*>/lorem' => 'cpeditsegment/cp-edit-segment/redirect',
            'lorem' => 'cpeditsegment/cp-edit-segment/redirect'
        ], $rules);
    }
}