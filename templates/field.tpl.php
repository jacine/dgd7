<?php
/**
 * This template was copied into the theme from
 * modules/field/theme/field.tpl.php in order to override it.
 *
 * http://api.drupal.org/api/drupal/modules--field--theme--field.tpl.php/7
 * @see template_preprocess_field()
 * @see dgd7_preprocess_field()
 * @see theme_field()
 *
 * Customizations:
 *  - When there are more than one values for a field, output the items
 *    in an unordered list.
 *  - $heading: When view mode is 'full' it's <h2>, otherwise, it's <h3>.
 *  - $classes: was modified to remove some classes in template.php.
 */

$count = count($items);
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <<?php print $heading . $title_attributes; ?>><?php print $label; ?></<?php print $heading; ?>>
  <?php endif; ?>
  <?php if ($count > 1): ?>
    <?php // Use a list for multiple values. ?>
    <ul<?php print $content_attributes; ?>>
      <?php foreach ($items as $delta => $item): ?>
      <li><?php print render($item); ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <?php // Omit wrapper unless attributes exist for single values. ?>
    <?php if (!empty($content_attributes)): ?><div<?php print $content_attributes; ?>><?php endif; ?>
      <?php print render($items); ?>
    <?php if (!empty($content_attributes)): ?></div><?php endif; ?>
  <?php endif; ?>
</div>
