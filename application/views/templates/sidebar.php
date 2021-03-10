<div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/vendor/material-dashboard'); ?>/assets/img/sidebar-1.jpg">
  <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
  <div class="logo"><a href="<?= base_url('dashboard'); ?>" class="simple-text logo-normal">
      <img src="<?= base_url('assets/img/cvmajulancar.png'); ?>" alt="logo">
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <?php $menu = $this->db->get('menu_sp')->result_array(); ?>
      <?php foreach ($menu as $m) : ?>
        <?php if ($m['menu'] == $title) : ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?= base_url() . $m['url']; ?>">
              <i class="material-icons"><?= $m['icon']; ?></i>
              <p><?= $m['menu']; ?></p>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() . $m['url']; ?>">
              <i class="material-icons"><?= $m['icon']; ?></i>
              <p><?= $m['menu']; ?></p>
            </a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
      <!-- <li class="nav-item active-pro ">
            <a class="nav-link" href="./upgrade.html">
              <i class="material-icons">unarchive</i>
              <p>Upgrade to PRO</p>
            </a>
          </li> -->
    </ul>
  </div>
</div>
<div class="main-panel">