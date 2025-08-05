<!-- <ul class="pagination m-0 ms-auto">
    <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M15 6l-6 6l6 6"></path>
            </svg>
            prev
        </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item">
        <a class="page-link" href="#">
            next
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 6l6 6l-6 6"></path>
            </svg>
        </a>
    </li>
</ul> -->

<?php $pager->setSurroundCount(2) ?>

<ul class="pagination m-0 ms-auto">
    <?php if ($pager->hasPrevious()) : ?>
    <li class="page-item">
        <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
            <span aria-hidden="true"><?= lang('Pager.first') ?></span>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
            <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
        </a>
    </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
    <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>">
            <?= $link['title'] ?>
        </a>
    </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
    <li class="page-item">
        <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
            <span aria-hidden="true"><?= lang('Pager.next') ?></span>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
            <span aria-hidden="true"><?= lang('Pager.last') ?></span>
        </a>
    </li>
    <?php endif ?>
</ul>