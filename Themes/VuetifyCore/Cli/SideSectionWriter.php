<?php

namespace themes\vuetifyCore\cli;

use webfiori\framework\writers\ClassWriter;

/**
 * A class which is used to write footer section class of the theme.
 *
 * @author Ibrahim
 */
class SideSectionWriter extends ClassWriter {
    /**
     * 
     * @var string
     */
    private $wf;
    public function __construct(VuetifyThemeClassWriter $writer) {
        parent::__construct('AsideSection', $writer->getPath(), $writer->getNamespace());

        $this->addUseStatement('webfiori\framework\ui\WebPage');
        $this->addUseStatement('webfiori\\ui\\HTMLNode');
        $this->wf = $writer->getWireframe();
    }
    public function getWireframe() : string {
        return $this->wf;
    }
    public function writeClassBody() {
        $this->append([
            "/**",
            " * Creates new instance of the class.",
            " */",
            $this->f('__construct',[
                'page' => 'WebPage'
            ])
        ], 1);
        $wireframe = $this->getWireframe();

        if ($wireframe == 'Base' 
                || $wireframe == 'Extended Toolbar'
                || $wireframe == 'System Bar') {
            $this->append('parent::__construct(\'v-navigation-drawer\', [', 2);
            $this->append("'app', 'v-model' => 'drawer'", 3);
            $this->append(']);', 2);
        } else if ($wireframe == 'Side Navigation') {
            $this->append('parent::__construct(\'v-navigation-drawer\', [', 2);
            $this->append("'app', 'mini-variant', 'v-model' => 'drawer',", 3);
            $this->append("'class' => 'pt-4', 'color' => 'grey lighten-3'", 3);
            $this->append(']);', 2);
            $this->append("\$this->addChild('v-avatar', [", 2);
            $this->append("'v-for' => 'n in 6',", 3);
            $this->append("':key' => 'n',", 3);
            $this->append("':color' => \"`grey \\\${n === 1 ? 'darken' : 'lighten'}-1`\",", 3);
            $this->append("':size' => 'n === 1 ? 36 : 20',", 3);
            $this->append("'class' => 'd-block text-center mx-auto mb-9',", 3);
            $this->append("]);", 2);
        } else if ($wireframe == 'Inbox') {
            $this->append('parent::__construct(\'v-navigation-drawer\', [', 2);
            $this->append("'app', 'v-model' => 'drawer'", 3);
            $this->append(']);', 2);
            $this->append("\$this->addChild('v-sheet', [", 2);
            $this->append("'color' => 'grey lighten-4',", 3);
            $this->append("'class' => 'pa-4',", 3);
            $this->append("])->addChild('v-avatar', [", 2);
            $this->append("'color' => 'grey darken-1',", 3);
            $this->append("'class' => 'mb-4',", 3);
            $this->append("'size' => '64',", 3);
            $this->append("])->getParent()->addChild('div')->text('my-email@xyz.com');", 2);
            $this->append("\$this->addChild('v-divider');", 2);
            $this->append("\$this->addChild('v-list')", 2);
            $this->append("->addChild('v-list-item', [", 3);
            $this->append("'v-for' => \"[icon, text] in inbox_links\"", 4);
            $this->append("])->addChild('v-list-item-icon')", 3);
            $this->append("->addChild('v-icon')->text('{{ icon }}')", 3);
            $this->append("->getParent()->getParent()->addChild('v-list-item-content')", 3);
            $this->append("->addChild('v-list-item-title')->text('{{ text }}');", 3);
        }
            
        
        $this->append('//TODO: Add components to the footer.', 2);
        $this->append('}', 1);
        $this->append('}');
    }

    public function writeClassComment() {
        $this->append('/**');
        $this->append('  * This class represents side section of the theme.');
        $this->append('  */');
    }

    public function writeClassDeclaration() {
        $this->append("class ".$this->getName().' extends HTMLNode {');
    }

}
