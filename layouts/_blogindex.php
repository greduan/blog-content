<?php
function get_blog_posts() {
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

function render_blog_posts($only_first_x) {
  $posts = get_blog_posts();

  // Filter out posts that are in the future
  $today = strtotime(date('Y-m-d'));
  $posts = array_filter($posts, function($post) use ($today) {
    return strtotime(date('Y-m-d', $post['date'])) <= $today;
  });

  if ($only_first_x > 0) {
    $posts = array_slice($posts, 0, $only_first_x);
  }

  // Group posts by year
  $years = array_reduce($posts, function ($carry, $post) {
    $year = date('Y', $post['date']);
    if (!isset($carry[$year])) {
      $carry[$year] = [];
    }
    $carry[$year][] = $post;
    return $carry;
  }, []);
  ?>
<div id="blogindex">
  <?php foreach ($years as $year => $posts) { ?>
    <h3><?php echo $year; ?></h3>
    <?php foreach ($posts as $post) { ?>
      <div class="blogpost">
        <div class="date">
          <time datetime="<?php echo date('Y-m-d', $post['date']); ?>">
            <?php echo date('Y-m-d', $post['date']); ?>
          </time>
        </div>
        <div class="link">
          <a href="<?php echo $post['_uri']; ?>"><?php echo $post['title']; ?></a>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
</div>
  <?php
}
