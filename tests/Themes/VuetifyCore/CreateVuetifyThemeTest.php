<?php
namespace webfiori\framework\test\cli;

use Themes\VuetifyCore\Cli\CreateVuetifyThemeCommand;
use WebFiori\Cli\CommandTestCase;

class CreateVuetifyThemeTest extends CommandTestCase {
    /**
     * @test
     */
    public function test00() {
        $ns = 'TestTheme\\My';
        $name = 'MyCoolVuetifyTheme';
        $path = ROOT_PATH.DS.$ns;
        $output = $this->executeSingleCommand(new CreateVuetifyThemeCommand(), [], [
            '0',
            $name,
            $ns
        ]);
        $this->assertEquals([
            "Select theme wireframe:\n",
            "0: Base <--\n",
            "1: Extended Toolbar\n",
            "2: System Bar\n",
            "3: Inbox\n",
            "4: Side Navigation\n",
            "Enter a name for the new class:\n",
            "Enter namespace for the class: Enter = 'Themes\Vuetify'\n",
            "Creating new vuetify theme based on 'Base' wireframe...\n",
            "Your theme was successfully created.\n"
        ], $output);
        $this->assertTrue(file_exists($path.DS.$name.'.php'), "File not found: ".$path.DS.$name.'.php');
        $this->assertTrue(class_exists($ns.'\\'.$name), "Class not found: ".$ns.'\\'.$name);
        $this->assertTrue(class_exists($ns.'\\AsideSection', "Class not found: ".$ns.'\\AsideSection'));
        $this->assertTrue(class_exists($ns.'\\FooterSection', "Class not found: ".$ns.'\\FooterSection'));
        $this->assertTrue(class_exists($ns.'\\HeaderSection', "Class not found: ".$ns.'\\HeaderSection'));
        $this->assertTrue(class_exists($ns.'\\HeadSection', "Class not found: ".$ns.'\\HeadSection'));
    }
}