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
 * - HTML5-ify the markup.
 */

// Hide the parts we don't want to render inside render($content).
hide($content['comments']);
hide($content['links']);
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if(!empty($user_picture) || !$page || (!empty($submitted) && $display_submitted)): ?>
  <header class="clearfix<?php $user_picture ? print ' with-picture' : ''; ?>">
    <?php print $user_picture; ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php if ($display_submitted): ?>
      <span class="meta" role="contentinfo"><?php print $submitted; ?></span>
    <?php endif; ?>
    <?php if (!empty($content['field_tags'])): ?>
      <?php print render($content['field_tags']);  ?>
    <?php endif; ?>
  </header>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <div class="content">
    <?php print render($content); ?>
  </div>
  <?php if (!empty($content['links'])): ?>
    <footer>
      <nav class="links">
        <?php print render($content['links']); ?>
      </nav>
    </footer>
  <?php endif; ?>
</article>

<?php if ($content['comments'] && $page): ?>
  <section class="comments">
    <?php print render($content['comments']); ?>
  </section>
<?php endif; ?>
