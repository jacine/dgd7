<?php
/**
 * This template was copied into the theme from
 * modules/book/book-navigation.tpl.php in order to override it.
 *
 * http://api.drupal.org/api/drupal/modules--book--book-navigation.tpl.php/7
 * @see template_preprocess_book_navigation()
 */
?>
<?php if ($tree || $has_links): ?>
  <div class="book-navigation">
    <?php print $tree; ?>
    <?php if ($has_links): ?>
    <ul class="page-links">
      <?php if ($prev_url): ?>
        <li class="page-previous"><a href="<?php print $prev_url; ?>" rel="prev" title="<?php print t('Go to previous page'); ?>"><span class="icon"></span><?php print $prev_title; ?></a></li>
      <?php endif; ?>
      <?php if ($parent_url): ?>
        <li class="page-up"><a href="<?php print $parent_url; ?>" title="<?php print t('Go to parent page'); ?>"><?php print t('up'); ?></a></li>
      <?php endif; ?>
      <?php if ($next_url): ?>
        <li class="page-next"><a href="<?php print $next_url; ?>" rel="next" title="<?php print t('Go to next page'); ?>"><?php print $next_title; ?><span class="icon"></span></a></li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
  </div>
<?php endif; ?>