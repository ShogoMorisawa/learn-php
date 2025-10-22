<?php

if (!function_exists('h')) {
    function h($v)
    {
        return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    }
}

if (!empty($_SESSION['flash']['status'])): ?>
  <div class="flash flash--success"><?= h($_SESSION['flash']['status']) ?></div>
<?php unset($_SESSION['flash']['status']);endif;
?>

<?php if (!empty($_SESSION['flash']['errors'])): ?>
  <ul class="flash flash--error">
    <?php foreach ((array) $_SESSION['flash']['errors'] as $err): ?>
      <li><?= h($err) ?></li>
    <?php endforeach; ?>
  </ul>
<?php unset($_SESSION['flash']['errors']);endif; ?>
