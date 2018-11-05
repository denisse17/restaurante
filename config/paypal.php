<?php 
return array( 
    'client_id' => 'CLIENT_ID',
    'secret' => 'SECRET',
    'settings'=>array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    )
);

/*return [ 
    'client_id' => 'ARZ2r0ZYtGk3k8QIUN2ZnnD7FOBJ1nkO1eHYKkjNPVI0MFS8olHynEUChi8unbD6wjVgn5TlPNs5lMtD',
    'secret' => 'EFA7prgJz3eAdjEcdO7KEbN0BNsF_N3Evsw2Kb3VllkRQT4r6g71mgo6vy73ysxGv0ZhXxU6TiDgpKcr',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];*/

