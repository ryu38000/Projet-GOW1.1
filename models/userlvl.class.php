<?php

class userlvl
{
    private $lvl = "";
    private $points = '';
    private $temps = '';
    private $user = '';

    private static $_instance = null;
        /**
     * Empêche la création externe d'instances.
     */
    private function __construct () {
        $this->read();
    }

    /**
     * Empêche la copie externe de l'instance.
     */
    private function __clone () {}

    /**
     * Renvoi de l'instance et initialisation si nécessaire.
     */
    public static function getInstance () {
        if ( !self::$_instance )
        {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }



    public function read()
    {
        $this->user = user::getInstance();
        $this->lvl = $this->user->userlvl;

        $this->define($this->lvl);
    }

    private function define($lvl){
        $db = db::getInstance();

        $sql = 'SELECT *
                    FROM game_lvl
                    WHERE userlvl = "' . $lvl.'"';
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $result->free();
        if ( $row )
        {
            $this->points = (int) $row['points'];
            $this->temps = (int) $row['time'];
        }
    }
    public function get_points(){
        return $this->points;
    }
    public function get_time(){
        return $this->temps;
    }

   
}

?>
