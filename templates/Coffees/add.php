<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coffee $coffee
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard_banner'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('List Coffees'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="coffees form content">
    <?= $this->Form->create($coffee, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Coffee') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('country');
        echo $this->Form->control('price');
//        <!--IMAGE-->
        echo $this->Form->control('image', ['type' => 'file', 'accept' => 'image/*']);
        ?>
    </fieldset>


    <!--BUTTON-->
    <?= $this->Form->button(__('Submit'), ['class' => "btn btn-primary"]) ?>
    <?= $this->Form->end() ?>
</div>
