<?php

/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->Html->css('my.css', ['block' => true]);

$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <header>
        <div class="baner"></div>
        <div class="menu">
                <ul class="nav nav-pills center">
                    <li role="presentation"><?= $this->Html->link("Home", ['action' => 'index']) ?></li>
                    <li role="presentation"><?= $this->Html->link("Your Basket", ['action' => 'showCart']) ?></li>
                    <li role="presentation"><?= $this->Html->link("Admin", ['action' => 'add']) ?></li>
                </ul>
            </div> 
    </header>
    

    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
                     pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 page-header">Our Coffee</h1>
                </div>
                <?php
                /**
                 * Default `flash` block.
                 */
                if (!$this->fetch('tb_flash')) {
                    $this->start('tb_flash');
                    if (isset($this->Flash)) {
                        echo $this->Flash->render();
                    }
                    $this->end();
                }
                $this->end();

                $this->start('tb_body_end');
                echo '</body>';
                $this->end();

                echo $this->fetch('content');

                $this->append('tb_footer', '</main></div></div>');
                