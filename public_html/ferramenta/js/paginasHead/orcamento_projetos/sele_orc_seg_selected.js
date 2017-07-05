$(document).ready(function(){
       // alert('Recebendo Paramentro pela URL!');

        let = searchParams = new URLSearchParams(window.location.search);


        if(searchParams.has('arquitetura')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(2)').attr('selected', true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(2)').val());
          
          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(2)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(2)').val());


        }else if(searchParams.has('complementares')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(3)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(3)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(3)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(3)').val());

        }else if(searchParams.has('outros')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(4)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(4)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(4)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(4)').val());

        }


        // Is it equal to "yes"?
        //let param = searchParams.get('sent')

          function atualizarEstrutura(segmento){
            

              $("#sele_estrutura").children().remove();

                $.getJSON("json_file/projetos.json",function(data){
                    $.each(data, function(key, val){

                        if(key == segmento){                            
                            $.each(val, function(key02,val02){
                                $('#u258043').removeAttr('style');
                                $("#sele_estrutura").removeAttr('disabled');            
                                var option = "<option value="+val02+">"+val02+"</option>";
                                $("#sele_estrutura").append(option);
                            });
                        }else if(segmento == "outros"){
                            $("#sele_estrutura").attr('disabled', true);
                            $('#u258043').attr('style','background: #DCDCDC');
                        }

                    });
                });
          } // Fim da Função.

          function atualizarEstruMobile(segmento){
            $("#sele_estrutura2").children().remove();

                  $.getJSON("json_file/projetos.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento){                            
                                $.each(val, function(key02,val02){
                                    $('#u251846').removeAttr('style');
                                    $("#sele_estrutura2").removeAttr('disabled');                             
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura2").append(option);
                                });
                            }else if(segmento == "outros"){
                                $("#sele_estrutura2").attr('disabled', true);
                                $('#u251846').attr('style','background: #DCDCDC');
                            }

                        });
                    });

          }// fim da função tamanho mobile.

      });