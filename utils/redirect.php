<?php
function redirect($path)
{
    header("location: /wishes/$path", true, 301);
}
