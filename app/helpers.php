<?php

function cdn($url = '')
{
    return env('CDN_HOST', '') . $url;
}

function _c($str, $default = null)
{
    return config($str, $default);
}

function _l(...$params)
{
    $out = '';

    foreach ($params as $param)
    {
        $var_type = gettype($param);

        if( $var_type === 'object' ) $var_type = get_class($param);

        if( is_object($param) )
        {
            if( method_exists($param, 'toArray') ) $param = $param->toArray();

            else $param = get_object_vars($param);
        }

        if( is_array($param) ) $param = print_r($param, true);

        elseif( is_callable($param) ) $param = '(function)';

        elseif ( is_bool($param) ) $param = $param ? 'TRUE' : 'FALSE';

        $out .= "\n\n({$var_type}):\n{$param}\n\n---";
    }

    $out .= "\n";

    logger($out);
}