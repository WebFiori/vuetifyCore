<?php
namespace themes\vuetifyCore\cli;

use webfiori\framework\cli\writers\ClassWriter;
/**
 * Description of VuetifyThemeClassWriter
 *
 * @author Ibrahim
 */
class VuetifyThemeClassWriter extends ClassWriter {
    private $wireframe;
    
    public function __construct($classInfoArr) {
        parent::__construct($classInfoArr);
        
        $this->wireframe = $classInfoArr['wireframe'];
        
        $this->append('<?php');
        $this->append('namespace '.$this->getNamespace().';');
        $this->append('');
        $this->append('use themes\\vuetifyCore\\VuetifyThemeCore;');
        $this->append('use webfiori\\ui\\HTMLNode;');
        $this->append('use '.$this->getNamespace().'\\AsideSection;');
        $this->append('use '.$this->getNamespace().'\\FooterSection;');
        $this->append('use '.$this->getNamespace().'\\HeadSection;');
        $this->append('use '.$this->getNamespace().'\\HeaderSection;');
        $this->append('');
        $this->append("class ".$this->getName().' extends VuetifyThemeCore {');
        $this->append("/**", 1);
        $this->append(" * Creates new instance of the class.", 1);
        $this->append(" */", 1);
        $this->append('public function __construct(){', 1);
        $this->append('parent::__construct();', 2);
        $this->append('//TODO: Set the properties of your theme.', 2);

        $this->append('//$this->setName(\'Super Theme\');', 2);
        $this->append('//$this->setVersion(\'1.0\');', 2);
        $this->append('//$this->setAuthor(\'Me\');', 2);
        $this->append('//$this->setDescription(\'My Super Cool Theme.\');', 2);
        $this->append('//$this->setAuthorUrl(\'https://me.com\');', 2);
        $this->append('//$this->setLicenseName(\'MIT\');', 2);
        $this->append('//$this->setLicenseUrl(\'https://opensource.org/licenses/MIT\');', 2);
        $this->append('//$this->setCssDirName(\'css\');', 2);
        $this->append('//$this->setJsDirName(\'js\');', 2);
        $this->append('//$this->setImagesDirName(\'images\');', 2);

        $this->append('}', 1);

        $this->append('/**', 1);
        $this->append(" * Returns an object of type 'HTMLNode' that represents aside section of the page. ", 1);
        $this->append(' *', 1);
        $this->append(" * @return HTMLNode|null An object of type 'HTMLNode'. If the theme has no aside", 1);
        $this->append(' * section, the method might return null.', 1);
        $this->append(' */', 1);
        $this->append('public function getAsideNode() {', 1);
        $this->append('return new AsideSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeAside();

        $this->append('/**', 1);
        $this->append(" * Returns an object of type 'HTMLNode' that represents footer section of the page.", 1);
        $this->append(' *', 1);
        $this->append(" * @return HTMLNode|null An object of type 'HTMLNode'. If the theme has no footer", 1);
        $this->append(' * section, the method might return null.', 1);
        $this->append(' */', 1);
        $this->append('public function getFooterNode() {', 1);
        $this->append('return new FooterSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeFooter();

        $this->append('/**', 1);
        $this->append(" * Returns an object of type HeadNode that represents HTML &lt;head&gt; node.", 1);
        $this->append(' *', 1);
        $this->append(" * @return HeadNode", 1);
        $this->append(' */', 1);
        $this->append('public function getHeadNode() {', 1);
        $this->append('return new HeadSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeHead();

        $this->append('/**', 1);
        $this->append(" * Returns an object of type HTMLNode that represents header section of the page.", 1);
        $this->append(' *', 1);
        $this->append(" * @return HTMLNode|null @return HTMLNode|null An object of type 'HTMLNode'. If the theme has no header", 1);
        $this->append(' * section, the method might return null.', 1);
        $this->append(' */', 1);
        $this->append('public function getHeadrNode() {', 1);
        $this->append('return new HeaderSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeHeader();

        $this->append('}');
        $this->append('return __NAMESPACE__;');
    }
    private function writeHead() {
        $writer = new ClassWriter([
            'path' => $this->getPath(),
            'namespace' => $this->getNamespace(),
            'name' => 'HeadSection'
        ]);
        
        $writer->append('<?php');
        $writer->append('namespace '.$writer->getNamespace().';');
        $writer->append('');
        $writer->append('use webfiori\framework\ui\WebPage;');
        $writer->append('use webfiori\\ui\\HeadNode;');
        $writer->append('/**');
        $writer->append('  * This class represents head section the theme.');
        $writer->append('  */');
        $writer->append("class ".$writer->getName().' extends HeadNode {');
        $writer->append("/**", 1);
        $writer->append(" * Creates new instance of the class.", 1);
        $writer->append(" */", 1);
        $writer->append('public function __construct(WebPage $page){', 1);
        $writer->append('parent::__construct();', 2);
        $writer->append("\$this->addJs('https://unpkg.com/vue@2.x.x');", 2);
        $writer->append("\$this->addCSS('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900');", 2);
        $writer->append("\$this->addCSS('https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css');", 2);
        $writer->append("\$this->addCSS('https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css');", 2);
        $writer->append("\$this->addJs('https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js');", 2);
        $writer->append('//TODO: Add any extra JS or Css files here in addition to meta tags.', 2);
        $writer->append('}', 1);
        $writer->append('}');
    }
    private function writeHeader() {
        $writer = new ClassWriter([
            'path' => $this->getPath(),
            'namespace' => $this->getNamespace(),
            'name' => 'HeaderSection'
        ]);
        $writer->append('<?php');
        $writer->append('namespace '.$writer->getNamespace().';');
        $writer->append("");
        $writer->append('use webfiori\framework\ui\WebPage;');
        $writer->append('use webfiori\\ui\\HTMLNode;');
        $writer->append("");
        $writer->append('/**');
        $writer->append('  * This class represents header section the theme.');
        $writer->append('  */');
        $writer->append("class ".$writer->getName().' extends HTMLNode {');
        $writer->append("/**", 1);
        $writer->append(" * Creates new instance of the class.", 1);
        $writer->append(" */", 1);
        $writer->append('public function __construct(WebPage $page){', 1);
        $writer->append('parent::__construct(\'v-app-bar\', [', 2);
        $writer->append("'app'", 3);
        $writer->append(']);', 2);
        if ($this->getWireframe() == 'Base') {
            $writer->append("\$this->addChild('v-app-bar-nav-icon', [", 2);
            $writer->append("'@click' => \"drawer = !drawer\"", 3);
            $writer->append("]);", 2);
            $writer->append("\$this->addChild('v-toolbar-title')->text(\$page->getWebsiteName());", 2);
        }
        
        $writer->append('//TODO: Add components to the header.', 2);
        $writer->append('}', 1);
        $writer->append('}');
        
    }
    private function writeAside() {
        $writer = new ClassWriter([
            'path' => $this->getPath(),
            'namespace' => $this->getNamespace(),
            'name' => 'AsideSection'
        ]);
        
        $writer->append('<?php');
        $writer->append('namespace '.$writer->getNamespace().';');
        $writer->append('');
        $writer->append('use webfiori\framework\ui\WebPage;');
        $writer->append('use webfiori\\ui\\HTMLNode;');
        $writer->append('/**');
        $writer->append('  * This class represents side section of the theme.');
        $writer->append('  */');
        $writer->append("class ".$writer->getName().' extends HTMLNode {');
        $writer->append("/**", 1);
        $writer->append(" * Creates new instance of the class.", 1);
        $writer->append(" */", 1);
        $writer->append('public function __construct(WebPage $page){', 1);
        if ($this->getWireframe() == 'Base') {
            $writer->append('parent::__construct(\'v-navigation-drawer\', [', 2);
            $writer->append("'app', 'v-model' => 'drawer'", 3);
            $writer->append(']);', 2);
        }
        $writer->append('//TODO: Add components to the footer.', 2);
        $writer->append('}', 1);
        $writer->append('}');
    }
    private function writeFooter() {
        $writer = new ClassWriter([
            'path' => $this->getPath(),
            'namespace' => $this->getNamespace(),
            'name' => 'FooterSection'
        ]);
        
        $writer->append('<?php');
        $writer->append('use webfiori\framework\ui\WebPage;');
        $writer->append('namespace '.$writer->getNamespace().';');
        $writer->append('');
        $writer->append('use webfiori\\ui\\HTMLNode;');
        $writer->append('/**');
        $writer->append('  * This class represents footer section of the theme.');
        $writer->append('  */');
        $writer->append("class ".$writer->getName().' extends HTMLNode {');
        $writer->append("/**", 1);
        $writer->append(" * Creates new instance of the class.", 1);
        $writer->append(" */", 1);
        $writer->append('public function __construct(WebPage $page){', 1);
        if ($this->getWireframe() == 'Base') {
            $writer->append('parent::__construct(\'v-footer\');', 2);
        }
        $writer->append('//TODO: Add components to the footer.', 2);
        $writer->append('}', 1);
        $writer->append('}');
    }
    public function getWireframe() {
        return $this->wireframe;
    }
}
