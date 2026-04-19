<?php

namespace Themes\VuetifyCore\Cli;

use WebFiori\Framework\Ui\WebPage;
use WebFiori\Framework\Writers\ClassWriter;
use WebFiori\Ui\HTMLNode;

/**
 * A class which is used to write footer section class of the theme.
 *
 * @author Ibrahim
 */
class FooterSectionWriter extends ClassWriter {
    /**
     * 
     * @var string
     */
    private $wf;
    public function getWireframe() : string {
        return $this->wf;
    }
    public function __construct(VuetifyThemeClassWriter $writer) {
        parent::__construct('FooterSection', $writer->getPath(), $writer->getNamespace());

        $this->addUseStatement(WebPage::class);
        $this->addUseStatement(HTMLNode::class);
        $this->wf = $writer->getWireframe();
        
        
    }

    public function writeClassBody() {
        $this->append([
            "/**",
            " * Creates new instance of the class.",
            " */",
        ], 1);
        $this->f('__construct',[
            'page' => 'WebPage'
        ]);
        $wireframe = $this->getWireframe();
        //if ($wireframe == 'Base' || $wireframe == 'Extended Toolbar' || $wireframe == 'System Bar') {
        $this->append('parent::__construct(\'v-footer\');', 2);
        //}
        $this->append('//TODO: Add components to the footer.', 2);
        $this->append('}', 1);
        $this->append('}');
    }

    public function writeClassComment() {
        $this->append([
            '/**',
            '  * This class represents footer section of the theme.',
            '  */'
        ]);
    }

    public function writeClassDeclaration() {
        $this->append("class ".$this->getName().' extends HTMLNode {');
    }

}
