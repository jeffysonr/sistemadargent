<?php

    # variaveis de sessão do usuário
    $usuarioLogado = $session->read('Auth.Usuario.nome');
    $userFoto = $session->read('Auth.Usuario.foto');
?>  
    <a href="<?php echo $html->url('/'); ?>" title="home">
        <img src="<?php echo $html->url('/'); ?>img/logo.png" width="191" height="60" alt="Dargent Sistema Financeiro" style="margin-top:15px;" />
    </a>
    <div id="topo-right">
    
        <div id="UserInfoBox">
            
            <?php if( !empty($userFoto) ){   ?>
            <img src="<?php echo $html->url('/'); ?>uploads/usuario/foto/thumb/topo/<?php echo $session->read('Auth.Usuario.foto'); ?>" height="70" />
            <?php   }   ?>
            
            <div style="float: right; padding: 0 0 0 10px;">
                
                <h1 id="userNameTopo"><?php echo $usuarioLogado; ?></h1>
                <span class="minhaconta">
                    <?php echo $this->Html->link('MINHA CONTA',
                                                array('controller' => '/',
                                                      'action' => 'perfil'));  ?>
                </span>
                
                <span class="sair">
                        <?php echo $html->link('SAIR',
                                               array('controller' => 'usuarios',
                                                     'action' => 'logout'),
                                               array('alt'=> __('sair', true),
                                                     'title'=> __('sair', true)));?>
                    
                </span> 
            
            </div>
        </div>
        
        <div class="box-left">
            <a href="<?php echo $this->Html->url(array('controller' => 'sugestoes', 'action' => 'add')); ?>" title="home">
                <img src="<?php echo $html->url('/'); ?>img/sugestoes.jpg" width="42" height="34" alt="sugestões" />
            </a>
            <h1 id="sugestoesTopo">
                <?php   echo $this->Html->link('Sugestões',
                                    array('controller' => 'sugestoes',
                                          'action' => 'add'),
                                    array('alt'=> __('Sugestões', true),
                                          'title'=> __('Sugestões', true)));
                ?>
            </h1>
            <p>AJUDE-NOS A <br />DESENVOLVER O DARGENT</p>
        </div>
        
    </div>
    <!--
    
    <div id="userinfo">
        
        <?php //echo $html->link('Home', '/'); ?>
        <?php echo $this->Html->link(
                $this->Html->image('home.png', array('alt'=> __('página inicial', true), 'title'=> __('página inicial', true), 'border' => '0')),
					'/',
                    array('escape' => false)
				);
        ?>
        <p style="margin: 10px 0 0 10px; float: left;"><?php echo $usuarioLogado; ?></p>
    
        <?php
        
            echo $html->link('Sugestões', array('controller' => 'sugestoes', 'action' => 'add'), array('style' => 'display: block; margin: 10px 0 0 15px;', 'alt'=> __('Sugestões', true), 'title'=> __('Sugestões', true)));
        
            
        
        ?>
        
        <?php if( !empty($userFoto) ){   ?>
        
        <div style="margin: 5px; float: right;" id="perfil-t">
            <img src="<?php echo $this->Html->url('/'); ?>uploads/usuario/foto/thumb/topo/<?php echo $session->read('Auth.Usuario.foto'); ?>" alt="<?php echo $session->read('Auth.Usuario.nome'); ?>" />
        </div>
        
        <?php   }   ?>
        
    </div>

    -->
    