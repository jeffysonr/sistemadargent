    
    <div id="cadastro">
        	
        <h1>Cadastro</h1>
        
        <div id="form"> 
            
            <?php echo $form->create('Usuario', array('type' => 'file', 'url' => '/cadastro'));?>
            
            <div>
                <?php echo $form->input('nome',
                                array('div' => false,
                                      'error' => array('wrap' => 'span', 'class' => 'error'),
                                      'class' => 'l-input')); ?>
            </div>
            
            <div>
                <?php echo $form->input('email',
                                array('div' => false,
                                      'error' => array('wrap' => 'span', 'class' => 'error'),
                                      'class' => 'l-input')); ?>
            </div>
            
            <div>
                <?php echo $form->input('login',
                                array('div' => false,
                                      'error' => array('wrap' => 'span', 'class' => 'error'),
                                      'class' => 'l-input',
                                      'label' => 'Login')); ?>
            </div>
            
            <div>
                <?php echo $form->input('passwd',
                                            array('label' => 'Senha',
                                                  'div' => false,
                                                  'value' => '',
                                                  'error' => array('wrap' => 'span', 'class' => 'error'),
                                                  'class' => 'l-input')); ?>
            </div>
            
            <div>
                <?php echo $form->input('passwd_confirm',
                                            array('type' => 'password',
                                                  'div' => false,
                                                  'value' => '',
                                                  'label' => 'Confirmar Senha',
                                                  'error' => array('wrap' => 'span', 'class' => 'error'),
                                                  'class' => 'l-input')); ?>
            </div>
                            
            <?php echo $form->end(array('label' => 'Criar Minha Conta', 'class' => 'botao-cadastro', 'div' => false));?>
                
            </form>
             
    </div>

    