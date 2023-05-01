<?php
require_once dirname(__FILE__) . '/_header.php';
require_once dirname(__FILE__) . '/_blogindex.php';

class Layout {
  public function render($metadata, $contents, $parser) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $metadata['title']; ?></title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/main.css" rel="stylesheet">
  <script defer data-domain="greduan.com" src="https://plausible.io/js/plausible.js"></script>
</head>
<body>
<?php render_header(); ?>
<article>
  <?php echo $parser->parse_contents($contents); ?>
</article>
<?php render_blog_posts(10); ?>
</body>
</html>
    <?php
  }
}
