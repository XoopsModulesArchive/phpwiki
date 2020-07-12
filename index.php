<?php
// $Id: index.php,v 1.2 2005/05/04 19:11:46 dbritton Exp $
//
   /*
      The main page, i.e. the main loop.
      This file is always called first.
   */

   if (!defined('WIKI_ADMIN')) { // index.php not included by admin.php?
      include "./lib/config.php";
      include "./lib/stdlib.php";

      // All requests require the database
      $dbi = OpenDataBase($WikiPageStore);
   }

   // Allow choice of submit buttons to determine type of search:
   if (isset($searchtype) && ($searchtype == 'full'))
      $full = $searchstring;
   elseif (isset($searchstring))     // default to title search
      $search = $searchstring;

   if (isset($edit)) {
      include "./lib/editpage.php";
   } elseif (isset($links)) {
      include "./lib/editlinks.php";
   } elseif (isset($copy)) {
      include "./lib/editpage.php";
   } elseif (isset($search)) {
      include "./lib/search.php";
   } elseif (isset($full)) {
      include "./lib/fullsearch.php";
   } elseif (isset($refs)) {
      if (function_exists('InitBackLinkSearch')) {
     include "./lib/backlinks.php";
      }
      else {
     $full = $refs;
     include "./lib/fullsearch.php";
      }
   } elseif (isset($post)) {
      include "./lib/savepage.php";
   } elseif (isset($info)) {
      include "./lib/pageinfo.php";
   } elseif (isset($diff)) {
      include "./lib/diff.php";
   } else {
      include "./lib/display.php"; // defaults to FrontPage
   }

   CloseDataBase($dbi);

//---------------- footer --------------------------------------------------
include '../../footer.php';               // theme footer, notifications, etc.

?>