<?php

class Widgets {


    public static function renderTable($rows, $columnNames = null){
       if($columnNames == null){
          $columnNames = array_keys($rows[0]);
       }
        $html = "<table><thead><tr>";

        foreach($columnNames as $column){
            $html .= "<th>{$column}</th>";
        }
        $html .= "</tr></thead><tbody>";

        foreach($rows as $row){
            $html .= "<tr>";
            foreach($row as $column => $value){
               if(is_double($value) || is_int($value)){
                    $html .= "<td>" . htmlspecialchars(number_format($value, is_double($value)? 2 : 0)) . "</td>";
               } else {
                  $html .= "<td>" . htmlspecialchars($value) . "</td>";
               }
            }
            $html .= "</tr>";
        }

        $html .= "</tbody></table>";
        return $html;
    }

    public static function renderTableWithExtraColumns($rows, $columnNames = null, $extraColumnHeadings, $extraColumnData){

    if($columnNames == null){
        $columnNames = array_keys($rows[0]);
    }

    $html = "<table><thead><tr>";

    foreach($columnNames as $column){
        $html .= "<th>{$column}</th>";
    }
    foreach($extraColumnHeadings as $column){
        $html .= "<th>{$column}</th>";
    }
    $html .= "</tr></thead><tbody>";

    foreach($rows as $index=>$value){
        $html .= "<tr>";
        foreach($value as $column){
            if(is_double($column) || is_int($column)){
                $html .= "<td>" . htmlspecialchars(number_format($column, is_double($column)? 2: 0)) . "</td>";
            } else {
                $html .= "<td>" . htmlspecialchars($column) . "</td>";
            }
        }

        foreach($extraColumnData[$index] as $column){
            if(is_double($column) || is_int($column)){
                $html .= "<td>" . htmlspecialchars(number_format($value, is_double($column)? 2: 0)) . "</td>";
            } else {
                $html .= "<td>" . $column . "</td>";
            }
        }
        $html .= "</tr>";
    }
    $html .= "</tbody></table>";

    return $html;
    }
    

    public static function renderCoinTable($rows, $columnNames = null) {
        if($columnNames == null){
           $columnNames = array_keys($rows[0]);
        }

        $html = "<table><thead><tr>";

        foreach($columnNames as $column){
           $html .= "<th>{$column}</th>";
        }
        $html .= "<th>Buy or Sell</th></tr></thead><tbody>";

        $coinName = "";
        foreach($rows as $row){
           $html .= "<tr>";
           $first = true;
           foreach($row as $data){
                if($first){
                   $html .= "<td><a href=\"coin.php?coin_name={$data}\">{$data}</a></td>";
                   $coinName = $data;
                   $first = false;
                } else {
                   if(is_double($data) || is_int($data)){
                      $html .= "<td>" . number_format($data, is_double($data)? 2: 0) . "</td>";
                   } else {
                      $html .= "<td>" . htmlspecialchars($data) . "</td>";
                   }
                }

           }

           $html .= "<td><button id=\"buy{$coinName}\" class=\"buy\">Buy</button><button id=\"sell{$coinName}\" class=\"sell\">Sell</button></td></tr>";

        }
        $html .= "</tbody></table>";

        return $html;
    }
}
