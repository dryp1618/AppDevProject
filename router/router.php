<?php

$request = strtok($_SERVER['REQUEST_URI'], "?");

if ($request === "/" || $request === "/home") {
    $view = "home";
} else {
    $base = realpath(__DIR__ . "/views");
    $path = realpath(__DIR__ . "/views" . $request . ".php");

    if ($path && str_starts_with($path, $base)) {
        $view = ltrim($request, "/");
    } else {
        $view = null;
    }
}

?>
<p>Router working</p>