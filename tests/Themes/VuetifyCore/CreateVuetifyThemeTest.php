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
        $path = ROOT_PATH . DS . str_replace('\\', DS, $ns);
        
        // Clean up before test
        $this->cleanupTestResources($path);
        
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
        
        // Check that all expected files were created
        $expectedFiles = [
            $name . '.php',
            'AsideSection.php',
            'FooterSection.php', 
            'HeaderSection.php',
            'HeadSection.php'
        ];
        
        foreach ($expectedFiles as $fileName) {
            $filePath = $path . DS . $fileName;
            $this->assertTrue(file_exists($filePath), "File not found: " . $filePath);
            require_once $filePath;
            $this->assertTrue(class_exists($ns.'\\'.explode('.', $fileName)[0]), "Class not found: " . $ns.'\\'.explode('.', $fileName)[0]);
        }

        // Clean up after test
        $this->cleanupTestResources($path);
    }
    
    /**
     * Deletes all resources created by a test in the specified path
     * 
     * @param string $path The path to clean up
     */
    public function cleanupTestResources($path) {
        if (is_dir($path)) {
            $files = glob($path . DS . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($path);
        }
        
        // Also remove parent directory if empty
        $parentPath = dirname($path);
        if (is_dir($parentPath) && count(glob($parentPath . DS . '*')) === 0) {
            rmdir($parentPath);
        }
    }
}
