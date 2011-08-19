<?php
/**
 * This template was copied into the theme from
 * modules/book/book-export-html.tpl.php in order to override it.
 *
 * @see http://api.drupal.org/api/drupal/modules--book--book-export-html.tpl.php/7
 * @see template_preprocess_book_export_html()
 */

// Make the theme path available.
$path = drupal_get_path('theme', 'dgd7');
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language_rtl ? 'rtl' : 'ltr' ; ?>">
<head>
  <?php print $head; ?>
  <title><?php print $title; ?></title>
  <base href="<?php print $base_url; ?>" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&amp;subset=latin" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&amp;subset=latin" />
    <link rel="stylesheet" href="<?php print $path; ?>/css/print.css" />
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  </head>
  <body>
    <?php $section_close = ''; ?>
    <?php for ($i = 1; $i < $depth; $i++) : ?>
      <section id="section-<?php print $i; ?>">
      <?php $section_close .= '</section>'; ?>
    <?php endfor; ?>
    <?php print $contents; ?>
    <?php print $section_close; ?>
  </body>
</html>
