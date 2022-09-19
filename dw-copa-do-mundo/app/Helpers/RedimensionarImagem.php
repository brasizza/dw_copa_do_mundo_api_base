<?php

namespace App\Helpers;

class RedimensionarImagem
{
    protected $ArqOrigem;
    protected $DirDestino;
    private $Tamanhos;
    private $Extensoes;
    private $qualityPhoto = 100;

    function __get($campo)
    {
        return $this->$campo;
    }

    function __set($campo, $valor)
    {
        $this->$campo = $valor;
        return true;
    }

    function __construct()
    {
        $this->Tamanhos = array();
        $this->Extensoes = array();
    }

    public function setQualityPhoto($qtde)
    {
        $this->qualityPhoto = $qtde;
    }

    /* Adiciona os tamanhos a serem convertidos */

    function AdicionaTamanho($tam)
    {
        $chave = false;
        foreach ($this->Tamanhos as $tamList) {
            if ($tamList == $tam) {
                $chave = true;
                return false;
            }
        }
        if (!$chave) {
            $this->Tamanhos[] = $tam;
            return true;
        }
    }

    /* Retira um tamanho da fila */

    function RetiraTamanho($tam)
    {
        foreach ($this->Tamanhos as $Ind => $tamList) {
            if ($tamList == $tam) {
                $indice = $Ind;
                unset($this->Tamanhos[$indice]);
                break;
            }
        }
    }

    /* Pega todos os tamanhos existentes na fila */

    function PegaTamanhos()
    {
        return $this->Tamanhos;
    }

    /* Adiciona as extensÃµes nos arquivos */

    function AdicionaExtensoes($ext)
    {
        $chave = false;
        foreach ($this->Extensoes as $extList) {
            if ($extList == $ext) {
                $chave = true;
                return false;
            }
        }
        if (!$chave) {
            $this->Extensoes[] = $ext;
            return true;
        }
    }

    /* Retira as extensÃµes dos arquivos */

    function RetiraExtensoes($ext)
    {
        foreach ($this->Extensoes as $Ind => $extlist) {
            if ($extlist == $ext) {
                $indice = $Ind;
                unset($this->Extensoes[$indice]);
                break;
            }
        }
    }

    /* Pega as extensÃµes dos arquivos */

    function PegaExtensoes()
    {
        return $this->Extensoes;
    }

    /* Executa a conversÃ£o das imagens */

    function executar()
    {

        $imagem_orig = imagecreatefromstring(base64_decode($this->ArqOrigem));
        $thumb_largura = @imagesx($imagem_orig);
        $thumb_altura = @imagesy($imagem_orig);

        foreach ($this->Tamanhos as $redim) {
            $larguraT = $redim;
            $alturaT = $redim;
            if ($thumb_largura > $thumb_altura) {
                $alturaT = floor($redim * ($thumb_altura / $thumb_largura));
            }
            if ($thumb_largura < $thumb_altura) {
                $larguraT = floor($redim * ($thumb_largura / $thumb_altura));
            }
            $imagem_fin = @imagecreatetruecolor($larguraT, $alturaT);
            imagealphablending($imagem_fin, false);
            imagesavealpha($imagem_fin, true);
            imagecopyresampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $larguraT, $alturaT, $thumb_largura, $thumb_altura);
            $img = uniqid() . ".png";
            if ($this->qualityPhoto == 100) {
                $this->qualityPhoto = 9;
            }
            ob_start();
            @imagepng($imagem_fin,null,$this->qualityPhoto);
            $image_data = ob_get_contents();
            ob_end_clean();
            imagedestroy($imagem_fin);
            imagedestroy($imagem_orig);
            $iimg =  ($image_data); //base64_encode(file_get_contents('/tmp/'.$img));
            return ($iimg);
            // dd( base64_encode(imagepng($imagem_fin)));
            /* Volta para a permissao normal */
            //@chmod($this->DirDestino,0444);
        }
    }
}
