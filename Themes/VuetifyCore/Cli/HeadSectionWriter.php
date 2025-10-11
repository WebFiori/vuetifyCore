<?php

namespace Themes\VuetifyCore\Cli;

use Themes\VuetifyCore\VueHeadSectionV2;
use WebFiori\Framework\Ui\WebPage;
use WebFiori\Framework\Writers\ClassWriter;
use WebFiori\Ui\HeadNode;

/**
 * A class which is used to write head section class of the theme.
 *
 * @author Ibrahim
 */
class HeadSectionWriter extends ClassWriter {
    public function __construct(VuetifyThemeClassWriter $writer) {
        parent::__construct('HeadSection', $writer->getPath(), $writer->getNamespace());
        $this->addUseStatement(WebPage::class);
        $this->addUseStatement(HeadNode::class);
        $this->addUseStatement(VueHeadSectionV2::class);
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
        $this->append([
            'parent::__construct();',
            '//TODO: Add any extra JS or Css files here in addition to meta tags.',
        ], 2);
        $this->append('}', 1);
        $this->append('}');
    }

    public function writeClassComment() {
        $this->append('/**');
        $this->append('  * This class represents head section the theme.');
        $this->append('  */');
    }

    public function writeClassDeclaration() {
        $this->append("class ".$this->getName().' extends VueHeadSectionV2 {');
    }

}
