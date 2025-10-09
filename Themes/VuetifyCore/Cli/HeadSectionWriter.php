<?php

namespace themes\vuetifyCore\cli;

use webfiori\framework\writers\ClassWriter;

/**
 * A class which is used to write head section class of the theme.
 *
 * @author Ibrahim
 */
class HeadSectionWriter extends ClassWriter {
    public function __construct(VuetifyThemeClassWriter $writer) {
        parent::__construct('HeadSection', $writer->getPath(), $writer->getNamespace());
        $this->addUseStatement('webfiori\framework\ui\WebPage');
        $this->addUseStatement('webfiori\\ui\\HeadNode');
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
            "\$this->addJs('https://unpkg.com/vue@2.x.x');",
            "\$this->addCSS('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900');",
            "\$this->addCSS('https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css');",
            "\$this->addCSS('https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css');",
            "\$this->addJs('https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js');",
            "\$this->addJs('https://cdn.jsdelivr.net/gh/usernane/AJAXRequestJs@2.0.3/AJAXRequest.js');",
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
        $this->append("class ".$this->getName().' extends HeadNode {');
    }

}
