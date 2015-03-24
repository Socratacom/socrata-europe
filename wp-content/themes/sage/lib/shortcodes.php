<?php

namespace Roots\Sage\Shortcodes;


// [customer-logos]
add_shortcode('customer-logos', __NAMESPACE__ . '\\customer_logos');
function customer_logos() {
  return '
  <section style="padding:50px 0;">
  <div class="container">
  <h2 class="text-center" style="margin:0 0 40px 0;">Who&rsquo;s using Socrata?</h2>
  <div class="row">
<div class="col-sm-2">
<img src="http://placehold.it/200x200" class="img-responsive">
</div>
<div class="col-sm-2">
<img src="http://placehold.it/200x200" class="img-responsive">
</div>
<div class="col-sm-2">
<img src="http://placehold.it/200x200" class="img-responsive">
</div>
<div class="col-sm-2">
<img src="http://placehold.it/200x200" class="img-responsive">
</div>
<div class="col-sm-2">
<img src="http://placehold.it/200x200" class="img-responsive">
</div>
<div class="col-sm-2">
<img src="http://placehold.it/200x200" class="img-responsive">
</div>

  </div>
  </div>
  </section>
  ';
}

// [newsletter-cta]
add_shortcode('newsletter-cta', __NAMESPACE__ . '\\newsletter_cta');
function newsletter_cta() {
  return '
  <section style="padding:50px 0; background:#3498DB;">
  <div class="container">
  </div class="row">
  <p class="text-center">Newsletter CTA here.</p>
  </div>
  </div>
  </section>
  ';
}