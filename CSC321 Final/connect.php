<?php

    define( "DB_IP", "localhost" );
    define( "DB_USER", "root" );
    define( "DB_PASS", "" );
    define( "DB_DB", "game_library_db" );
        
    
    try{ 
        $connection = new mysqli( DB_IP, DB_USER, DB_PASS, DB_DB );

        if( $connection->errno > 0 ) {
            echo "error connecting to database" . "<br>";
            exit;
        }
        else
        {
            //echo "connected to database" . "<br>";
        }
    } catch (Exception $e ){
        debug( $e );
    }

    function debug( ...$a ){
        echo "<pre>";
        print_r( $a );
        echo "</pre>";
    }
?>