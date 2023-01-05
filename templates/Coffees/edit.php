<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coffee $coffee
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coffee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coffee->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Coffees'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="coffees form content">
    <?= $this->Form->create($coffee, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Coffee') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('country');
            echo $this->Form->control('price');
//            <!--IMAGE-->
        echo $this->Form->control('image', ['type' => 'file', 'accept' => 'image/*']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
