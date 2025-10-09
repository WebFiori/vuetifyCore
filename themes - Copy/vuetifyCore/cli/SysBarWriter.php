<?php

namespace themes\vuetifyCore\cli;

use webfiori\framework\writers\ClassWriter;

/**
 * A class which is used to write system bar section class of the theme.
 *
 * @author Ibrahim
 */
class SysBarWriter extends ClassWriter {
    /**
     * 
     * @var string
     */
    private $wf;
    public function __construct(VuetifyThemeClassWriter $writer) {
        parent::__construct('SystemBarSection', $writer->getPath(), $writer->getNamespace());

        $this->addUseStatement('webfiori\framework\ui\WebPage');
        $this->addUseStatement('use webfiori\\ui\\HTMLNode');
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

        $this->append('parent::__construct(\'v-system-bar\', [', 2);
        $this->append("'app'", 3);
        $this->append(']);', 2);
        $this->append("\$this->addChild('v-spacer');", 2);
        $this->append("\$this->addChild('v-icon')->text('mdi-square');", 2);
        $this->append("\$this->addChild('v-icon')->text('mdi-circle');", 2);
        $this->append("\$this->addChild('v-icon')->text('mdi-triangle');", 2);
        $this->append('}', 1);
        $this->append('}');
    }

    public function writeClassComment() {
        $this->append('/**');
        $this->append('  * This class represents system bar section of the theme.');
        $this->append('  */');
    }

    public function writeClassDeclaration() {
        $this->append("class ".$this->getName().' extends HTMLNode {');
    }

}
