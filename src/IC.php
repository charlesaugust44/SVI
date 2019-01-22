<?php

class IC
{
    public static $CONTROLLER = 'Web/Controller';
    public static $BUSINESS = 'Business';
    public static $PERSISTENCE = 'Persistence';
    public static $MODEL = 'Model';
    public static $VIEW = 'Web/View';
    public static $start = '';
    private static $previous = array();

    public static function start($location)
    {
        array_push(self::$previous, getcwd());
        chdir(self::$start);
        chdir($location);
    }

    public static function end()
    {
        chdir(self::$previous[count(self::$previous) - 1]);
        unset(self::$previous[count(self::$previous) - 1]);
        $tmp = array();

        foreach (self::$previous as $path)
            array_push($tmp, $path);

        self::$previous = $tmp;
    }

    public static function setStart()
    {
        self::$start = getcwd();
        array_push(self::$previous, self::$start);
    }
}