<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coffee $coffee
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard_banner'); ?>

<?php $this->start('tb_actions'); ?>

<li><?= $this->Html->link(__('Edit Coffee'), ['action' => 'edit', $coffee->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Coffee'), ['action' => 'delete', $coffee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coffee->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Coffees'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Coffee'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="coffees view large-9 medium-8 columns content">
    <h3><?= h($coffee->name) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <?php if ($imageLink ): ?>
            <tr>
                <!--IMAGE-->
<!--                if there is an image, then create the line:-->
                <th scope="row"><?= __('Image') ?></th>
                <td><?= $this->Html->image($imageLink, array('width' => '150')) ?></td>
            </tr>
            <?php endif ?>

            <tr>
                <th scope="row"><?= __('Name') ?></th>
                <td><?= h($coffee->name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Country') ?></th>
                <td><?= h($coffee->country) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($coffee->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Price') ?></th>
                <td><?= $this->Number->format($coffee->price) ?></td>
            </tr>
        </table>
        <?=
        $this->Html->link(
                'buy this coffee', array('action' => 'buy', $coffee->id), ['class' => 'btn btn-primary']
        );
        ?>
    </div>
</div>
