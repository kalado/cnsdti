<?

/**
 * Grid Helper class file.
 *
 * PHP versions 5
 *
 * Author: Lucas Calado Alves Pereira (www.kalado.com.br) |-||-| 29/07/2010
 *
 *
 * :: Updates ::
 *
 * 24/10/2010 - Finalização do componente. ( Lucas Calado )
 *    - Método para tratamento de dados diferenciado.
 *    - Método que adiciona os botões de Controle e o campo de Busca.
 *    - Método que adicona a paginação.
 *    - Melhorias no método "listagem".
 *
 *
 *  27/02/2011 - Update de componente. ( Lucas Calado )
 *    - Método de tratamento de dados especificos.
 * 
 * 
 *  02/04/2012 - Update de componente. ( Lucas Calado )
 *    - Ajustes de interface para adequar a Mediappeal Marketing e Digital.
 * 
 * 
 *  07/09/2012 - Update de componente. ( Lucas Calado )
 *    - Ajuste de interface para adequar ao Cokato Gestão Financeiras
 * 
 * */

class GridHelper extends Helper {
    var $helpers = array('Html', 'Paginator');
    var $controllerName;
    var $nome;
    var $campoControles = 2;
    var $enderecoBusca = "lista";
    var $customFields = false;
    var $caminhoadd = '';
    var $galeria = false;
    var $top = false;
    var $numCols = 0;

    function listagem($colunas, $listRegistros) {
        $return = "";
        $arrayColuna = "";

        //CABEÇALHO LISTAGEM GRID
        $return .= '<form action="'.$this->Html->url("/".$this->nome."/multidelete").'" id="formMultiDelete" method="post">';
        $return .= '<table class="table table-striped table-condensed">';
        $return .= '<thead>';
        $return .= '<tr class="itens">';
        $return .= '<th><input id="checkAll" type="checkbox"/></th>';

        if (isset($colunas)) {
            $i = 0;
            foreach ($colunas as $label => $val) {
                $arrayColuna[$i]['Label'] = $label;
                $arrayColuna[$i]['Value'] = $val;

                $return .= '<th class="divisor">' . $this->Paginator->sort($val,$label) . '</th>';
                $i++;
            }
        } else {
            return "Você deve preencher o campo 'colunas' com um Array nomeando o Label e o Value.";
        }
        $return .= '<th>&nbsp;</th>';
        $return .= '</tr>';
        $return .= '</thead>';
        //FIM CABEÇALHO LISTAGEM GRID
        //CORPO LISTAGEM GRID
        $return .= '<tbody>';
        
        $this->numCols = $i+2;
        $i = 0;
        if(count($listRegistros) == 0) {
            $return .= "<td colspan='".$this->numCols."' style='text-align:center'><strong>Nenhum Registro encontrado</strong></td>";
        } else {
            foreach ($listRegistros as $registro) {
                $return .= "<tr>";

                $return .= '<td><input name="data[' . $i . '][' . $this->controllerName . '][id]" value="' . $registro[$this->controllerName]['id'] . '" type="checkbox" class="chN" /></td>';

                $x = 0;
                foreach ($colunas as $label => $val) {
                    $registro = $this->trataDados($val, $registro);
                    $return .= '<td class="divisor">' . $registro[$this->controllerName][$val] . '</td>';
                    if($x == 1){
                        $title = $registro[$this->controllerName][$val];
                    }
                    $x++;
                }
                
                $return .= '<td><a href="' . $this->Html->url("/".$this->nome .'/edit/' . $registro[$this->controllerName]['id']) . '" class="crudEditar"></a><a href="' . $this->Html->url("/".$this->nome . '/delete/' . $registro[$this->controllerName]['id']) . '" class="linkDel crudApagar" title="'.$title.'"></a></td>';

                $return .= '</tr>';
                $i++;
            }
        }
        //FIM CORPO LISTAGEM GRID

        $return .= "</tbody>";
        $return .= $this->paginacao();
        $return .= "</form>";
        $return .= "</table>";
        $return .= '</form>';


        return $return;
    }

    /* COMPLEMENTOS DO GRID */

    function paginacao() {
        $return = '<tfoot>';
        $return .= '<tr class="pagination rowTotal">';
        $return .= '<td colspan="'.$this->numCols.'">';
        $return .= '<ul>';
        $return .= $this->Paginator->prev('<', null, null, array('class' => 'disabled'));
        $return .= $this->Paginator->numbers(array("separator" => ''));
        $return .= $this->Paginator->next('>', null, null, array('class' => 'disabled'));
        $return .= '</ul>';
        $return .= '</td>';
        $return .= '</tr>';
        $return .= '</tfoot>';

        return $return;
    }

    /* /COMPLEMENTOS DO GRID */



    /* TRATAMENTO DE DADOS ESPECIFICOS */

    function trataDados($label, $registro) {

        /*
          VERIFICA SE EXISTE UM | NO $label.
          CASO EXISTE, SIGNIFICA QUE O CAMPO FAZ PARTE DE UM MODEL DIFERENTE DO QUE O PADRÃO QUE CHAMA ESTE GRID.
          ELE TRATA OS DADOS PARA NÃO DAR NENHUM ERRO
         */
        if (strpos($label, "|")) {
            $var = explode("|", $label);
            $registro[$this->controllerName][$label] = $registro[$var[0]][$var[1]];
        }

        switch ($label) {
            case "active":
                if ($registro[$this->controllerName]['active'] == 0) {
                    $registro[$this->controllerName]['active'] = "Desativado";
                } else {
                    $registro[$this->controllerName]['active'] = "Ativado";
                }
                break;
                
            case "created":
                $hra = explode(" ", $registro[$this->controllerName]['created']);
                $data = explode("-", $hra[0]);

                $registro[$this->controllerName]['created'] = $data[2] . "/" . $data[1] . "/" . $data[0] . " " . $hra[1];
                break;

            case "modified":
                $hra = explode(" ", $registro[$this->controllerName]['modified']);
                $data = explode("-", $hra[0]);

                $registro[$this->controllerName]['created'] = $data[2] . "/" . $data[1] . "/" . $data[0] . " " . $hra[1];
                break;
        }

        if ($this->customFields == true) {
            $registro = $this->customGridFields($label, $registro);
        }

        return $registro;
    }

    /* /TRATAMENTO DE DADOS ESPECIFICOS */

    function customGridFields($label, $registro) {
        switch ($label) {
            case 'tipo':
                switch ($registro[$this->controllerName]['tipo']) {
                    case "1":
                        $registro[$this->controllerName]['tipo'] = 'Grande';
                        break;
                    case "2":
                        $registro[$this->controllerName]['tipo'] = 'Coluna 1';
                        break;
                    case "3":
                        $registro[$this->controllerName]['tipo'] = 'Coluna 2';
                        break;
                    case "4":
                        $registro[$this->controllerName]['tipo'] = 'Coluna 3';
                        break;
                }
                break;
        }

        return $registro;
    }
}
?>