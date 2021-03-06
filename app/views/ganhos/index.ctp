    
    <div class="ganhos index">
        
        <div id="contentHeader">
            
            <?php   echo $this->element('ganho_menu'); ?>
            
            <div class="buscar">
                
                <?php
                    echo $this->Form->create('Ganho',
                                        array('type' => 'get',
                                              'action' => 'search',
                                              'inputDefaults' => array('label' => false)));   
                ?>
                <span>Buscar</span>
                <p>FATURAMENTOS</p>
                
                <?php
                    echo $this->Form->input('fonte_id',
                                        array('empty' => 'Fontes',
                                              'div' => array('class' => 'formSearchDiv'),
                                              'class' => 'formSearchSelect',
                                              'selected' => isset($this->params['named']['fonte_id']) ? $this->params['named']['fonte_id'] : null));   
                ?>
                <div class="formSearchDiv">
                <?php
                    echo $this->Form->month(false,
                                        isset($this->params['named']['month']) ? $this->params['named']['month'] : null,
                                        array(__('monthNames',true),
                                              'empty' => 'Mês',
                                              'class' => 'formSearchSelect'));
                ?>
                </div>
                <div class="formSearchDiv">
                <?php
                    echo $this->Form->year(false,
                                        $minYear = '2010',
                                        $maxYear = date('Y'),
                                        isset($this->params['named']['year']) ? $this->params['named']['year'] : null,
                                        array('empty' => 'Ano',
                                              'class' => 'formSearchSelect'));
                ?>
                </div>
                <input type="image" value="" class="botao" />

            </div>
            
        </div>
        
        <div class="balancoBotoesWraper">
            
        <div class="balancoBotoes">
            <p>
            <?php
                if(!isset($listar)){
                    echo '« '.$this->Html->link('voltar a listagem inicial',
                                        array('action' => 'index'),
                                        array('class' => 'link_headers')).' |';
                }
            ?>
            
            <?php
                if(isset($faturamentos)){
            ?> 
                    <p>Faturamento: <b> R$ <?php echo $faturamentos; ?> reais </b></p>
                    <p>Despesas: <b>R$ <?php echo $despesas; ?> reais </b></p> 
                    <p>Saldo: <b>R$ <?php echo $saldo; ?> reais </b></p> 
            <?php
                }else{
                    echo $total;
            ?>
                
                    <?php   if( !empty($groupPorData) && isset($paginator) ){    ?>
                    <p>|</p>
                    <span class="pagina">Página</span>
                    <p><?php echo $paginator->counter(array('format' => __('%page%',true))); ?></p>
                    <span class="pagina">de</span>
                    <p><?php echo $paginator->counter(array('format' => __('%pages%',true))); ?></p>
                    <p>|</p>
                    <p><?php echo $paginator->counter(array('format' => __('%count%',true))); ?></p>
                    <span class="pagina">Registros</span>
                    <?php   }   ?>
                    
                <?php   }      ?>
            </p>

            <div class="headeraddlinks">
                <?php echo $this->Html->link('INSERIR NOVA FONTE',
                                        array('controller' => 'fontes',
                                              'action' => 'add'),
                                        array('class' => 'btnadd')); ?>
            </div>
            <div class="headeraddlinks">
                <?php echo $this->Html->link('INSERIR FATURAMENTO',
                                        array('controller' => 'ganhos',
                                              'action' => 'add'),
                                        array('class' => 'btnadd')); ?>
            </div>
            
        </div>
        
        </div>
        
        <div class="relatoriosWraper">
            
            <div id="relatorioRapido">
                
                <div class="titulos">
                    <h2>Relatórios <span>RÁPIDOS</span> </h2>
                </div>
                
                <ul id="mesesRelatorio">
                    <?php foreach($objMeses as $meses): ?>
                        <li>
                            <?php
                                if(isset($this->params['pass'][0]) && $this->params['pass'][0] == $meses['numMes'])
                                    echo $meses['mes'];
                                else
                                    echo $this->Html->link($meses['mes'],
                                                    array('action' => 'index',
                                                          $meses['numMes'],
                                                          $meses['ano']),
                                                    array('class' => 'relatoriosLinks'));
                            ?>
                        </li>
                    <?php endforeach; ?>    
                </ul>
            
            </div>
        
        </div>
        
        <cake:nocache>
        <?php   echo $this->Session->flash(); ?>
        </cake:nocache>
        
        <div class="registrosWraper">
            
            <?php   if(count($groupPorData) === 0){  ?>
                <p class="semResgistrosMsg">
                    Nenhum faturamento registrado
                </p>
            <?php   } ?>
            
            <ul id="list">
                
                <?php
                        foreach($groupPorData as $data){
                        $num = count($data['registro']);
                        $count = 1;
                ?>
                
                <li class="registrosPorData">
                    <div class="groupdata">
                    <?php  echo $data['dia']; ?>
                    </div>
                    
                    <?php   foreach($data['registro'] as $registro){  ?>
                    
                    <div class="registros registrosPainel <?php if($count < $num) echo 'borda-inferior'; ?>" id="ganho-<?php echo $registro['Ganho']['id']; ?>">
                    
                        <p class="agendamentoInfoLinha">
                            <span class="valor">
                                R$ <?= $registro['Ganho']['valor']; ?>
                            </span>
                            <span class="categoriaListagem spansBlocks">
                                <?= $registro['Fonte']['nome']; ?>
                            </span>
                            <span class="contaListagem">
                                <?= $registro['Conta']['nome']; ?>
                            </span>
                        </p>
                        
                        <?php   if(!empty($registro['Ganho']['observacoes'])){ ?>
                            <p class="observacoesListagem">
                            <?php echo $registro['Ganho']['observacoes']; ?>
                            </p>
                        <?php   }   ?>
                        
                        <div class="categ-actions acoesPainel">
                            <?php 
                            if ($registro['Ganho']['fonte_id']){
                                echo $this->Html->link('EDITAR',
                                                array('action' => 'edit', $registro['Ganho']['id'], time()),
                                                array('class' => 'colorbox-edit btneditar',
                                                      'title' => 'Editar Faturamento')); 
                            }
                            ?> 
                            <?= $this->Html->link('EXCLUIR',
                                                array('action' => 'delete', $registro['Ganho']['id'], time()),
                                                array('class' => 'colorbox-delete btnexcluir',
                                                      'title' => 'Excluir Faturamento')); ?>
                        </div>  
                        
                            
                    </div>
                    
                    <?php   $count++;}   ?>
                
                </li>
                
                <?php   }   ?>
                
            </ul>
            
            <?php   if( !empty($groupPorData) && isset($paginator) ){    ?>
                <div class="paging">
                    <?= $this->Paginator->first('<< primeira', array(), null, array('class'=>'disabled'));?>
                    <?= $this->Paginator->prev('< anterior', array(), null, array('class'=>'disabled'));?>
                    <?= $this->Paginator->numbers();?>
                    <?= $this->Paginator->next('próxima >', array(), null, array('class' => 'disabled'));?>
                    <?= $this->Paginator->last('última >>', array(), null, array('class'=>'disabled'));?>
                </div>
            <?php   }   ?>
        
        </div>
        
    </div>
        
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('.colorbox-delete').colorbox({width:"500", height: '220', opacity: 0.5, iframe: true});
            $('.colorbox-edit').colorbox({width:"800", height: "480", opacity: 0.5, iframe: true});
            
            $(".registros").mouseover(function() {
                $(this).css("background-color",'#F2FFE3');
            }).mouseout(function(){
                $(this).css("background-color",'#FFF');
            });
        });
        // ]]>
    </script>
