<?php


class Funcoes{
    public function caractereTrat($v, $t){
        switch ($t){
            case 1:$rst = utf8_decode($v);
                break;
            case 2: $rst = htmlentities($v, ENT_QUOTES, "ISO-8859-1");
                break;
        }
        return $rst;
    }

    public function datas($t){
        switch ($t){
            case 1: $rst = date("Y-M-D");
                break;
            case 2: $rst = date("Y-m-d H:i:s");
                break;
            case 3: $rst = date("d/m/a");
                break;
        }
        return $rst;
    }

    public function b64($t, $v){
        switch ($t){
            case 1: $rst = base64_encode($v);
                break;
            case 2: $rst = base64_decode($v);
                break;
        }
        return $rst;
    }


}