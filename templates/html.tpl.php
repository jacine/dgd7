<?php
/**
 * This template was copied into the theme from modules/system/html.tpl.php in
 * order to override it.
 *
 * @see http://api.drupal.org/api/drupal/modules--system--html.tpl.php/7
 * @see template_preprocess_html().
 * @see dgd7_preprocess_html().
 * @see template_process_html().
 *
 * Customizations:
 * - In a preprocess function called dgd7_preprocess_html() in template.php
 *   (see code above) we created:
 *     - The variable $doctype, which we use below in order to use the
 *       HTML5+RDFa 1.1 doctype when the RDF module is enabled, and the plain
 *       HTML5 doctype when the RDF module is disabled.
 *    - A $path variable containing the full path to the theme this file lives
 *      in was created.
 * - Below we a couple <meta> tags and an Apple touch icon. There's a lot more
 *   that can be added here. See http://html5boilerplate.com for plenty of
 *   awesome related resources.
 * - Add the HTML5 Shiv for IE versions prior to 9.
 */
?>
<?php print $doctype; ?>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_version . $rdf_namespaces; ?>>
  <head<?php print $rdf_profile; ?>>
  <?php print $head; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="apple-touch-icon-precomposed" href="<?php print $path; ?>/images/apple-touch-icon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div class="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
