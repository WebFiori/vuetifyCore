<?php

namespace themes\vuetifyCore\cli;

use webfiori\framework\writers\ClassWriter;

/**
 * A class which is used to write header section class of the theme.
 *
 * @author Ibrahim
 */
class HeaderSectionWriter extends ClassWriter {
    /**
     * 
     * @var string
     */
    private $wf;
    public function getWireframe() : string {
        return $this->wf;
    }
    public function __construct(VuetifyThemeClassWriter $writer) {
        parent::__construct('HeaderSection', $writer->getPath(), $writer->getNamespace());

        $this->addUseStatement('webfiori\framework\ui\WebPage');
        $this->addUseStatement('webfiori\\ui\\HTMLNode');
        $this->wf = $writer->getWireframe();
        
    }

    public function writeClassBody() {
        $wireframe = $this->getWireframe();
        $this->append([
            "/**",
            " * Creates new instance of the class.",
            " */",
            $this->f('__construct',[
                'page' => 'WebPage'
            ])
        ], 1);
        
        if ($wireframe == 'Side Navigation' || $wireframe == 'Base' || $wireframe == 'System Bar' || $wireframe == 'Inbox') {
            $this->append('parent::__construct(\'v-app-bar\', [', 2);
            $this->append("'app'", 3);
            $this->append(']);', 2);
            $this->append("\$this->addChild('v-app-bar-nav-icon', [", 2);
            $this->append("'@click' => \"drawer = !drawer\",", 3);
            $this->append("'class' => \"d-sm-flex d-md-none\",", 3);
            $this->append("'id' => \"nav-menu-icon\",", 3);
            $this->append("]);", 2);
            $this->append("\$this->addChild('v-toolbar-title')->text(\$page->getWebsiteName());", 2);
        } else if ($wireframe == 'Extended Toolbar') {
            $this->append('parent::__construct(\'v-app-bar\', [', 2);
            $this->append("'app', 'shrink-on-scroll'", 3);
            $this->append(']);', 2);
            $this->append("\$this->addChild('v-app-bar-nav-icon', [", 2);
            $this->append("'@click' => \"drawer = !drawer\",", 3);
            $this->append("'class' => \"d-sm-flex d-md-none\",", 3);
            $this->append("'id' => \"nav-menu-icon\",", 3);
            $this->append("]);", 2);
            $this->append("\$this->addChild('v-toolbar-title')->text(\$page->getWebsiteName());", 2);
            $this->append("\$this->addChild('v-spacer');", 2);
            $this->append("\$this->addChild('v-btn', ['icon'])->addChild('v-icon')->text('mdi-dots-vertical');", 2);
        }
        $this->append('//TODO: Add components to the header.', 2);
        $this->append('}', 1);
        $this->append('}');
    }

    public function writeClassComment() {
        $this->append('/**');
        $this->append('  * This class represents header section the theme.');
        $this->append('  */');
    }

    public function writeClassDeclaration() {
        $this->append("class ".$this->getName().' extends HTMLNode {');
    }

}
