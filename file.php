<?php
function countLineOfFile($file)
{
    return count(file($file));
}