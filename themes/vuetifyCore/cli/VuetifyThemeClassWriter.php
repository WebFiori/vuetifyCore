<?php
namespace themes\vuetifyCore\cli;

use webfiori\framework\writers\ClassWriter;
/**
 * Description of VuetifyThemeClassWriter
 *
 * @author Ibrahim
 */
class VuetifyThemeClassWriter extends ClassWriter {
    private $wireframe;

    public function __construct(array $classInfoArr) {
        parent::__construct($classInfoArr['name'], $classInfoArr['path'], $classInfoArr['namespace']);

        $this->wireframe = $classInfoArr['wireframe'];
        $ns = $this->getNamespace();
        
        $this->addUseStatement('themes\\vuetifyCore\\VuetifyThemeCore;');
        $this->addUseStatement('webfiori\\ui\\HTMLNode;');
        $this->addUseStatement('webfiori\ui\HeadNode');
        
        $this->addUseStatement($ns.'\\AsideSection');
        $this->addUseStatement($ns.'\\FooterSection');
        $this->addUseStatement($ns.'\\HeadSection');
        $this->addUseStatement($ns.'\\HeaderSection');
        
        
    }
    public function getWireframe() {
        return $this->wireframe;
    }
    private function writeAside() {
        $writer = new SideSectionWriter($this);
        $writer->writeClass();
    }
    private function writeFooter() {
        $writer = new FooterSectionWriter($this);
        $writer->writeClass();
    }
    private function writeHead() {
        $writer = new HeadSectionWriter($this);
        $writer->writeClass();
    }
    private function writeHeader() {
        $writer = new HeaderSectionWriter($this);
        $writer->writeClass();
    }
    private function writeSysBar() {
        $writer = new SysBarWriter($this);
        $writer->writeClass();
    }

    public function writeClassBody() {
        $this->append([
            "/**",
            " * Creates new instance of the class.",
            " */",
            $this->f('__construct')
        ], 1);

        $this->append([
            "parent::__construct('Super Theme');",
            '//TODO: Set the properties of your theme.',
            '//$this->setName(\'Super Theme\');',
            '//$this->setVersion(\'1.0\');',
            '//$this->setAuthor(\'Me\');',
            '//$this->setDescription(\'My Super Cool Theme.\');',
            '//$this->setAuthorUrl(\'https://me.com\');',
            '//$this->setLicenseName(\'MIT\');',
            '//$this->setLicenseUrl(\'https://opensource.org/licenses/MIT\');',
            '//$this->setCssDirName(\'css\');',
            '//$this->setJsDirName(\'js\');',
            '//$this->setImagesDirName(\'images\');'
        ], 2);

        if ($this->getWireframe() == 'System Bar' || $this->getWireframe() == 'Inbox') {
            $this->append('$this->setAfterLoaded(function ('.$this->getName().' $theme) {', 2);
            $this->append("\$theme->getPage()->getChildByID('app')->insert(new SystemBarSection(\$theme->getPage()), 0);;", 3);
            $this->append('});', 2);
            $this->writeSysBar();
        }
        $this->append('}', 1);

        $this->append([
            '/**',
            " * Returns an object of type 'HTMLNode' that represents aside section of the page. ",
            ' *',
            " * @return HTMLNode|null An object of type 'HTMLNode'. If the theme has no aside",
            ' * section, the method might return null.',
            ' */',
            $this->f('getAsideNode', [], 'HTMLNode')
        ], 1);
        $this->append('return new AsideSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeAside();

        $this->append([
            '/**',
            " * Returns an object of type 'HTMLNode' that represents footer section of the page.",
            ' *',
            " * @return HTMLNode|null An object of type 'HTMLNode'. If the theme has no footer",
            ' * section, the method might return null.',
            ' */',
            $this->f('getFooterNode', [], 'HTMLNode')
        ], 1);
        $this->append('return new FooterSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeFooter();

        $this->append([
            '/**',
            " * Returns an object of type HeadNode that represents HTML &lt;head&gt; node.",
            ' *',
            " * @return HeadNode",
            ' */',
            $this->f('getHeadNode', [], 'HeadNode')
        ], 1);
        $this->append('return new HeadSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeHead();

        $this->append([
            '/**',
            " * Returns an object of type HTMLNode that represents header section of the page.",
            ' *',
            " * @return HTMLNode|null @return HTMLNode|null An object of type 'HTMLNode'. If the theme has no header",
            ' * section, the method might return null.',
            ' */',
            $this->f('getHeaderNode', [], 'HTMLNode')
        ], 1);
        $this->append('return new HeaderSection($this->getPage());', 2);
        $this->append('}', 1);
        $this->writeHeader();
        $this->append('}');
    }

    public function writeClassComment() {
        
    }

    public function writeClassDeclaration() {
        $this->append("class ".$this->getName().' extends VuetifyThemeCore {');
    }

}
