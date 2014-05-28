<?php

class Parse
{
    public function ParseTags($Temp, $ParseTags)
    {
        $TPL_File = "views/$Temp.php";
        if (file_exists($TPL_File)) {
            $TPL = file_get_contents($TPL_File);
            foreach ($ParseTags as $TPL_TAG => $TPL_VIEW) {
                $TPL = str_replace("#" . $TPL_TAG . "#", $TPL_VIEW, $TPL);
            }
        } else {
            return false;
        }
        return $TPL;
    }
}
