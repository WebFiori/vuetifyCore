<?php
namespace themes\vuetifyCore\cli;

use webfiori\framework\cli\CLICommand;
/**
 * Description of CreateVuetifyThemeCommand
 *
 * @author Ibrahim
 */
class CreateVuetifyThemeCommand extends CLICommand {
    public function __construct() {
        parent::__construct('create-vuetify-theme', [
            '--whireframe' => [
                'optional' => 'true',
                'default' => 'Base',
                'description' => 'An optional wireframe to use in bulding your '
                . 'theme. Defalt is the "Base" wireframe.',
                'values' => [
                    "Base","Extended Toolbar", "System Bar",
                    "Inbox", "Constrained", "Side Navigation",
                    "Three Column", "Discord"
                ]
            ]
        ], 'Creates a theme which will be based on Vuetify UI framework. The created '
                . 'theme will be based on one of the wireframes which exist at '
                . 'https://vuetifyjs.com/en/getting-started/wireframes .');
    }
    public function exec() {
        $wireframe = $this->getArgValue('----whireframe');
        $classInfo = $this->getClassInfo();
        $classInfo['wireframe'] = $wireframe;
        $creator = new VuetifyThemeClassWriter($classInfo);
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
    public function getClassInfo($defaltNs = null) {
        $classExist = true;

        do {
            $className = $this->_getClassName();
            $ns = $this->_getNamespace($defaltNs);
            $classWithNs = $ns.'\\'.$className;
            $classExist = class_exists($classWithNs);

            if ($classExist) {
                $this->error('A class in the given namespace which has the given name was found.');
            }
        } while ($classExist);
        $isFileExist = true;

        do {
            $path = $this->_getClassPath($ns);

            if (file_exists($path.DS.$className.'.php')) {
                $this->warning('A file which has the same as the class name was found.');
                $isReplace = $this->confirm('Would you like to override the file?', false);

                if ($isReplace) {
                    $isFileExist = false;
                }
            } else {
                $isFileExist = false;
            }
        } while ($isFileExist);

        return [
            'name' => $className,
            'namespace' => $ns,
            'path' => $path
        ];
    }


    private function _getClassName() {
        $isNameValid = false;

        do {
            $className = trim($this->getInput('Enter a name for the new class:'));
            $isNameValid = $this->_validateClassName($className);

            if (!$isNameValid) {
                $this->error('Invalid class name is given.');
            }
        } while (!$isNameValid);

        return $className;
    }
    private function _getClassPath($default) {
        $validPath = false;

        do {
            clearstatcache();
            $path = $this->getInput("Where would you like to store the class? (must be a directory inside '".ROOT_DIR."')", $default);
            $fixedPath = ROOT_DIR.DS.trim(trim(str_replace('\\', DS, str_replace('/', DS, $path)),'/'),'\\');

            if (Util::isDirectory($fixedPath, true)) {
                $validPath = true;
            } else {
                $this->error('Provided direcory is not a directory or it does not exist.');
            }
        } while (!$validPath);

        return $fixedPath;
    }

    private function _getNamespace($defaultNs) {
        $isNameValid = false;

        do {
            $ns = str_replace('/','\\',trim($this->getInput('Enter an optional namespace for the class:', $defaultNs)));
            $isNameValid = $this->_validateNamespace($ns);

            if (!$isNameValid) {
                $this->error('Invalid namespace is given.');
            }
        } while (!$isNameValid);

        return trim($ns,'\\');
    }
}
