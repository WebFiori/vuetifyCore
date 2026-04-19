<?php
namespace webfiori\framework\test;

use PHPUnit\Framework\TestCase;
use Themes\VuetifyCore\VuetifyWebPage;

class VuetifyWebPageTest extends TestCase {
    /**
     * @test
     */
    public function testGetJson() {
        $page = new VuetifyWebPage();
        $this->assertInstanceOf(\WebFiori\Json\Json::class, $page->getJson());
    }
    /**
     * @test
     */
    public function testAddToJson() {
        $page = new VuetifyWebPage();
        $page->addToJson(['foo' => 'bar', 'num' => 42]);
        $json = $page->getJson();
        $this->assertEquals('bar', $json->get('foo'));
        $this->assertEquals(42, $json->get('num'));
    }
    /**
     * @test
     */
    public function testAddToJsonMultipleCalls() {
        $page = new VuetifyWebPage();
        $page->addToJson(['a' => 1]);
        $page->addToJson(['b' => 2]);
        $json = $page->getJson();
        $this->assertEquals(1, $json->get('a'));
        $this->assertEquals(2, $json->get('b'));
    }
    /**
     * @test
     */
    public function testToVItemsWithArray() {
        $page = new VuetifyWebPage();
        $items = $page->toVItems(['key1' => 'Label 1', 'key2' => 'Label 2']);
        $this->assertCount(2, $items);
        $this->assertEquals('Label 1', $items[0]->get('text'));
        $this->assertEquals('key1', $items[0]->get('value'));
        $this->assertEquals('Label 1', $items[0]->get('title'));
        $this->assertEquals('key1', $items[0]->get('key'));
        $this->assertEquals('Label 2', $items[1]->get('text'));
        $this->assertEquals('key2', $items[1]->get('value'));
    }
    /**
     * @test
     */
    public function testToVItemsWithExtraAttrs() {
        $page = new VuetifyWebPage();
        $items = $page->toVItems(
            ['a' => 'A', 'b' => 'B'],
            ['a' => ['disabled' => true, 'color' => 'red']]
        );
        $this->assertCount(2, $items);
        $this->assertTrue($items[0]->get('disabled'));
        $this->assertEquals('red', $items[0]->get('color'));
        // 'b' has no extra attrs
        $this->assertNull($items[1]->get('disabled'));
    }
    /**
     * @test
     */
    public function testToVItemsEmptyArray() {
        $page = new VuetifyWebPage();
        $items = $page->toVItems([]);
        $this->assertCount(0, $items);
    }
    /**
     * @test
     */
    public function testGetPrimaryVueFilePath() {
        $page = new VuetifyWebPage();
        $path = $page->getPrimaryVueFilePath();
        // Class is VuetifyWebPage in namespace Themes\VuetifyCore
        // APP_DIR is 'App', so pagesFolder = 'App\pages'
        // The path should contain .js extension and be kebab-case
        $this->assertStringEndsWith('.js', $path);
        $this->assertStringContainsString('vuetify-web-page.js', $path);
    }
    /**
     * @test
     */
    public function testRenderIncludesJsonData() {
        $page = new VuetifyWebPage();
        $page->addToJson(['testKey' => 'testValue']);
        $html = $page->render(false, true);
        $this->assertStringContainsString('server-json-data', $html);
        $this->assertStringContainsString('testKey', $html);
        $this->assertStringContainsString('testValue', $html);
    }
    /**
     * @test
     */
    public function testRenderIncludesVueInitScript() {
        $page = new VuetifyWebPage();
        $html = $page->render(false, true);
        $this->assertStringContainsString('vue-init', $html);
    }
}
