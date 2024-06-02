<?php

/**
 * ------------------------------------------------------------------------------
 * - FUNCTION GET PATH
 * ------------------------------------------------------------------------------
 * - DATE: 31/03/2024
 * - AUTHOR: saber BELKHIR
 */

// function getPath($)
// {

// }

/**
 * ------------------------------------------------------------------------------
 * - Get Image Complete Path
 * ------------------------------------------------------------------------------
 * 
 * - DATE: 31/03/2024
 * 
 * - AUTHOR: saber BELKHIR
 * 
 * @param string $relative_path
 * 
 * @return string
 */
function image(string $relative_path): string
{
  return IMAGE_PATH . DIRECTORY_SEPARATOR . $relative_path;
}

