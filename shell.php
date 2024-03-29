<?php

require_once('lib/_preboot.php');
require_once('lib/_boot.php');

lib\debug::enable(true);

$argv = new lib\helper\arr($argv);

lib\prt::cool('white', 'Welcome to the shell, just read the code (refactor me at some point).');

if($argv->len() > 1)
{
    switch($argv->get()[1])
    {
        case 'serve':
		shell_exec("php -S localhost:8000");
            break;

        case 'bg':

                $base = 'app/bg/';

                if($argv->len() > 2)
                {
                    try {

                        $class = ($argv->get()[2]);
                        lib\fs\fs::inc($base.$class.'.php');

                        $class = 'app\bg\\'.$class;
                        $class = new $class;

                        lib\prt::cool('green', 'Running: ' . $class->getName());

                        // Default Method

                        $class->fire();

                        // Other Method

                        if($argv->len() > 3) {
                            $method = $argv->get()[3];

                            try {
                                $class->$method();
                            } catch(Error $e) {
                                lib\prt::cool('yellow', 'Command Not found');
                            }
                        }

                    } catch(Exception $e) {
                        echo $e->getMessage();
                    }

                } else {
                    lib\prt::cool('yellow', 'Background job name missing.');
                }

            break;

        default:
                lib\prt::cool('yellow', 'Command Not found');
            break;
    }
}
