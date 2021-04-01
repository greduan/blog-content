<?php
class Layout {
  public function render($metadata, $contents, $parser) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $metadata['title']; ?> | Eduardo Lavaque's Blog</title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/main.css" rel="stylesheet">
</head>
<body>
<h1><?php echo $metadata['title']; ?></h1>
<p>
  Dated as
  <time datetime="<?php echo date('Y-m-d', $metadata['date']); ?>">
    <?php echo date('Y-m-d', $metadata['date']); ?>
  </time>
</p>
<?php echo $parser->parse_contents($contents); ?>
<hr />
<p><a href="/blog">Go back to blog posts list.</a></p>
</body>
</html>
    <?php
  }
}