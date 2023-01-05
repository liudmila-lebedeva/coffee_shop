<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coffee[]|\Cake\Collection\CollectionInterface $coffees
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard_banner'); ?>
<?php

use Cake\Routing\Router;
?>


<div>

    <div class="list-group">
        <?php
        foreach ($coffees as $coffee) :
            $imageLink = 'coffee/img' . $coffee['id'] . '.jpg';
            ?>

            <a href="<?= Router::url(['controller' => 'coffees', 'action' => 'view', $coffee->id]) ?>" class="list-group-item">
                <div class="row">
                    <div class="col-md-4 img-product">
    <?= $this->Html->image($imageLink, array('width' => '180', 'height' => '120')) ?>

                    </div>
                    <div class="col-md-8">
                        <h4 class="list-group-item-heading"><?= $coffee->name ?></h4>
                        <p class="list-group-item-text">Price $<?= $coffee->price ?></p>
                    </div>
                </div>
            </a>
<?php endforeach; ?> 
    </div>



</div>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
        <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
<?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>
