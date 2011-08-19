<?php
/**
 * This template was copied into the theme from modules/user/user-picture.tpl.php
 * in order to override it.
 *
 * @see http://api.drupal.org/api/drupal/modules--user--user-picture.tpl.php/7
 * @see template_preprocess_user_picture()
 * @see dgd7_preprocess_user_picture()
 *
 * Customizations:
 * - In dgd7_preprocess_user_picture(), we added a custom variable containing
 *   a link to the edit the user's profile if the current user his/her own
 *   picture. This is covered on page 320.
 */
?>
<?php if ($user_picture): ?>
  <div class="user-picture">
    <?php print $user_picture; ?>
    <?php print $edit_picture; ?>
  </div>
<?php endif; ?>
