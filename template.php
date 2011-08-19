<?php

// Preprocess & Process Implementations
// See pages 313-321.
//------------------------------------------------------------------------------

/**
 * Implements template_preprocess_html().
 *
 * The changes made in this function affect the variables for the html.tpl.php
 * template file, which is located in templates/html.tpl.php of this theme.
 * Using drupal_css_css() is covered on pages 344-345.
 */
function dgd7_preprocess_html(&$vars) {
  // Unfortunately, the XHTML+RDFa 1.0 doctype is hardcoded. We don't want an
  // XHMTL doctype and the RDFa version is old. The following code changes it
  // to HTML+RDFa 1.1 when the RDF module is enabled, and a plain jane HTML5
  // doctype when it's not. To learn more about theming with RDFa in Drupal 7
  // see http://lin-clark.com/blog/theming-html5-and-rdfa-drupal-7
  if (module_exists('rdf')) {
    $vars['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">' . "\n";
    $vars['rdf_profile'] = ' profile="' . $vars['grddl_profile'] . '"';
  }
  else {
    $vars['doctype'] = '<!DOCTYPE html>' . "\n";
    $vars['rdf_profile'] = '';
  }

  // Add externally hosted files. This will not work if entered in .info file.
  // Setting the group to CSS_THEME will load these files in the "theme group"
  // which load after system and module CSS files. This is not terribly
  // important in this case, but we do need to specify "external" as TRUE.
  // Ideally that wouldn't be necessary it would "just work" like
  // drupal_add_js(). See http://drupal.org/node/953340 to help make it happen.
  drupal_add_css('http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic&subset=latin', array(
    'external' => TRUE,
    'group' => CSS_THEME,
    )
  );
  drupal_add_css('http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&subset=latin', array(
    'external' => TRUE,
    'group' => CSS_THEME,
    )
  );
  
  // Create a variable containing the path to the theme. We'll use this in
  // in html.tpl.php.
  $vars['path'] = drupal_get_path('theme', 'dgd7');

  // Add the regular theme stylesheets.
  // This is done here as opposed to using the .info file so that we can control
  // the order. Since we cannot add the external CSS files via .info and we need
  // those to load first, we add them all here.
  drupal_add_css($vars['path'] . '/css/layout.css', array('group' => CSS_THEME));
  drupal_add_css($vars['path'] . '/css/forms.css', array('group' => CSS_THEME));
  drupal_add_css($vars['path'] . '/css/style.css', array('group' => CSS_THEME));

  // We have a separate CSS file for styling the tabs that we only want to load
  // when there are actually tabs present. The following code checks for the
  // existence of primary and secondary tabs and then proceeds to load the CSS
  // file if needed.
  if (menu_primary_local_tasks() || menu_secondary_local_tasks()) {
    drupal_add_css($vars['path'] . '/css/tabs.css', array(
      'group' => CSS_THEME,
      'preprocess' => FALSE,
      )
    );
  }
  // Add a print stylesheet.
  drupal_add_css($vars['path'] . '/css/print.css', array(
    'group' => CSS_THEME,
    'media' => 'print',
    'preprocess' => FALSE,
    )
  );

  // Add a conditional stylesheet for Internet Explorer.
  // The "browsers" key allows you to specify what versions of IE to target. In
  // this case we are targeting "less than or equal to IE 7". Drupal will wrap
  // the code for this stylesheet in conditional comments:
  // "<!--[if lte IE 7]> … <![endif]-->. For more details about conditional
  // comments see: http://www.quirksmode.org/css/condcom.html
  drupal_add_css($vars['path'] . '/css/ie.css', array(
    'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE),
    'group' => CSS_THEME,
    'preprocess' => FALSE,
    )
  );

  // In template_preprocess_html() we have easy access to the "class" attribute
  // for the <body> element. Here we add a helper class that indicates that
  // there is no title for the page to help styling the content region easily.
  if (!drupal_get_title()) {
    $vars['classes_array'][] = 'no-title';
  }
}

/**
 * Implements template_preprocess_region().
 *
 * The changes made in this function affect the variables for the region.tpl.php
 * template file. In this theme we have not overridden this template, so the
 * core default, located in modules/system/region.tpl.php isbeing used. This
 * code is covered on pages 318-319.
 */
function dgd7_preprocess_region(&$vars) {
  $region = $vars['region'];

  // Add an "outer" class to the darker regions.
  if (in_array($region, array('header', 'footer', 'sidebar_first', 'sidebar_second'))) {
    $vars['classes_array'][] = 'outer';
  }
}

/**
 * Implements template_preprocess_block().
 *
 * The changes made in this function affect the variables for the block.tpl.php
 * template file. In this theme we have not overridden this template, so the
 * core default, located in modules/block/block.tpl.php is being used.
 * $title_attributes_array is covered along with global template variables on
 * pages 296-298.
 */
function dgd7_preprocess_block(&$vars) {
  // Give the title a decent class.
  $vars['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Implements template_preprocess_node().
 * 
 * The changes made in this function affect the variables for the
 * templates/node.tpl.php template file. In this theme we have not overridden
 * this template, so the core default, located in modules/block/block.tpl.php
 * is being used. This example is covered on pages 319-320.
 */
function dgd7_preprocess_node(&$vars) {
  // Give node titles decent classes.
  $vars['title_attributes_array']['class'][] = 'node-title';

  // Remove the "Add new comment" link when the form is below it.
  if (!empty($vars['content']['comments']['comment_form'])) {
    unset($vars['content']['links']['#links']['comment-add']);
  }

  // Make some changes when in teaser mode.
  if ($vars['teaser']) {
    // Don't display author or date information.
    $vars['display_submitted'] = FALSE;
    // Trim the node title and append an ellipsis.
    $vars['title'] = truncate_utf8($vars['title'], 70, TRUE, TRUE);
  }
}

/**
 * Implements template_preprocess_field().
 *
 * The changes made in this function affect the variables for the
 * field.tpl.php template file and theme_field() where used.
 */
function dgd7_preprocess_field(&$vars) {
  // If the view mode is "full" use <h2> for the field labels. Otherwise, assume
  // a teaser or more compact view mode is being displayed, and use <h3>. This
  // may not always be 100% accurate, but it's definitely better than the
  // defaults and of course individual overrides can be performed per field
  // and view mode using theme hook suggestions. See pages 304-310 for details.
  $vars['heading'] = ($vars['element']['#view_mode'] == 'full') ? 'h2' : 'h3';

  // By default, in "book" nodes label reads "chapter number" and the value is
  // "chapter 1." In this code we change the value to simply read the number
  // instead of repeating chapter.
  if ($vars['element']['#bundle'] == 'book' && $vars['element']['#field_name'] == 'field_number') {
    $vars['items'][0]['#markup'] =  $vars['element'][0]['#markup'];
  }

  // Remove some classes from the wrapper <div>.
  // You might be wondering "Why not just remove all of them and start from
  // scratch?" The answer is that I want to keep certain functionality, such as
  // inline vs. above labels, which are configurable in the UI. Doing it this
  // way also ensures that the classes are still pluggable via other modules
  // and that I'm only removing what I really want to remove.
  $classes_to_remove = array(
    // Don't need or want most of these:
    'field',
    'field-label-hidden',
    'field-type-' . drupal_html_class($vars['element']['#field_type']),
    'field-name-' . drupal_html_class($vars['element']['#field_name']),
    'body',
    'clearfix',
  );

  // Add a less verbose field name class: .field-NAME
  $vars['classes_array'][] = drupal_html_class($vars['element']['#field_name']);

  // Remove the classes defined above.
  $vars['classes_array'] = array_diff($vars['classes_array'], $classes_to_remove);

}

/**
 * Implements template_preprocess_user_picture().
 * - Add "change picture" link to be placed underneath the user image.
 */
function dgd7_preprocess_user_picture(&$vars) {
  // Create a variable with an empty string to prevent PHP notices when
  // attempting to print the variable.
  $vars['edit_picture'] = '';
  // The account object contains the information of the user whose photo is
  // being processed. We compare that to the user id of the user object which
  // represents the currently logged in user.
  if ($vars['account']->uid == $vars['user']->uid) {
    // Create a variable containing a link to the user profile, with a class
    // "change-user-picture" that we'll style against with CSS.
    $vars['edit_picture'] = l('Change picture', 'user/' . $vars['account']->uid . '/edit', array(
      'fragment' => 'edit-picture',
      'attributes' => array('class' => array('change-user-picture')),
      )
    );
  }
}

/**
 * Implements template_process_page().
 */
function dgd7_process_page(&$vars) {
  // Prevent variables we moved to render arrays from printing twice or throwing
  // PHP notice errors. This is only necessary if these variables still exist in
  // the page.tpl.php file, which is common when inheriting a template from a
  // base theme or core.
  $vars['breadcrumb'] = '';
  $vars['messages'] = '';
}

// Render API Implementations
// See pages 321-327.
//------------------------------------------------------------------------------

/**
 * Implements hook_html_head_alter().
 *
 * The purpose of this alter function is to modify the contents of the $head
 * variable which prints in html.tpl.php. This variable is created in
 * template_process_html() using the function drupal_get_html_head(). Here we
 * add 2 <meta>, <link> tag and simplify the <meta charset />.
 */
function dgd7_html_head_alter(&$head_elements) {
  // Simplify the meta charset declaration.
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );
}

/**
 * Implements hook_css_alter().
 *
 * hook_css_alter() is covered on pg. 345-346. System module stylesheets are
 * covered on pg. 342.
 *
 * This code in this function removes 3 core stylesheets from the System module.
 * They can be removed in .info files, but there is currently a bug that
 * prevents them from staying gone when AJAX content is rendered stylesheets.
 * The bug report is located here: http://drupal.org/node/967166. Until that
 * issue is fixed, we can remove the stylesheets by implementing
 * hook_css_alter(), which works properly.
 */
function dgd7_css_alter(&$css) {
  unset(
    $css['modules/system/system.theme.css'],
    $css['modules/system/system.menus.css'],
    $css['modules/system/system.messages.css']
  );
}

/**
 * Implements hook_page_alter().
 *
 * hook_page_alter() allows us to control the contents the $page render array.
 * This array contains populated theme regions and is printed in page.tpl.php.
 */
function dgd7_page_alter(&$page) {
  // Remove the block template wrapper from the main content block.
  // The reason we don't use unset() is because #theme_wrappers is an array that
  // can contain multiple values. Since other modules can potentially add to
  // this value, here we make sure that we're specifically removing the block
  // wrapper.
  if (!empty($page['content']['system_main'])) {
    $page['content']['system_main']['#theme_wrappers'] = array_diff($page['content']['system_main']['#theme_wrappers'], array('block'));
  }

  // If on the front page, remove the sidebars and content region.
  // This will prevent the regions from printing in the page.tpl.php template or
  // variation of it. You can also accomplish the same affect by creating a
  // page--front.tpl.php, and removing the code that prints these variables.
  if (drupal_is_front_page()) {
    unset($page['sidebar_first'], $page['sidebar_second'], $page['content']);
  }

  // Add the breadcrumbs to the bottom of the footer region.
  // This is example of adding new content to a render array (covered on pg.
  // 325). The footer region already exists, and we are adding breadcrumbs to
  // it. Note: This alone will cause the breadcrumbs to print twice on the page
  // because the $breadcrumb variable is created during
  // template_process_page() and printed in page.tpl.php. The variable needs to
  // be removed and/or emptied in a process function. We've done this here in
  // dgd7_process_page().
  $page['footer']['breadcrumbs'] = array(
    '#type' => 'container',
    '#attributes' => array('class' => array('breadcrumb-wrapper')),
    '#weight' => 10,
  );
  $page['footer']['breadcrumbs']['breadcrumb'] = array(
    '#theme' => 'breadcrumb',
    '#breadcrumb' => drupal_get_breadcrumb(),
  );
  // Trigger the contents of the footer region to be sorted.
  $page['footer']['#sorted'] = FALSE;

  // Move the messages into the help region.
  // Note: This alone will cause the breadcrumbs to print twice on the page
  // because the $messages variable is created during
  // template_process_page() and printed in page.tpl.php. The variable needs to
  // be removed and/or emptied in a process function. We've done this here in
  // dgd7_process_page().
  if ($page['#show_messages']) {
    $page['help']['messages'] = array(
      '#markup' => theme('status_messages'),
      '#weight' => -10,
    );
    // Trigger the contents of the help region to be sorted.
    $page['help']['#sorted'] = FALSE;
  }
}

/**
 * Implements hook_menu_local_tasks_alter().
 *
 * hook_menu_local_tasks_alter() allows us to control the contents of both the
 * $tabs and $action_links render arrays that print in page.tpl.php. In this
 * example we change the title of 2 tabs that appear only on the user profile
 * page. Note: This specific implementation might be better off in a module
 * because it does not necessarily need to be theme-specific.
 */
function dgd7_menu_local_tasks_alter(&$data, $router_item, $root_path) {
  // Add <span class="icon"/> inside action links.
  foreach ($data['actions']['output'] as $key => $link) {
    // Set the link to allow a title with HTML in it.
    $data['actions']['output'][$key]['#link']['localized_options']['html'] = TRUE;
    // When HTML is set to true, the title must be manually sanitized.
    $title = check_plain($data['actions']['output'][$key]['#link']['title']);
    // Change the title to include the icon markup and sanitized title.
    $data['actions']['output'][$key]['#link']['title'] = '<span class="icon"/></span>' . $title;
  }

  if ($root_path == 'user/%') {
    // Change the first tab title from 'View' to 'My profile'.
    if ($data['tabs'][0]['output'][0]['#link']['title'] == t('View')) {
      $data['tabs'][0]['output'][0]['#link']['title'] = t('Profile');
    }
    // Change the second tab title from 'Edit' to 'Edit profile'.
    if ($data['tabs'][0]['output'][1]['#link']['title'] == t('Edit')) {
      $data['tabs'][0]['output'][1]['#link']['title'] = t('Edit profile');
    }
  }
}

/**
 * Implements hook_form_ID_alter().
 */
function dgd7_form_comment_form_alter(&$form, &$form_state) {
  // Injects a wrapper <div> around the comment notification radio options with
  // the "container-inline" class which automatically inlines form elements
  // inside it.
  $form['notify_settings']['notify_type']['#prefix'] = '<div class="container-inline">';
  $form['notify_settings']['notify_type']['#suffix'] = '</div>';
}

// Theme Functions
// See pages 301-310 and 333-336.
//------------------------------------------------------------------------------

/**
 * Overrides theme_links().
 * Note: The core implementation of theme_links() contains bugs. This
 * version of the theme function originates from the Edge module.
 * @see http://drupal.org/project/edge
 *
 * This theme function implements a theme hook suggestion (Pgs. 304-310).
 * Added: <span class="icon"> before links on instances of theme_links()
 * used within nodes.
 */
function dgd7_links__node($variables) {
  global $language_url;

  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  $output = '';

  if ($links) {
    // Prepend the heading to the list, if any.
    if ($heading) {
      // Convert a string heading into an array, using a H2 tag by default.
      if (is_string($heading)) {
        $heading = array('text' => $heading);
      }
      // Merge in default array properties into $heading.
      $heading += array(
        'level' => 'h2',
        'attributes' => array(),
      );
      // @todo D8: Remove backwards compatibility for $heading['class'].
      if (isset($heading['class'])) {
        $heading['attributes']['class'] = $heading['class'];
      }

      $output .= '<' . $heading['level'] . drupal_attributes($heading['attributes']) . '>';
      $output .= check_plain($heading['text']);
      $output .= '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 0;
    foreach ($links as $key => $link) {
      $i++;

      $class = array();
      // Use the array key as class name.
      $class[] = drupal_html_class($key);
      // Add odd/even, first, and last classes.
      $class[] = ($i % 2 ? 'odd' : 'even');
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      $item = '';

      // Handle links.
      if (isset($link['href'])) {
        $is_current_path = ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()));
        $is_current_language = (empty($link['language']) || $link['language']->language == $language_url->language);
        if ($is_current_path && $is_current_language) {
          $class[] = 'active';
        }
        // Pass in $link as $options, they share the same keys.
        $item = '<span class="icon"></span>' . l($link['title'], $link['href'], $link);
      }
      // Handle title-only text items.
      else {
        // Merge in default array properties into $link.
        $link += array(
          'html' => FALSE,
          'attributes' => array(),
        );
        $item .= '<span' . drupal_attributes($link['attributes']) . '>';
        $item .= ($link['html'] ? $link['title'] : check_plain($link['title']));
        $item .= '</span>';
      }

      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';
      $output .= $item;
      $output .= '</li>';
    }

    $output .= '</ul>';
  }

  return $output;
}

/**
 * Overrides theme_breadcrumb().
 *
 * - It's totally asinine to print just a "home" link for breadcrumbs when
 *   that's all there is. Here we only return output when there is more
 *   than one result.
 */
function dgd7_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (count($breadcrumb) > 1) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $output .= '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Overrides theme_status_messages().
 *
 * - Make the message type indicator visible. By default, it's hidden using the
 *   .element-invisible class, which visually hides the text, but keeps it
 *   available to screen reader users.
 * - Add a <span class="icon"> so icons can easily be added via a sprite.
 * - Wrap the messages themselves in <div class="content">.
 */
function dgd7_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status'),
    'error' => t('Error'), 
    'warning' => t('Warning'),
  );
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"messages $type\">\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="message-title"><span class="icon"></span>' . $status_heading[$type] . "</h2>\n";
    }
    $output .= '<div class="content">';
    if (count($messages) > 1) {
      $output .= "<ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
    $output .= "</div>\n";
  }
  return $output;
}
