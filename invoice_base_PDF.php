<?php include 'cn.php'; ?>

<?php

require_once __DIR__ . '/vendor/autoload.php';


// Si viene un valor en el metodo post con el ID del invoice, genera ese
if ($_POST["invoice"]) {
  $invoice = $_POST["invoice"];
  $filtro = 'WHERE i.idInvoice =' . $invoice;
}
//si no, genera el último invoice ingresado
else {
  //recuperar el ID de invoice recien ingresado
  $recuperaIdInvoice = "SELECT idInvoice FROM invoice ORDER BY idInvoice DESC LIMIT 1";
  $resultado = mysqli_query($conexion, $recuperaIdInvoice);
  $fila = mysqli_fetch_row($resultado);
  $idInvoice = $fila[0];
  $invoice = $idInvoice;
  $filtro = 'WHERE i.idInvoice =' . $invoice;
}


$sql = "SELECT i.idInvoice as idInvoice, i.fecha AS fecha, e.nombre AS nombreEmisor, e.direccion as direccionEmi, e.comuna as comunaEmi, 
        e.ciudad as ciudadEmi, e.pais AS paisEmi, e.telefono as telefonoEmi, e.url as urlEmi, e.email as emailEmi, c.nombre AS nombreCli, c.direccion AS direccionCli,
        c.ciudad as ciudadCli, c.cod_postal as codpostalCli, c.pais as paisCli, c.telefono as telefonoCli, c.contacto as contactoCli, c.email_contacto as emailContactoCli,
        d.valor as valor, i.total as total, item.descripcion AS itemDescripcion, d.descripcion as itemDetalle,
        b.banco as nombreBanco, b.titular as titularBanco, b.run as run, b.direccion as direccionTitularBanco, b.tipo_cuenta as tipoCuentaBanco,
        b.num_cuenta as numeroCuentaBanco, b.direccion_banco as direccionBanco, b.swift as swiftBanco
        FROM invoice i
        INNER JOIN cliente c ON i.idCliente = c.idCliente
        INNER JOIN emisor e ON i.idEmisor = e.idEmisor
        INNER JOIN detalle d ON d.idInvoice = i.idInvoice
        INNER JOIN item ON item.idItem = d.idItem
        INNER JOIN banco b ON e.idEmisor = b.idEmisor
        $filtro";

$resultado = mysqli_query($conexion, $sql);

while ($lista[] = $resultado->fetch_array());

//para pasar el total a palabras
$totalwords = new \NumberFormatter("sp", \NumberFormatter::SPELLOUT);
$totalPalabras = strtoupper($totalwords->format($lista[0]["total"]));

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$html = '
<head>
  <title>Invoice N°'.$invoice.'</title>
</head>
<body id="content">
  <header class="clearfix">
    <div id="logo">
      <img src="img/logo_ozeros.png">
    </div>
    <div id="company">
      <h2 class="name">' . $lista[0]["nombreEmisor"] . '</h2>
      <div>' . $lista[0]["direccionEmi"] . ' Street, ' . $lista[0]["comunaEmi"] . ' </div>
      <div>' . $lista[0]["ciudadEmi"] . ", " . $lista[0]["paisEmi"] . '</div>
      <div>Tel : ' . $lista[0]["telefonoEmi"] . '</div>
      <div><a href="mailto:' . $lista[0]["emailEmi"] . '">' . $lista[0]["emailEmi"] . '</a></div>
    </div>
    </div>
  </header>
  <main>
    <div id="details" class="clearfix">
      <div id="client">
        <div class="to">INVOICE TO:</div>
        <h2 class="name">' . $lista[0]["nombreCli"] . '</h2>
        <div class="address">' . $lista[0]["direccionCli"] . '</div>
        <div class="address">' . $lista[0]["ciudadCli"] . ', ' . $lista[0]["codpostalCli"] . ", " . $lista[0]["paisCli"] . '</div>
        <div class="address">' . $lista[0]["telefonoCli"] . '</div>
      </div>
      <div id="contact">
        <div class="to">CONTACT:</div>
        <h2 class="name">' . $lista[0]["contactoCli"] . '</h2>
        <div class="email"><a href="mailto:' . $lista[0]["emailContactoCli"] . '">' . $lista[0]["emailContactoCli"] . '</a></div>
      </div>

      <div id="invoice">
        <h1>INVOICE Nº ' . $lista[0]["idInvoice"] . '</h1>
        <div class="date">Date: ' . $lista[0]["fecha"] . '</div>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th class="tablehead">#</th>
          <th class="tablehead">ITEM</th>
          <th class="tablehead">DESCRIPTION</th>
          <th class="tablehead">AMOUNT</th>
        </tr>
      </thead>
      <tbody>';
$i = 1;
foreach ($lista as $list) {
  if ($list != null) {
    $html .= '
            <tr>
              <td class="no">' . $i . '</td>
              <td class="item">' . $list['itemDescripcion'] . '</td>
              <td class="desc">' . $list['itemDetalle'] . '</td>
              <td class="total">US$ ' . $list['valor'] . '</td>
            </tr>';
    $i = $i + 1;
  }
}
$html .= '
      </tbody>
      <tfoot>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="1" id="grandTotal">GRAND TOTAL</td>
          <td>US$ ' . $lista[0]["total"] . '.-</td>
        </tr>
      </tfoot>
    </table>
    <!-- <div id="thanks">Thank you!</div> -->

    <div id="totalInWords">' . $totalPalabras . ' US DOLLARS.</div>
    <div id="banks">
      <div>Bank Account:</div>
      <div class="bank">Beneficiary’s Name: ' . $lista[0]["titularBanco"] . '</div>
      <div class="bank">Beneficiary’s Address: ' . $lista[0]["direccionTitularBanco"] . ", " . $lista[0]["ciudadEmi"] . ", " . $lista[0]["paisEmi"] . '</div>
      <div class="bank">Beneficiary’s Account Number: ' . $lista[0]["tipoCuentaBanco"] . ': ' . $lista[0]["numeroCuentaBanco"] . '</div>
      <div class="bank">Receiving Bank’s Name: ' . $lista[0]["nombreBanco"] . '</div>
      <div class="bank">Receiving Bank’s Address: ' . $lista[0]["direccionBanco"] . '</div>
      <div class="bank">SWIFT Code: ' . $lista[0]["swiftBanco"] . '</div>
    </div>
  </main>
  <footer>
    Invoice was created on a computer and is valid without the signature and seal.
  </footer>
</body>

';



$sqlnombre = "SELECT DISTINCT c.nombre AS nombreCliente, e.nombre AS nombreEmisor, i.fecha AS fecha
        FROM invoice i
        INNER JOIN cliente c ON i.idCliente = c.idCliente
        INNER JOIN emisor e ON i.idEmisor = e.idEmisor
        INNER JOIN estado est ON i.idEstado = est.idEstado
        INNER JOIN detalle d ON d.idInvoice = i.idInvoice
        INNER JOIN item ON item.idItem = d.idItem
        where i.idInvoice = $invoice";

$res = mysqli_query($conexion, $sqlnombre);
$fila = mysqli_fetch_row($res);
$nombrepdf = "Invoice " . $fila[1] . " N°" . $invoice . " Date (" . $fila[2] . ") " . $fila[0] . ".pdf";

$css = file_get_contents('css/style_invoice_base.css');
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);
$mpdf->Output($nombrepdf, 'I');

?>