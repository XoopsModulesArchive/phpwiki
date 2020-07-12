<?php // $Id: admin.php,v 1.2 2005/05/04 19:11:46 dbritton Exp $

   function rcs_id($id) {}   // otherwise this gets in the way

   define('WIKI_ADMIN', true);  // has to be before includes

   include("./lib/config.php");
   include("./lib/stdlib.php");

   // this page is restricted to xoops admins for this module
   include_once(XOOPS_ROOT_PATH."/class/xoopsmodule.php");
   if ( $xoopsUser ) {
            $xoopsModule = XoopsModule::getByDirname("phpwiki");
            if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
                    redirect_header(XOOPS_URL."/",3,_NOPERM);
                    exit();
            }
   } else {
            redirect_header(XOOPS_URL."/",3,_NOPERM);
            exit();
   }

// the follow code is replaced by the previous code
/*
   // Set these to your preferences.
   // For heaven's sake pick a good password!
   $wikiadmin   = "";
   $adminpasswd = "";

   // Do not tolerate sloppy systems administration
   if (empty($wikiadmin) || empty($adminpasswd)) {
       echo gettext("Set the administrator account and password first.\n");
      exit;
   }

   // From the manual, Chapter 16
   if (($PHP_AUTH_USER != $wikiadmin  )  ||
       ($PHP_AUTH_PW   != $adminpasswd)) {
      Header("WWW-Authenticate: Basic realm=\"PhpWiki\"");
      Header("HTTP/1.0 401 Unauthorized");
      echo gettext("You entered an invalid login or password.");
      exit;
   }
*/

   // All requests require the database
   $dbi = OpenDataBase($WikiPageStore);

   if (isset($lock) || isset($unlock)) {
      include ('./admin/lockpage.php');
      $QUERY_STRING = $pagename;
   } elseif (isset($zip)) {
      include ('./lib/ziplib.php');
      include ('./admin/zip.php');
      ExitWiki('');
   } elseif (isset($dumpserial)) {
      include ('./admin/dumpserial.php');
   } elseif (isset($loadserial)) {
      include ('./admin/loadserial.php');
   } elseif (isset($remove)) {
      if (get_magic_quotes_gpc())
         $remove = stripslashes($remove);
      if (function_exists('RemovePage')) {
         $html .= sprintf(gettext ("You are about to remove '%s' permanently!"), htmlspecialchars($remove));
     $html .= "\n<P>";
     $url = rawurlencode($remove);
     $html .= sprintf(gettext ("Click %shere%s to remove the page now."),
          "<A HREF=\"$ScriptUrl?removeok=$url\">", "</A>");
     $html .= "\n<P>";
     $html .= gettext ("Otherwise press the \"Back\" button of your browser.");
      } else {
         $html = gettext ("Function not yet implemented.");
      }
      GeneratePage('MESSAGE', $html, gettext ("Remove page"), 0);
      ExitWiki('');
   } elseif (isset($removeok)) {
      if (get_magic_quotes_gpc())
     $removeok = stripslashes($removeok);
      RemovePage($dbi, $removeok);
      $html = sprintf(gettext ("Removed page '%s' succesfully."),
              htmlspecialchars($removeok));
      GeneratePage('MESSAGE', $html, gettext ("Remove page"), 0);
      ExitWiki('');
   }

   include('./index.php');
?>