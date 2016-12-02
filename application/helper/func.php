<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/25
 * Time: 下午11:17
 */

function test(){
    echo 'test';
}


function p($mixed = null) {
    echo '========<br><pre>';
    print_r($mixed);
    echo '</pre><br>';
    return null;
}