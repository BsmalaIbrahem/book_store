<?php
class Session {
    private static $sessionStarted = false;
    public static function sessionStart() {
        if(!self::$sessionStarted){
               session_start();
               self::$sessionStarted = true;
        }
        
    }
    public static function set_session($key, $value){
        $_SESSION[$key] = $value;
    }
    
    public static function get_session($key) {
        return $_SESSION[$key];
    }
    
    public static function destroy_session(){
        session_unset();
        session_destroy();
        self::$sessionStarted = false;
        
    }
}
