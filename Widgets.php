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
                $html .= "<td>" . htmlspecialchars($value) . "</td>";
            }
            $html .= "</tr>";
        }

        $html .= "</tbody></table>";
        return $html;
    }
}
