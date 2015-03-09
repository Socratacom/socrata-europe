<?php use Roots\Sage\Nav; ?>

<!--<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'nav navbar-nav']);
      endif;
      ?>
    </nav>
  </div>
</header>-->



<header>
  <nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">         
      <a class="white-logo header-logo" href="<?php echo home_url('/'); ?>"></a>
      <a class="corporate-link hidden-xs" href="http://socrata.com"><i class="fa fa-chevron-left"></i> Back to Socrata.com</a>
      <!-- Main Menu -->
      <?php wp_nav_menu( array( 'theme_location' => 'header', 'container_class' => 'hidden-xs' )); ?>
      <!-- Mobile Menu -->
      <ul id="gn-menu" class="gn-menu-main hidden-sm hidden-md hidden-lg">
        <li class="gn-trigger">
          <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
          <nav class="gn-menu-wrapper">
            <?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container_class' => 'gn-scroller', 'menu_class' => 'gn-menu' )); ?>
          </nav>
        </li>
      </ul>
    </div>
  </nav>
</header>