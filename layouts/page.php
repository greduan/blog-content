<?php
require_once dirname(__FILE__) . '/_header.php';
require_once dirname(__FILE__) . '/_footer.php';

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
</head>
<body>
<?php render_header(); ?>
<article>
  <?php echo $parser->parse_contents($contents); ?>
</article>
<?php render_footer(); ?>
</body>
</html>
    <?php
  }
}
