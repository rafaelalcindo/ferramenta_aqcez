 $(document).ready(function(){

               
               $('#u64008-4').hide();
               
            $('#salvar_forn').click(function(){

                $('#u64008-4').children().remove();

                var servicos_array = new Array();

                var nome_forn    = $('#nome_forn').val();
                var emp_forn     = $('#emp_forn').val();
                var tel_forn  = $('#tel_forn').val();
                var cel_forn     = $('#cel_forn').val();
                //var servico_preci = $("input[name='Pedido[]']").is(':checked');
                var email_forn      = $('#email_forn').val();
                var endereco_forn   = $('#endereco_forn').val();
                
                var num_forn        = $('#num_forn').val();
                var cep_forn      = $('#cep_forn').val();
                var estado_forn     = $('#estado_forn').val();
                var cidade_forn     = $('#cidade_forn').val();
                var servico_forn    = $("input[name='servico[]']").is(':checked');
                var especi_forn     = $('#especi_forn').val();
                var sobre_forn      = $('#fale_forn').val();


                if(nome_forn.trim() != ''){
                    if(emp_forn.trim() != ''){
                        if(tel_forn.trim() != ''){
                            if(cel_forn.trim() != ''){
                                if(email_forn.trim() != '' ){
                                    if(endereco_forn.trim() != ''){
                                        if(num_forn.trim() != ''){
                                            if(cep_forn.trim() != ''){
                                                if(estado_forn.trim() != ''){
                                                    if(cidade_forn.trim() != ''){
                                                        if(servico_forn != false){
                                                            if(sobre_forn.trim() != ''){

                                                                var dataEmail = new FormData();
                                                                dataEmail.append('nome_forn', nome_forn);
                                                                dataEmail.append('emp_forn', emp_forn);
                                                                dataEmail.append('tel_forn', tel_forn);
                                                                dataEmail.append('cel_forn', cel_forn);
                                                                dataEmail.append('email_forn', email_forn);
                                                                dataEmail.append('endereco_forn', endereco_forn);
                                                                dataEmail.append('numero_forn', num_forn);
                                                                dataEmail.append('cep_forn', cep_forn);
                                                                dataEmail.append('estado_forn', estado_forn);
                                                                dataEmail.append('cidade_forn', cidade_forn);
                                                                dataEmail.append('servico_forn', servico_forn);
                                                                dataEmail.append('especi_forn', especi_forn);
                                                                dataEmail.append('sobre_forn', sobre_forn);

                                                                cadFornecedor(dataEmail);


                                                            }else{ var alerta = 'Por favor digite o campo false sobre você!'; msgAlerta(alerta); }
                                                        }else{ var  alerta = 'Por favor Selecione um serviço!'; msgAlerta(alerta); }
                                                    }else{ var alerta = 'Por favor digite a sua cidade!'; msgAlerta(alerta); }
                                                }else{ var alerta ='Por favor digite seu estado!'; msgAlerta(alerta); }
                                            }else{ var  alerta = 'Por favor digite o seu CEP!'; msgAlerta(alerta); }
                                        }else{ var alerta = 'Por favor digite o número do seu endereço.'; msgAlerta(alerta); }
                                    }else{ var alerta = 'Por favor Digite o seu endereco'; msgAlerta(alerta); }
                                }else{ var alerta = 'Por favor digite o seu email!'; msgAlerta(alerta); }
                            }else{ var alerta = 'Por favor digite o número do seu celular'; msgAlerta(alerta); }
                        }else{ var alerta = 'Por favor digite seu telefone!'; msgAlerta(alerta); }
                    }else{ var alerta = 'Por favor digite o nome da sua empresa!'; msgAlerta(alerta); }
                }else{ var alerta = 'Porfavor Digite seu nome!'; msgAlerta(alerta); }
                                          

            });

            $("#sele_segmento").change(function(){
                var segmento = $(this).val();

                $("#sele_estrutura").children().remove();

                    $.getJSON("json_file/construcao.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $('#u251945').removeAttr('style');
                                    $("#sele_estrutura").removeAttr('disabled');            
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura").attr('disabled', true);
                                $('#u251945').attr('style','background: #DCDCDC');
                            }

                        });
                    });

                });// Fim sele Segmento


                function cadFornecedor(dadosForn){
                    $.ajax({
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: dadosForn,
                        url: "fornecedores/controller.php?request=cadFornecedor",
                        dataType: 'json',
                        beforeSend: function(){
                            $('#salvar_forn').css('cursor','wait');
                            $('#salvar_forn').attr('disabled','true');
                        },
                        success: function(jsonData){
                            $.each(jsonData, function(key, val){
                                if(val == true){
                                    window.location.href = "confirmado_f.html";
                                }else{
                                    alert('Não foi possivel salvar o pedido!');
                                }
                            });
                        }
                    });
                }

                function msgAlerta(msg){
                    $('#u64008-4').show();
                    $('#u64008-4').append("<p>"+msg+"</p>");
                }


                        

                $('#estado_forn').change(function(){
                     var id = $(this).val();

                     $.ajax({
                        type: "POST",
                        url: "lista_cidade_estado/lista_cidade.php?id="+id,
                        dataType: "json",
                        success: function(data){
                            $('#cidade_forn').children('.cidade').remove();
                            $('#cidade_forn').removeAttr('disabled').focus();
                            $.each(data, function(key, val){
                                var texto_cid_in = "<option value="+val.id+" class='cidade'>"+val.nome+"</option>";
                                $('#cidade_forn').append(texto_cid_in);
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
                          $('#estado_forn').append(texto_inserir);
                      });
                  });
                }


          });
        