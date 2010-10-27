<?php
    class SugestoesController extends AppController {
        
        var $uses = array('Sugestao');
        var $helpers = array('Html', 'Form');
        var $components = array('Email');
        
        
        function index() {
            $this->Sugestao->recursive = 0;
            $this->set('sugestos', $this->paginate());
        }
    
        function view($id = null) {
            if (!$id) {
                $this->Session->setFlash(__('Invalid Sugestao', true));
                $this->redirect(array('action' => 'index'));
            }
            $this->set('sugesto', $this->Sugestao->read(null, $id));
        }
        
        
        function _sendEmail($id){       # PRIVATE METHOD?!
            
            $sugestao = $this->Sugestao->read(null, $id);
            
            #### ENVIO DO EMAIL
            $this->Email->to = 'huoxito@gmail.com';
            $this->Email->bcc = array('huoxito@hotmail.com');  
            $this->Email->subject = 'Welcome to our really cool thing';
            $this->Email->replyTo = $sugestao['Usuario']['email'];
            $this->Email->from = 'Cool Web App <admin@testsoh.com.br>';
            $this->Email->template = 'sugestao'; // note no '.ctp'
            //Send as 'html', 'text' or 'both' (default is 'text')
            $this->Email->sendAs = 'both'; // because we like to send pretty mail
            //$this->Email->delivery = 'debug';
            //Set view variables as normal
            $this->set('usuario', $sugestao['Usuario']['nome']);
            $this->set('titulo', $sugestao['Sugestao']['titulo']);
            $this->set('texto', $sugestao['Sugestao']['texto']);
            //Do not pass any args to send()
            $this->Email->send();
            
        
        }
        
        
        function add() {
            
            if (!empty($this->data)) {
                
                $this->Sugestao->create();
                $this->Sugestao->set('usuario_id', $this->Auth->user('id'));
                if ($this->Sugestao->save($this->data)) {
                    
                    $this->Session->setFlash(__('Sugestão salva com sucesso', true));
                    $this->_sendEmail( $this->Sugestao->id );
                    $this->redirect(array('controller' => 'sugestoes', 'action' => 'index'));
                    
                } else {
                    
                    $this->Session->setFlash(__('The Sugestao could not be saved. Please, try again.', true));
                }
            }
            
            $usuarios = $this->Sugestao->Usuario->find('list');
            $this->set(compact('fontes', 'usuarios'));
        }
    
        function edit($id = null) {
            
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Invalid Sugestao', true));
                $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                if ($this->Sugestao->save($this->data)) {
                    $this->Session->setFlash(__('The Sugestao has been saved', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Sugestao could not be saved. Please, try again.', true));
                }
            }
            if (empty($this->data)) {
                $this->data = $this->Sugestao->read(null, $id);
            }
            $fontes = $this->Sugestao->Fonte->find('list');
            $usuarios = $this->Sugestao->Usuario->find('list');
            $this->set(compact('fontes', 'usuarios'));
        
        }
    
        function delete($id = null) {
        
                if (!$id) {
                    $this->Session->setFlash(__('Invalid id for Sugestao', true));
                    $this->redirect(array('action'=>'index'));
                }
                if ($this->Sugestao->del($id)) {
                    $this->Session->setFlash(__('Sugestao deleted', true));
                    $this->redirect(array('action'=>'index'));
                }
                $this->Session->setFlash(__('Sugestao was not deleted', true));
                $this->redirect(array('action' => 'index'));
        
        }
    }
?>