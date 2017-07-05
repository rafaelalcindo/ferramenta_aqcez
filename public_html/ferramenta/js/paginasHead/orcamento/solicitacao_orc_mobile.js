
      $(document).ready(function(){
            //console.log('Entrou');

            $('#u253932-4').hide();
            
           
            $('#btn_finish2').click(function(){

                $('#u253932-4').children().remove();
                var servicos_array = new Array();

                var escritorio    = $('#sele_segmento2').val();
                var estrutura     = $('#sele_estrutura2').val();
                var especi_estru  = $('#text_area_obs2').val();
                var sele_area     = $('#sele_area2').val();
                var servico_preci = $("input[name='Pedido[]']").is(':checked');
                //var urgencia      = $('#sele_urgencia2').val();
                //var area_nesce    = $('#area_nece2').val();
               // var file_upload   = verificaUpload($('#upload_image2').val());
                var nome_orc      = $('#nome_orc2').val();
                var emp_orc       = $('#emp_orc2').val();
                var tel           = $('#tel2').val();
                var cel           = $('#cel2').val();
                var email         = $('#email_orc2').val();
                var estado        = $('#estado2').val();
                var cidade        = $('#cidade2').val();

                

                if(escritorio.trim() != ''){
                    if(sele_area.trim() != ''){ 
                        if(servico_preci != false){
                            
                                if(nome_orc.trim() != ''){
                                    if(emp_orc.trim() != ''){
                                        if(tel.trim() != '' || cel.trim() != ''){
                                            if(email.trim() != ''){
                                                if(estado.trim() != ''){
                                                    if(cidade.trim != ''){


                                                        var data = new FormData();
                                                        data.append('segmento', escritorio);
                                                        data.append('estrutura', estrutura);
                                                        data.append('especi_estru', especi_estru);
                                                        data.append('area', sele_area);

                                                        $("input[name='Pedido[]']:checked").each(function(){
                                                            
                                                            servicos_array.push($(this).val());
                                                        });

                                                        data.append('servico', servicos_array);


                                                       // data.append('urgencia', urgencia);
                                                       // data.append('quando', area_nesce);
                                                      //  data.append('file',file_upload);
                                                        data.append('nome', nome_orc);
                                                        data.append('emp',  emp_orc);
                                                        data.append('tel', tel);
                                                        data.append('cel',cel);
                                                        data.append('email', email);
                                                        data.append('estado', estado);
                                                        data.append('cidade', cidade);

                                                        //alert(servicos_array);

                                                        CadastrarOrcamento(data);


                                                    }else{ var error = '<p>Por favor selecione a sua cidade</p>';  $('#u253932-4').show(); $('#u253932-4').append(error);  }
                                                }else{ var error = '<p>Por favor selecione seu estado.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                                            }else{ var error = '<p>Por favor digite seu email.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                                        }else{ var error = '<p>Por favor digite o numero do seu telefone ou celular.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                                    }else{ var error = '<p>Por favor Digite o nome da sua Empresa.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                                }else{ var error = '<p>Por favor Digite o seu nome.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                           
                        }else{ var error = '<p>Por favor marque o tipo de serviço que você precisa no Passo 2</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                    }else{ var error = '<p>Por favor selecione a área.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                }else{ var error = '<p>Por favor selecione tipo de negócio.</p>'; $('#u253932-4').show(); $('#u253932-4').append(error); }
                

            });

            $("#sele_segmento2").change(function(){
                var segmento = $(this).val();

                $("#sele_estrutura2").children().remove();

                    $.getJSON("json_file/construcao.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $('#u251846').show();
                                    $("#sele_estrutura2").show();
                                    $('#u251819-4').children().remove();
                                    $('#u251819-4').append('<p>QUAL É A ESTRUTURA?</p>');
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura2").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura2").hide();
                                $('#u251846').hide();
                                $('#u251819-4').children().remove();
                                $('#u251819-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });

                });// Fim sele Segmento



                function CadastrarOrcamento(dadosPassar){
                    $.ajax({
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: dadosPassar,
                        url: "soli_orcamento/controller.php?request=cadOrcamento",
                        dataType: 'json',
                        beforeSend: function(){
                            $('#btn_finish2').attr('disabled','disabled');
                            $('#btn_finish2').css("cursor", "not-allowed");
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

                $('#upload_image2').on('change', function(e){
                    var ext = $('#upload_image2').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['jpeg','jpg','png','pdf']) > -1){
                        return 0;
                    }else{
                        alert('Por favor coloque um arquivo na extenção png, pdf, jpg ou jpeg');
                        $('#upload_image2').val('');
                    }
                });

                $('#estado2').change(function(){
                     var id = $(this).val();

                     $.ajax({
                        type: "POST",
                        url: "lista_cidade_estado/lista_cidade.php?id="+id,
                        dataType: "json",
                        success: function(data){
                            $('#cidade2').children('.cidade').remove();
                            $('#cidade2').removeAttr('disabled').focus();
                            $.each(data, function(key, val){
                                var texto_cid_in = "<option value="+val.id+" class='cidade'>"+val.nome+"</option>";
                                $('#cidade2').append(texto_cid_in);
                            });
                        }
                     });

                });



                function verificaUpload(fileUploaded){
                    var ext02 = fileUploaded.split('.').pop().toLowerCase();
                    if($.inArray(ext02, ['jpg','jpeg','gif','pdf']) > -1 ){
                        return $('#upload_image2').prop("files")[0];
                    }else{
                        return 0;
                    }
                }

               

                getEstado();

                function getEstado(){
                     $.getJSON("lista_cidade_estado/lista_estado.php", function(data){
                        $.each(data, function(key, val){
                            var texto_inserir = "<option value="+val.id+">"+val.nome+"</option>";
                            $('#estado2').append(texto_inserir);
                        });
                    });
                  }


          });