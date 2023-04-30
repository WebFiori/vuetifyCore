<?php
namespace themes\vuetifyCore\cli;

use webfiori\cli\CLICommand;


/**
 * A command which can be used to create a Vuetify based theme template.
 *
 * @author Ibrahim
 */
class CreateVuetifyThemeCommand extends CLICommand {
    /**
     * Creates new instance of the class.
     */
    public function __construct() {
        parent::__construct('create-vuetify-theme', [
        ], 'Creates a theme which will be based on Vuetify UI framework. The created '
                .'theme will be based on one of the wireframes which exist at '
                .'https://vuetifyjs.com/en/getting-started/wireframes .');
    }
    /**
     * Execute the command.
     * 
     * @return int The method will always return 0.
     */
    public function exec() : int {
        $wireframes = [
            "Base","Extended Toolbar", "System Bar",
            "Inbox", "Side Navigation",
        ];
        $wireframe = $this->select('Select theme wireframe:', $wireframes, 0);
        $classInfo = $this->getClassInfo();
        $classInfo['wireframe'] = $wireframe;
        $creator = new VuetifyThemeClassWriter($classInfo);
        $this->println("Creating new vuetify theme based on '$wireframe' wireframe...");
        $creator->writeClass();
        $this->println('Your theme was successfully created.');

        return 0;
    }

    /**
     * Prompts the user to enter class information such as it is name.
     * 
     * This method is useful in case we would like to create a class.
     * 
     * @return array The method will return an array that contains 3 indices: 
     * <ul>
     * <li><b>name</b>: The name of the class.</li>
     * <li><b>namespace</b>: The namespace of the class. It will be empty string if no 
     * namespace is entered.</li>
     * <li><b>path</b>: The location at which the class will be created.</li>
     * </ul>
     * 
     * @since 1.0
     */
    public function getClassInfo() {
        $classExist = true;
        
        do {
            $className = $this->readClassName('Enter a name for the new class:', 'Theme');
            $ns = $this->readNamespace('Enter namespace for the class:', 'themes\\vuetify');
            $classWithNs = $ns.'\\'.$className;
            $classExist = class_exists($classWithNs);

            if ($classExist) {
                $this->error('A class in the given namespace which has the given name was found.');
            }
        } while ($classExist);
        $path = ROOT_DIR.DS.trim(trim(str_replace('\\', DS, str_replace('/', DS, $ns)),'/'),'\\');
  
        return [
            'name' => $className,
            'namespace' => $ns,
            'path' => $path
        ];
    }
}
