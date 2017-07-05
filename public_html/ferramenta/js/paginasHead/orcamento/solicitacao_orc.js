$(document).ready(function(){

        $('#u256605-4').hide();

            /*

            $('#btn_next01').click(function(){                
                $("#u184767").hide();
                $("#u184888").show();
            });

            $("#btn_preview02").click(function(){
                $("#u184888").hide();
                $("#u184767").show();                
            });

            $("#btn_next02").click(function(){
               $("#u184888").hide();
               $('#u185026').show();
            });

            $("#btn_preview03").click(function(){
               $('#u185026').hide();
               $("#u184888").show(); 
            });

            */

            $('#btn_finish').click(function(){

                var servicos_array = new Array();

                var escritorio    = $('#sele_segmento').val();
                var estrutura     = $('#sele_estrutura').val();
                var especi_estru  = $('#text_area_obs').val();
                var sele_area     = $('#sele_area').val();
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

                

                if(escritorio.trim() != ''){
                    if(sele_area.trim() != ''){ 
                        
                            
                                if(nome_orc.trim() != ''){
                                    
                                        if(tel.trim() != '' || cel.trim() != ''){
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

                                                        data.append('servico', servicos_array);


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

            $("#sele_segmento").change(function(){
                var segmento = $(this).val();

                $("#sele_estrutura").children().remove();

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
        