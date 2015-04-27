<?php

namespace Roots\Sage\Shortcodes;




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