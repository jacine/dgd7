<?php
/**
 * This template was copied into the theme from modules/comment/comment.tpl.php
 * in order to override it.
 *
 * http://api.drupal.org/api/drupal/modules--comment--comment.tpl.php/7
 * @see template_preprocess()
 * @see template_preprocess_comment()
 * @see template_process()
 * @see theme_comment()
 *
 * Customizations:
 * - HTML5-ify markup.
 * - Remove permalink text.
 */

// Hide the parts we don't want to render inside render($content).
hide($content['links']);
?>
<article class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <header>
    <?php print $picture; ?>
    <?php if ($new): ?><mark class="new"><?php print $new; ?></mark><?php endif; ?>
    <?php print render($title_prefix); ?>
    <h3<?php print $title_attributes; ?>><?php print $title; ?></h3>
    <?php print render($title_suffix); ?>
    <p class="meta"><?php print $submitted; ?></p>
  </header>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($content); ?>
    <?php if ($signature): ?>
      <aside class="user-signature clearfix">
        <?php print $signature;  ?>
      </aside>
    <?php endif; ?>
  </div>
  <?php if ($content['links']): ?>
  <footer>
    <?php print render($content['links']); ?>
  </footer>
  <?php endif; ?>
</article>