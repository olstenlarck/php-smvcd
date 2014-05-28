<?php
function filterVar($var)
{
    if (is_numeric($var)) {
        $var = (int) $var;
        if (!$var > 0) {
            $var = 1;
        }
    } else {
        $var = addslashes(htmlspecialchars(trim($var)));
    }
    return $var;
}

function validEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function sqlFetchRow($query_id = false)
{
    return ($query_id !== false) ? @mysql_fetch_assoc($query_id) : false;
}
