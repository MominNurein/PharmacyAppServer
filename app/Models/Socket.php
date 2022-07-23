<?php

namespace App\Models;

use Illuminate\Http\Request;
use ElephantIO\Client as Elephent;
use ElephantIO\Engine\SocketIO\Version2X;
use Illuminate\Support\Facades\DB;
use App\Models\Delivery;

class Socket
{
    public static function getLocation($longitude,$latitude) {
        $socket = new Elephent(new Version2X('http://localhost:3000'));
        $socket -> initialize();
        $socket->emit('getLocation',['longitude' => $longitude , 'latitude' => $latitude]);
    }

    public static function setLocation($longitude , $latitude , $deliveryId ) {

        // Creating connection with socket server
        $socket = new Elephent(new Version2X('http://localhost:3000'));
        
        $socket->initialize();
        
        $socket->emit('setLocation',['longitude' => $longitude , 'latitude' => $latitude]);
        $socket -> emit('newLocation' , ['longitude' => $longitude , 'latitude' => $latitude]);
        // $socket->close();       
    }

    // public static function closeConnection() {
        
    // }
}