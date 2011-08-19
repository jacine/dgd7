<?php
/**
 * This template was copied into the theme from
 * modules/comment/comment-wrapper.tpl.php in order to override it.
 *
 * http://api.drupal.org/api/drupal/modules--comment--comment-wrapper.tpl.php/7
 * @see template_preprocess_comment_wrapper()
 * @see theme_comment_wrapper()
 */
?>
<section class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <h2 class="comment-title"><?php print t('Comments'); ?></h2>
    <?php print render($title_suffix); ?>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
  <?php if ($content['comment_form']): ?>
    <h2 class="comment-form"><?php print t('Add new comment'); ?></h2>
    <?php print render($content['comment_form']); ?>
  <?php endif; ?>
</section>
