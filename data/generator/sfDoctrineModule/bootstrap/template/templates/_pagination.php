<div class="pagination sf_admin_pagination">
    <ul>
        <li class="prev[?php if ($pager->isFirstPage()): ?] disabled[?php endif; ?]"><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">← [?php echo __('Previous'); ?]</a></li>
        [?php foreach ($pager->getLinks() as $page): ?]
        <li[?php if ($pager->getPage() == $page): ?] class="active"[?php endif; ?]><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a></li>
        [?php endforeach; ?]
        <li class="next[?php if ($pager->isLastPage()): ?] disabled[?php endif; ?]"><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">[?php echo __('Next'); ?] →</a></li>
    </ul>
<?php if (false): ?>
    <ul>
        <li>
          <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">
            [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/first.png', array('alt' => __('First page', array(), 'sf_admin'), 'title' => __('First page', array(), 'sf_admin'))) ?]
          </a>
        </li>

        <li>
  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/previous.png', array('alt' => __('Previous page', array(), 'sf_admin'), 'title' => __('Previous page', array(), 'sf_admin'))) ?]
  </a>
        </li>

  [?php foreach ($pager->getLinks() as $page): ?]
    [?php if ($page == $pager->getPage()): ?]
        <li>
      [?php echo $page ?]
        </li>
    [?php else: ?]
        <li>
      <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a>
        </li>
    [?php endif; ?]
  [?php endforeach; ?]

        <li>
  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Next page', array(), 'sf_admin'))) ?]
  </a>
        </li>

        <li>
  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?]
  </a>
        </li>
    </ul>
<?php endif; ?>
</div>
