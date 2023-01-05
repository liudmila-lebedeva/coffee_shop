<?php

declare(strict_types=1);

namespace App\Controller;

use App\MyHelpers\Cart;

/**
 * Coffees Controller
 *
 * @property \App\Model\Table\CoffeesTable $Coffees
 * @method \App\Model\Entity\Coffee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoffeesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $coffees = $this->paginate($this->Coffees);

        $this->set(compact('coffees'));
    }

    /**
     * View method
     *
     * @param string|null $id Coffee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $coffee = $this->Coffees->get($id, [
            'contain' => [],
        ]);
        
        //Check the image
        $imageName = WWW_ROOT . "img/coffee/img$id.jpg";
        if (file_exists($imageName)) {
            $this->set('imageLink', "coffee/img$id.jpg");
        } else {
            $this->set('imageLink', false);
        }

        $this->set(compact('coffee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $coffee = $this->Coffees->newEmptyEntity();
        if ($this->request->is('post')) {
            $coffee = $this->Coffees->patchEntity($coffee, $this->request->getData());
            $savedCoffee = $this->Coffees->save($coffee);
            if ($savedCoffee) {
                $id = $savedCoffee->get('id');
                $attachment = $this->getRequest()->getData("image");
                
                $this->saveImage($attachment, $id);

                $this->Flash->success(__('The coffee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coffee could not be saved. Please, try again.'));
        }
        $this->set(compact('coffee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coffee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $coffee = $this->Coffees->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coffee = $this->Coffees->patchEntity($coffee, $this->request->getData());
            $savedCoffee = $this->Coffees->save($coffee);
            if ($savedCoffee) {
                $id = $savedCoffee->get('id');
                $attachment = $this->getRequest()->getData("image");
                
                $this->saveImage($attachment, $id);
                
                $this->Flash->success(__('The coffee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coffee could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('coffee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coffee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $coffee = $this->Coffees->get($id);
        if ($this->Coffees->delete($coffee)) {
            $filename = WWW_ROOT . "img/coffee/img$id.jpg";
            unlink($filename);
            $this->Flash->success(__('The coffee has been deleted.'));
        } else {
            $this->Flash->error(__('The coffee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index', 'view', 'buy', 'showCart']);
    }

    public function buy($id) {

        $session = $this->getRequest()->getSession();

        $cart = $session->read("cart");

        //if cart does not exists in the session 
        if ($cart == NULL) {
            $cart = new Cart();
        }

        //Add the item to the cart
        $cart->addItem($id);

        //Add the new cart to the session
        $session->write("cart", $cart);

        //Set the Flash information and return to the main page
        $this->Flash->success(__('The coffee was added to your cart.'));
        return $this->redirect(['action' => 'index']);
    }

    public function showCart() {
        //Lets prepare the information
        //The list of the coffees and the total

        $total = 0;
        $entites = array();
        $session = $this->getRequest()->getSession();

        $cart = $session->read("cart");

        if ($cart == NULL) {
            $this->set("empty", TRUE);
        } else {
            $this->set("empty", FALSE);
            $cartItems = $cart->getItems();
            foreach ($cartItems as $key => $value) {
                $entites[$key] = $this->Coffees->get($key);
                $total += $cartItems[$key] * $entites[$key]->price;
            }
            $this->set("cartItems", $cartItems);
            $this->set("entites", $entites);
            $this->set("total", $total);
        }
    }
    
     private function saveImage($attachment, $id) {
         if ($attachment and ($attachment->getError() === 0)) {
                    $tmp_name = $attachment->getStream()->getMetadata('uri');
                    $file_type = exif_imagetype($tmp_name);
                    if (in_array($file_type, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP, IMAGETYPE_GIF])) {
                        $filename = WWW_ROOT . "img/coffee/img$id.jpg";
                        $attachment->moveTo($filename);
                    }
                }
    }

}
