<?php use Roots\Sage\Nav; ?>

<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="white-logo header-logo" href="<?php echo home_url('/'); ?>"></a>
      <a class="corporate-link hidden-xs" href="http://socrata.com"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Socrata.com</a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'nav navbar-nav hidden-xs']);
      endif;
      ?>
      <?php
      if (has_nav_menu('mobile')) :
        wp_nav_menu(['theme_location' => 'mobile', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'nav navbar-nav hidden-sm hidden-md hidden-lg']);
      endif;
      ?>
    </nav>
  </div>
</header>
