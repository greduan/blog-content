<?php
function starts_with($haystack, $needle): bool {
  return substr($haystack, 0, strlen($needle)) === $needle;
}

function render_header() {
  ?>
<header id="masthead">
  <h1><ruby>Eduardo<rp>(</rp><rt>エドワード</rt><rp>)</rp> Lavaque <rp>(</rp><rt>ラバケ</rt><rp>)</rp></ruby></h1>

  <ul class="nodots">
    <li class="<?php echo $_SERVER['REQUEST_URI'] === '/' ? 'active' : ''; ?>">
      <a class="colorful" href="/">
        <ruby>Home <rp>(</rp><rt>ホーム</rt><rp>)</rp></ruby>
      </a>
    </li>
    <li class="<?php echo starts_with($_SERVER['REQUEST_URI'], '/blog') ? 'active' : ''; ?>">
      <a class="colorful"href="/blog">
        <ruby>Blog <rt>ブログ</rt></ruby>
      </a>
    </li>
    <li class="<?php echo starts_with($_SERVER['REQUEST_URI'], '/about') ? 'active' : ''; ?>">
      <a class="colorful" href="/about">
        <ruby>About <rp>(</rp><rt>アバウト</rt><rp>)</rp></ruby>
      </a>
    </li>
  </ul>
</header>
  <?php
}
