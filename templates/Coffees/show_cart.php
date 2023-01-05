<?php $this->extend('/layout/TwitterBootstrap/dashboard_banner'); ?>
<?php

if ($empty):
    echo $this->Html->div("alert alert-danger", "Your cart is empty", ["role" => "alert"]);


else:
    echo '<div class = "container">';
    echo '<h2>Your cart</h2>';
    echo $this->Html->tag("table", null, ['class' => 'table table-hover table-striped']);

    echo $this->Html->tag("thead");
    echo $this->Html->tableHeaders(['Name', 'Amount', 'Price']);
    echo $this->Html->tag("/thead");

    echo $this->Html->tag("tfoot");
    echo $this->Html->tableCells(['Total', '', '' . $total]);
    echo $this->Html->tag("/tfoot");

    foreach ($entites as $entity) {
        echo $this->Html->tableCells([$entity->name, '' . $cartItems[$entity->id], '' . $entity->price]);
    }


    echo $this->Html->tag("/table");


    echo $this->Html->link(
            "Proceed to checkout", ['action' => 'checkout'], ['class' => 'btn btn-success']
    );

    echo '</div>';

endif;
