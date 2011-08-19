<?php
/**
 * This template was copied into the theme from modules/system/page.tpl.php
 * in order to override it.
 *
 * @see http://api.drupal.org/api/drupal/modules--system--page.tpl.php/7
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 *
 * Customizations:
 *  - Most of the markup and many of the variables have been changed.
 *  - In dgd7.info we:
 *    - Added a couple of new regions, which are printed here.
 *    - Specified that we do not support the $logo variable, so it has been
 *     deleted from this file.
 *  - We removed the horribly complex code that prints the primary and
 *     secondary menus, and replaced it with a navigation region. In the
 *     Blocks administration page, we added the "Main menu" block to replace
 *     them.
 */
?>
<div class="wrapper">
<header class="container" role="banner">
  <div class="header">
    <?php if ($site_name || $site_slogan): ?>
      <hgroup>
      <?php if ($site_name): ?>
        <h1 class="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
        </h1>
      <?php endif; ?>
      <?php if ($site_slogan): ?>
        <div class="site-slogan"><?php print $site_slogan; ?></div>
      <?php endif; ?>
    </hgroup>
   <?php endif; ?>
   <?php print render($page['header']); ?>
  </div>
</header>

<?php if ($navigation = render($page['navigation'])): ?>
  <nav role="navigation" class="container">
    <?php print $navigation; ?>
  </nav>
<?php endif; ?>

<div class="container">
  <div class="container-inner">
  <?php print $messages; ?>
  <div class="column main" role="main">
    <?php print render($page['highlight']); ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($tabs = render($tabs)): ?>
      <div class="tabs"><?php print $tabs; ?></div>
    <?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links = render($action_links)): ?>
      <ul class="action-links"><?php print $action_links; ?></ul>
    <?php endif; ?>
    <?php print render($page['content']); ?>
    <?php print $feed_icons; ?>
  </div>

  <?php if ($sidebar_first = render($page['sidebar_first'])): ?>
    <div class="column sidebar column-first">
      <?php print $sidebar_first; ?>
    </div>
  <?php endif; ?>
  
  <?php if ($sidebar_second = render($page['sidebar_second'])): ?>
    <div class="column sidebar column-second">
      <?php print $sidebar_second; ?>
    </div>
  <?php endif; ?>
  </div>
</div>

<footer class="container" role="contentinfo">
  <?php print render($page['footer']); ?>
</footer>
</div>
