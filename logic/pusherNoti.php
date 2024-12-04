<?php


function pushNoti($data){
    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    
    $pusher = new Pusher\Pusher(
        '65b69d50985fd3578ab3',
        '5162ecfa7669af493dbf',
        '1768766',
        $options
    );

    $pusher->trigger('my-channel', 'my-event', json_encode($data));
}





