$(document).ready(function(){

        $('#u256605-4').hide();

            

            $('#btn_finish').click(function(event){

                var servicos_array = new Array();

                var escritorio    = $('#sele_segmento').val();
                var estrutura     = $('#sele_estrutura').val();
                var especi_estru  = $('#text_area_obs').val();
                var sele_area     = $('#sele_area').val();
                var servicos      = $('#sele_servico').val();
               // var servico_preci = $("input[name='Pedido[]']").is(':checked');
                //var urgencia      = $('#sele_urgencia').val();
                //var area_nesce    = $('#area_nece').val();
               // var file_upload   = verificaUpload($('#upload_image').val());
                var nome_orc      = $('#nome_orc').val();
               // var emp_orc       = $('#emp_orc').val();
                var tel           = $('#tel').val();
                var cel           = $('#cel').val();
                var email         = $('#email_orc').val();
                var estado        = $('#estado').val();
                var cidade        = $('#cidade').val();

                //alert(servicos);

                
                

                if(escritorio.trim() != ''){
                    if(sele_area.trim() != ''){ 
                        
                            
                                if(nome_orc.trim() != ''){
                                    
                                        if( cel.trim() != ''){
                                            if(email.trim() != ''){
                                                if(estado.trim() != ''){
                                                    if(cidade.trim != ''){


                                                        var data = new FormData();
                                                        data.append('segmento', escritorio);
                                                        data.append('estrutura', estrutura);
                                                        data.append('especi_estru', especi_estru);
                                                        data.append('area', sele_area);

                                                      /*  $("input[name='Pedido[]']:checked").each(function(){
                                                            
                                                            servicos_array.push($(this).val());
                                                        }); */

                                                        data.append('servico', servicos);

                                                        //data.append('urgencia', urgencia);
                                                      //  data.append('quando', area_nesce);
                                                      //  data.append('file',file_upload);
                                                        data.append('nome', nome_orc);
                                                       // data.append('emp',  emp_orc);
                                                      //  data.append('tel', tel);
                                                        data.append('cel',cel);
                                                        data.append('email', email);
                                                        data.append('estado', estado);
                                                        data.append('cidade', cidade);

                                                        //alert(servicos_array);

                                                        CadastrarOrcamento(data);


                                                    }else{ alert('Por favor selecione a sua cidade'); }
                                                }else{ alert('Por favor selecione seu estado.'); }
                                            }else{ alert('Por favor digite seu email.'); }
                                        }else{ alert('Por favor digite o numero do seu celular.'); }
                                    
                                }else{ alert('Por favor Digite o seu nome.'); }
                            
                        
                    }else{ alert('Por favor selecione a área.'); }
                }else{ alert('Por favor selecione tipo de negócio.'); }
                

            });



            $("#tipo").change(function(){

                //alert('entrou tipo');
                var tipo = $(this).val();
               // alert(tipo);
                var opcoes;

                $('#sele_segmento').children().remove();

                if(tipo == "construcao"){
                    opcoes = preencheSegmento(tipo);
                    $('#sele_segmento').append(opcoes);
                }else if(tipo == "reforma"){                    
                    opcoes = preencheSegmento(tipo);
                    $('#sele_segmento').append(opcoes);
                }else if(tipo == "projetos"){
                    opcoes = preencheSegmento(tipo);
                    $('#sele_segmento').append(opcoes);
                }else if(tipo == "outros"){
                    opcoes = preencheSegmento(tipo);
                    $('#sele_segmento').append(opcoes);
                }

            });


            $("#sele_segmento").change(function(){
                var tipo     = $('#tipo').val();
                var segmento = $(this).val();

                $("#sele_estrutura").children().remove();

                preencheEstrutura(tipo, segmento);
        

                });// Fim sele Segmento

            function preencheSegmento(segmento){

                if(segmento == "construcao"){
                    var option = "<option value=''>Selecione a Categoria</option>";
                    option += "<option value='escritorios'>Escritórios</option>";
                    option += "<option value='locais_comerciais'>Locais Comerciais</option>";
                    option += "<option value='hoteis'>Hotéis</option>";
                    option += "<option value='clinicas'>Clínicas</option>";
                    option += "<option value='restaurantes'>Restaurantes</option>";
                    option += "<option value='escola'>Escola</option>";
                    option += "<option value='industria'>Indústria</option>";
                    option += "<option value='outros'>Outros</option>";

                    return option;
                }else if(segmento == "reforma"){
                    var option = "<option value=''>Selecione a Categoria</option>";
                    option += "<option value='escritorios'>Escritórios</option>";
                    option += "<option value='locais_comerciais'>Locais Comerciais</option>";
                    option += "<option value='hoteis'>Hotéis</option>";
                    option += "<option value='clinicas'>Clínicas</option>";
                    option += "<option value='restaurantes'>Restaurantes</option>";
                    option += "<option value='escola'>Escola</option>";
                    option += "<option value='industria'>Indústria</option>";
                    option += "<option value='outros'>Outros</option>";

                    return option;
                }else if(segmento == "projetos"){
                    var option = "<option value=''>Selecione a Categoria</option>";
                    option += "<option value='arquitetura'>Arquitetura/Design de Interior</option>";
                    option += "<option value='complementares'>Complementares</option>";

                    return option;
                }else if(segmento == "outros"){
                    var option = "<option value=''>Selecione a Categoria</option>";
                    option += "<option value='desmobilizacao'>Desmobilização de Empresas</option>";
                    option += "<option value='solucao_completa'>Solução Completa - TurnKey</option>";

                    return option;
                }

            }


            function preencheEstrutura(tipo, segmento){
                if(tipo == "construcao"){
                    $.getJSON("json_file/construcao.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $("#sele_estrutura").show();
                                    $('#u251945').show();
                                    $('#u251947-4').children().remove();
                                    $('#u251947-4').append('<p>QUAL É A ESTRUTURA?</p>');
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura").hide();
                                $('#u251945').hide();
                                $('#u251947-4').children().remove();
                                $('#u251947-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });
                }else if(tipo == "reforma"){
                    $.getJSON("json_file/reformas.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $("#sele_estrutura").show();
                                    $('#u251945').show();
                                    $('#u251947-4').children().remove();
                                    $('#u251947-4').append('<p>QUAL É A ESTRUTURA?</p>');
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura").hide();
                                $('#u251945').hide();
                                $('#u251947-4').children().remove();
                                $('#u251947-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });
                }else if(tipo == "projetos"){
                    $.getJSON("json_file/projetos.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $("#sele_estrutura").show();
                                    $('#u251945').show();
                                    $('#u251947-4').children().remove();
                                    $('#u251947-4').append('<p>QUAL É A ESTRUTURA?</p>');
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura").hide();
                                $('#u251945').hide();
                                $('#u251947-4').children().remove();
                                $('#u251947-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });

                }else if(tipo == "outros"){
                    $.getJSON("json_file/projetos.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $("#sele_estrutura").show();
                                    $('#u251945').show();
                                    $('#u251947-4').children().remove();
                                    $('#u251947-4').append('<p>QUAL É A ESTRUTURA?</p>');
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura").hide();
                                $('#u251945').hide();
                                $('#u251947-4').children().remove();
                                $('#u251947-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });
                }
            }



                function CadastrarOrcamento(dadosPassar){
                    $.ajax({
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: dadosPassar,
                        url: "soli_orcamento/controller.php?request=cadOrcamento",
                        dataType: 'json',
                        beforeSend: function(){
                            $('#btn_finish').attr('disabled','disabled');
                            $('#btn_finish').css("cursor", "not-allowed");
                        },
                        success: function(jsonData){
                            $.each(jsonData, function(key, val){
                                if(val == true){
                                    window.location.href = "confirmado.html";
                                }else{
                                    alert('Não foi possivel salvar o pedido!');
                                }
                            });
                        }
                    });
                }

                $('#upload_image').on('change', function(e){
                    var ext = $('#upload_image').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['jpeg','jpg','png','pdf']) > -1){
                        return 0;
                    }else{
                        alert('Por favor coloque um arquivo na extenção png, pdf, jpg ou jpeg');
                        $('#upload_image').val('');
                    }
                });

                $('#estado').change(function(){
                     var id = $(this).val();

                     $.ajax({
                        type: "POST",
                        url: "lista_cidade_estado/lista_cidade.php?id="+id,
                        dataType: "json",
                        success: function(data){
                            $('#cidade').children('.cidade').remove();
                            $('#cidade').removeAttr('disabled').focus();
                            $.each(data, function(key, val){
                                var texto_cid_in = "<option value="+val.id+" class='cidade'>"+val.nome+"</option>";
                                $('#cidade').append(texto_cid_in);
                            });
                        }
                     });

                });



                function verificaUpload(fileUploaded){
                    var ext02 = fileUploaded.split('.').pop().toLowerCase();
                    if($.inArray(ext02, ['jpg','jpeg','gif','pdf']) > -1 ){
                        return $('#upload_image').prop("files")[0];
                    }else{
                        return 0;
                    }
                }

               

                getEstado();

                function getEstado(){
                  
                  $.getJSON("lista_cidade_estado/lista_estado.php", function(data){
                      $.each(data, function(key, val){
                          var texto_inserir = "<option value="+val.id+">"+val.nome+"</option>";
                          $('#estado').append(texto_inserir);
                      });
                  });
                }


          });
        