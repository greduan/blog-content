<?php
require_once dirname(__FILE__) . '/_header.php';
require_once dirname(__FILE__) . '/_blogindex.php';
require_once dirname(__FILE__) . '/_footer.php';

class Layout {

  public function render($metadata) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog - Eduardo Lavaque</title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/main.css" rel="stylesheet">
  <script defer data-domain="greduan.com" src="https://plausible.io/js/plausible.js"></script>
</head>
<body>
<?php render_header(); ?>
<p>
  <a href="https://politepol.com/fd/dA7bW5ovlLrk" target="_blank" rel="noopener">
    RSS feed via PolitePol.com
  </a>
</p>
<?php render_blog_posts(0); ?>
<?php render_footer(); ?>
</body>
</html>
    <?php
  }
}
