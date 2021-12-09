<?php
use Twig\Environment;
 use Twig\Extension\DebugExtension;
 use Twig\Loader\FilesystemLoader;
 use Twig\TwigFilter;

 if (!function_exists('twig_conf')) {
     function twig_conf() {
         // the follwing line of code is the only one needed to make Twig work
         // the lines of code that follow are optional
         $loader = new FilesystemLoader('Views', '../app/');

         // to be able to use the 'dump' function in twig files
         $twig = new Environment($loader, ['debug' => true]);
         $twig->addExtension(new DebugExtension());

         // twig lets you create custom filters            
         $filter = new TwigFilter('_base_url', function ($asset) {
             return base_url() . '/' . $asset;
         });
         $twig->addFilter($filter);

         return $twig;
     }
 }