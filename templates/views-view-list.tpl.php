<?php
/**
 * This template was copied into the theme from
 * sites/all/modules/views/theme/views-view-list.tpl.php
 * in order to override it.
 *
 * @see http://drupalcontrib.org/api/drupal/contributions--views--theme--views-view-list.tpl.php/7
 * @see template_preprocess_views_view_list()
 *
 * Customizations:
 * - Removed the default row classes and opted for just "row" instead.
 */
?>
<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <?php print $list_type_prefix; ?>
    <?php foreach ($rows as $id => $row): ?>
      <li class="row"><?php print $row; ?></li>
    <?php endforeach; ?>
  <?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>
