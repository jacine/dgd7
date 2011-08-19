<?php
/**
 * This template was copied into the theme from modules/node/node.tpl.php
 * in order to override it.
 *
 * @see http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * Customizations:
 * - Removed most of the default markup, variables, links and comment
 *   functionality.
 * - Print only the title, image and content.
 */

// Hide the parts we don't want to render inside render($content).
hide($content['comments']);
hide($content['links']);
?>
<?php print render($content['field_image']); ?>
<h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
<?php print render($content); ?>
