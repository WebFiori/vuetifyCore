<?php
namespace webfiori\framework\test;

use PHPUnit\Framework\TestCase;
use Themes\VuetifyCore\VueHeadSectionV2;
use Themes\VuetifyCore\CommonHead;

class HeadSectionTest extends TestCase {
    private static $v2Head;

    public static function setUpBeforeClass(): void {
        self::$v2Head = new VueHeadSectionV2();
    }
    /**
     * @test
     */
    public function testCommonHeadHasAjaxRequest() {
        $head = new CommonHead();
        $node = $head->getChildByID('ajaxrequest-helper');
        $this->assertNotNull($node);
    }
    /**
     * @test
     */
    public function testCommonHeadHasFavicon() {
        $head = new CommonHead();
        $node = $head->getChildByID('favicon');
        $this->assertNotNull($node);
    }
    /**
     * @test
     */
    public function testCommonHeadHasMaterialDesignIcons() {
        $head = new CommonHead();
        $node = $head->getChildByID('MaterialDesign-Webfont');
        $this->assertNotNull($node);
    }
    /**
     * @test
     */
    public function testCommonHeadGTM() {
        $head = new CommonHead();
        $this->assertNull($head->getGTM());
        $head->setGTM('GTM-XXXXX');
        $this->assertEquals('GTM-XXXXX', $head->getGTM());
    }
    /**
     * @test
     */
    public function testCommonHeadGoogleSiteVerification() {
        $head = new CommonHead();
        $this->assertNull($head->getGoogleSiteVerification());
        $head->setGoogleSiteVerification('abc123');
        $this->assertEquals('abc123', $head->getGoogleSiteVerification());
    }
    /**
     * @test
     */
    public function testV2HeadHasVueScript() {
        $node = self::$v2Head->getChildByID('vue-script');
        $this->assertNotNull($node);
        $this->assertEquals('2.7.16', $node->getAttribute('version'));
    }
    /**
     * @test
     */
    public function testV2HeadHasVuetifyCSS() {
        $node = self::$v2Head->getChildByID('vuetify-css');
        $this->assertNotNull($node);
        $this->assertEquals('2.7.2', $node->getAttribute('version'));
    }
    /**
     * @test
     */
    public function testV2HeadHasVuetifyScript() {
        $node = self::$v2Head->getChildByID('vuetify-script');
        $this->assertNotNull($node);
        $this->assertEquals('2.7.2', $node->getAttribute('version'));
    }
    /**
     * @test
     */
    public function testV2HeadHasSRI() {
        $node = self::$v2Head->getChildByID('vue-script');
        $this->assertNotNull($node->getAttribute('integrity'));
        $this->assertEquals('anonymous', $node->getAttribute('crossorigin'));
    }
}
