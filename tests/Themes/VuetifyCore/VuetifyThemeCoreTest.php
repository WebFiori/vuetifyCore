<?php
namespace webfiori\framework\test;

use PHPUnit\Framework\TestCase;
use Themes\VuetifyCore\VuetifyThemeCore;
use WebFiori\Ui\HTMLNode;
use WebFiori\Ui\HeadNode;

class ConcreteTheme extends VuetifyThemeCore {
    public function __construct($name = 'TestTheme') {
        parent::__construct($name);
    }
    public function getAsideNode() : HTMLNode { return new HTMLNode(); }
    public function getFooterNode() : HTMLNode { return new HTMLNode(); }
    public function getHeadNode() : HeadNode { return new HeadNode(); }
    public function getHeaderNode() : HTMLNode { return new HTMLNode(); }
}

class VuetifyThemeCoreTest extends TestCase {
    /**
     * @test
     */
    public function testDefaultAppID() {
        $theme = new ConcreteTheme();
        $this->assertEquals('app', $theme->getAppID());
    }
    /**
     * @test
     */
    public function testSetAppID() {
        $theme = new ConcreteTheme();
        $theme->setAppID('my-app');
        $this->assertEquals('my-app', $theme->getAppID());
    }
    /**
     * @test
     */
    public function testSetAppIDEmpty() {
        $theme = new ConcreteTheme();
        $theme->setAppID('custom');
        $theme->setAppID('');
        $this->assertEquals('custom', $theme->getAppID());
    }
    /**
     * @test
     */
    public function testSetAppIDSpaces() {
        $theme = new ConcreteTheme();
        $theme->setAppID('  ');
        $this->assertEquals('app', $theme->getAppID());
    }
    /**
     * @test
     */
    public function testThemeProperties() {
        $theme = new ConcreteTheme();
        $this->assertEquals('1.2.5', $theme->getVersion());
        $this->assertEquals('Ibrahim BinAlshikh', $theme->getAuthor());
        $this->assertEquals('MIT', $theme->getLicenseName());
        $this->assertEquals('https://opensource.org/licenses/MIT', $theme->getLicenseUrl());
        $this->assertEquals('https://ibrahim-binalshikh.me', $theme->getAuthorUrl());
    }
}
