<?php 


class Model
{
    private static $dbInstance = null;
    public static function connection():mysqli {
        if(self::$dbInstance === null){
            self::$dbInstance = new mysqli('localhost', 'koala', 'root@123', 'testBlog');
        }
        return self::$dbInstance;
    }
}

?>