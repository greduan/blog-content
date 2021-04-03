<?php
require_once dirname(__FILE__) . '/_header.php';

class Layout {
  public function render($metadata, $contents, $parser) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $metadata['title']; ?></title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/main.css" rel="stylesheet">
</head>
<body>
<?php render_header(); ?>
<?php echo $parser->parse_contents($contents); ?>
</body>
</html>
    <?php
  }
}
