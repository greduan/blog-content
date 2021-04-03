<?php
require_once dirname(__FILE__) . '/_header.php';
require_once dirname(__FILE__) . '/_footer.php';

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog - Eduardo Lavaque</title>
  <link href="/assets/normalize.css" rel="stylesheet">
  <link href="/assets/main.css" rel="stylesheet">
</head>
<body>
<?php render_header(); ?>
<table id="blogindex">
  <tbody>
    <?php foreach ($this->get_blog_posts() as $post) { ?>
      <tr>
        <td>
          <time datetime="<?php echo date('Y-m-d', $post['date']); ?>">
            <?php echo date('Y-m-d', $post['date']); ?>
          </time>
        </td>
        <td>
          <a href="<?php echo $post['_uri']; ?>"><?php echo $post['title']; ?></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php render_footer(); ?>
</body>
</html>
    <?php
  }
}
