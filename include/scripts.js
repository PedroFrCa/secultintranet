function btn_cancela(){
    $(".cancel").click(function(e){
        $('#tabela').DataTable().ajax.reload();
    });
}

function add_linha(tabela){
    $(".add").click(function(e){
        $.ajax({
            url: "include/max_id.php",
            type: "POST",
            data: {"tabela": tabela},
            success : function(text){
                max_id = parseInt(text.replace(/"/g,""));
                var table = document.getElementById("tabela");  //get the target table selector
                var lastrow = $(table).find("tr").last(); 
                var $tr = $(lastrow).clone(true, true);  //clone the last row


                //encontrado numero de id. max_id é o maior id atualmente salvo no banco de dados
                var highest_new_id = parseInt($(table).find("tr").last().attr("id")); //encontrando o id do ultimo elemento da tabela (será o maior no caso que foi adicionado novo item mas não salvo ainda)
                var nextID;
                if (max_id >= highest_new_id)
                    nextID = max_id + 1;
                else
                    nextID = highest_new_id + 1;

                
                $tr.find("td>span").text(""); //apagando texto copiado da tabela anterior
                $tr.attr("id", nextID); //atribuindo o id da linha
                $tr.find("input.tabledit-identifier").val(nextID);  //set the row identifier
                $tr.find("span.tabledit-identifier").text(nextID);  //set the row identifier

                
                $(table).find("tbody").append($tr);    //add the row to the table

                $tr.find(".tabledit-edit-button").click();  //pretend to click the edit button
                $tr.find("input:not([type=hidden]), select").val("");   //wipe out the inputs.
            }
        });
    });
}

function gera_tabela_editavel(tabela,  colunas){
    $(document).ready(function(){
        var dataTable = $("#tabela").DataTable({
            "processing" : true,
            "serverSide" : true,
            "paging": false,
            "order" : [],
            "ajax" : {
                url: "include/fetch.php",
                type: "POST",
                data: {"tabela": tabela}
            },
            "language": {
                "emptyTable": "Nenhum registro encontrado",
                "info": "Mostrando _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                "infoFiltered": "(Filtrados de _MAX_ registros)",
                "infoThousands": ".",
                "loadingRecords": "Carregando...",
                "processing": "Processando...",
                "zeroRecords": "empty",
                "search": "Pesquisar ",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior",
                    "first": "Primeiro",
                    "last": "Último"
                },
                "aria": {
                    "sortAscending": ": Ordenar colunas de forma ascendente",
                    "sortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "1": "Selecionado 1 linha"
                    },
                    "cells": {
                        "1": "1 célula selecionada",
                        "_": "%d células selecionadas"
                    },
                    "columns": {
                        "1": "1 coluna selecionada",
                        "_": "%d colunas selecionadas"
                    }
                },
                "buttons": {
                    "copySuccess": {
                        "1": "Uma linha copiada com sucesso",
                        "_": "%d linhas copiadas com sucesso"
                    },
                    "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                    "colvis": "Visibilidade da Coluna",
                    "colvisRestore": "Restaurar Visibilidade",
                    "copy": "Copiar",
                    "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
                    "copyTitle": "Copiar para a Área de Transferência",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todos os registros",
                        "_": "Mostrar %d registros"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Preencher todas as células com",
                    "fillHorizontal": "Preencher células horizontalmente",
                    "fillVertical": "Preencher células verticalmente"
                },
                "lengthMenu": "Exibir _MENU_ resultados por página",
                "searchBuilder": {
                    "add": "Adicionar Condição",
                    "button": {
                        "0": "Construtor de Pesquisa",
                        "_": "Construtor de Pesquisa (%d)"
                    },
                    "clearAll": "Limpar Tudo",
                    "condition": "Condição",
                    "conditions": {
                        "date": {
                            "after": "Depois",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vazio",
                            "equals": "Igual",
                            "not": "Não",
                            "notBetween": "Não Entre",
                            "notEmpty": "Não Vazio"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vazio",
                            "equals": "Igual",
                            "gt": "Maior Que",
                            "gte": "Maior ou Igual a",
                            "lt": "Menor Que",
                            "lte": "Menor ou Igual a",
                            "not": "Não",
                            "notBetween": "Não Entre",
                            "notEmpty": "Não Vazio"
                        },
                        "string": {
                            "contains": "Contém",
                            "empty": "Vazio",
                            "endsWith": "Termina Com",
                            "equals": "Igual",
                            "not": "Não",
                            "notEmpty": "Não Vazio",
                            "startsWith": "Começa Com"
                        },
                        "array": {
                            "contains": "Contém",
                            "empty": "Vazio",
                            "equals": "Igual à",
                            "not": "Não",
                            "notEmpty": "Não vazio",
                            "without": "Não possui"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Excluir regra de filtragem",
                    "logicAnd": "E",
                    "logicOr": "Ou",
                    "title": {
                        "0": "Construtor de Pesquisa",
                        "_": "Construtor de Pesquisa (%d)"
                    },
                    "value": "Valor",
                    "leftTitle": "Critérios Externos",
                    "rightTitle": "Critérios Internos"
                },
                "searchPanes": {
                    "clearMessage": "Limpar Tudo",
                    "collapse": {
                        "0": "Painéis de Pesquisa",
                        "_": "Painéis de Pesquisa (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Nenhum Painel de Pesquisa",
                    "loadMessage": "Carregando Painéis de Pesquisa...",
                    "title": "Filtros Ativos"
                },
                "thousands": ".",
                "datetime": {
                    "previous": "Anterior",
                    "next": "Próximo",
                    "hours": "Hora",
                    "minutes": "Minuto",
                    "seconds": "Segundo",
                    "amPm": [
                        "am",
                        "pm"
                    ],
                    "unknown": "-",
                    "months": {
                        "0": "Janeiro",
                        "1": "Fevereiro",
                        "10": "Novembro",
                        "11": "Dezembro",
                        "2": "Março",
                        "3": "Abril",
                        "4": "Maio",
                        "5": "Junho",
                        "6": "Julho",
                        "7": "Agosto",
                        "8": "Setembro",
                        "9": "Outubro"
                    },
                    "weekdays": [
                        "Domingo",
                        "Segunda-feira",
                        "Terça-feira",
                        "Quarta-feira",
                        "Quinte-feira",
                        "Sexta-feira",
                        "Sábado"
                    ]
                },
                "editor": {
                    "close": "Fechar",
                    "create": {
                        "button": "Novo",
                        "submit": "Criar",
                        "title": "Criar novo registro"
                    },
                    "edit": {
                        "button": "Editar",
                        "submit": "Atualizar",
                        "title": "Editar registro"
                    },
                    "error": {
                        "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Mais informações<\/a>)."
                    },
                    "multi": {
                        "noMulti": "Essa entrada pode ser editada individualmente, mas não como parte do grupo",
                        "restore": "Desfazer alterações",
                        "title": "Multiplos valores",
                        "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais."
                    },
                    "remove": {
                        "button": "Remover",
                        "confirm": {
                            "_": "Tem certeza que quer deletar %d linhas?",
                            "1": "Tem certeza que quer deletar 1 linha?"
                        },
                        "submit": "Remover",
                        "title": "Remover registro"
                    }
                },
                "decimal": ","
            } 
        });
        //var editable_array = [[1, "ordem"], [2, "posicao"], [3, "nome"]];
        var nomes_colunas = colunas;
        var array_editable = [];
        for (var i = 1; i < nomes_colunas.length; i++){
            array_editable[i-1] = [i, nomes_colunas[i]];
        }
        $('#tabela').on('draw.dt', function(){
            $('#tabela').Tabledit({
                url:'include/action.php',
                columns: {
                    identifier : [0, 'id'],
                    //editable: [[1, 'ordem'], [2, 'posicao'], [3, 'nome']]
                    editable: array_editable
                },
                restoreButton:false,
                hideIdentifier:true,
                buttons: {
                    edit: {
                        class: 'table-btn',
                        html: '<span class="btn-icon">&#9998;</span>',
                        action: 'edit'
                    },
                    delete: {
                        class: 'table-btn',
                        html: '<span class="btn-icon">&#x2715;</span>',
                        action: 'delete'
                    },
                    save: {
                        class: 'table-btn',
                        html: 'Salvar'
                    },
                    confirm: {
                        class: 'table-btn',
                        html: 'Confirmar'
                    }
                },
                onSuccess:function(data){
                    
                    if(data.error) {
                        alert('A operação falhou. Erro:\n' + data.error);
                        $('#tabela').DataTable().ajax.reload();
                    }
                    else if(data.action == 'delete') {
                        //$('#' + data.id).remove();
                        $('#tabela').DataTable().ajax.reload();
                        alert('Removido com sucesso');
                    }
                },
                onFail:function(jqXHR, textStatus, errorThrown) {
                    alert('A operação falhou. Erro:\n' + textStatus + '\n' + errorThrown + '\n' + jqXHR.responseText);
                    $('#tabela').DataTable().ajax.reload();
                }
            });
        });
    });
}