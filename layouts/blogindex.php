<?php
class Layout {
  private function get_blog_posts() {
    // Get list of posts
    $offset = strlen(dirname(__FILE__, 2));
    $posts = glob(dirname(__FILE__, 2) . '/blog/*/*/*/*.md');

    // Get metadata for posts
    $files = array_map(function ($full_post_path) use ($offset) {
      $post_uri = substr($full_post_path, $offset);
      $file = new File($post_uri);
      $metadata = $file->get_metadata();
      $path_parts = pathinfo($post_uri);
      $metadata['_uri'] = $path_parts['dirname'] . '/' . $path_parts['filename'];
      return $metadata;
    }, $posts);

    // Sort in reverse order, that is to say newer dates first.
    usort($files, function ($a, $b) {
      if ($a['date'] === $b['date']) {
        return 0;
      }
      // ? -1 : 1 is normal order
      return ($a['date'] < $b['date']) ? 1 : -1;
    });

    return $files;
  }

  public function render($metadata) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Eduardo Lavaque's Blog</title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/main.css" rel="stylesheet">
</head>
<body>
<h1><?php echo $metadata['title']; ?></h1>
<p><a href="/">Go back to home page.</a></p>
<ul class="nodots">
  <?php foreach ($this->get_blog_posts() as $post) { ?>
    <li>
      <time datetime="<?php echo date('Y-m-d', $post['date']); ?>">
        <?php echo date('Y-m-d', $post['date']); ?>
      </time>
      &raquo;
      <a href="<?php echo $post['_uri']; ?>"><?php echo $post['title']; ?></a>
    </li>
  <?php } ?>
</ul>
</body>
</html>
    <?php
  }
}
