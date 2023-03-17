<?php
namespace contenido\reportesPDF;
use contenido\componentes\fpdf\fpdf as FPDF;

class reporteDetalleV extends FPDF
{

function Header()
{
	// Logo
	$this->Image('assets/img/img13.png',0,0,240);
	$this->Image('assets/img/mmm.png',0,0,330);
    $this->Image('assets/img/11a.png',5,2,33);
    $this->Image('assets/img/Detalles.png',68,6,68);
	
	$this->Ln(20);
	$this->SetY(45);

}

// Pie de página
function Footer()
{

	// Posición: a 1,5 cm del final
	// Arial italic 8
	$this->SetFont('Times','B',12);
	// Número de página
	$this->SetTextColor(1000);
	$this->Image('assets/img/foo.png',0,284,220);
	$this->Cell(0,12,utf8_decode('página ').$this->PageNo().'/{nb}',0,0,'C');
	
}

function SetCol($col)
{
	// Establecer la posición de una columna dada
	$this->col = $col;
	$x = 10+$col*65;
	$this->SetLeftMargin($x);
	$this->SetX($x);
}

function AcceptPageBreak()
{
	// Método que acepta o no el salto automático de página
	if($this->col<2)
	{
		// Ir a la siguiente columna
		$this->SetCol($this->col+1);
		// Establecer la ordenada al principio
		$this->SetY($this->y0);
		// Seguir en esta página
		return false;
	}
	else
	{
		// Volver a la primera columna
		$this->SetCol(0);
		// Salto de página
		return true;
	}
}

var $widths;
var $aligns;

function SetWidths($w)
{
    $this->SetX(23);
    $this->SetDrawColor(00,00,95);
    $this->SetTextColor(000);
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

}




?>