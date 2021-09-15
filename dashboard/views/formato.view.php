<body>
    <header class="clearfix">
        <div id="logo">
            <img src="<?php echo RUTA . 'resource/assets/brand/logo.png' ?>" width="100" height="100" />
        </div>
        <h1>COTIZACIÓN MEDICAL PLANET</h1>
        <div id="company" class="clearfix">
            <?php foreach ($quote_products as $data) : ?>
                <div>NÚMERO TELEFÓNICO: <?php echo  $data['phone']; ?></div>
                <div><?php echo $data['name']; ?></div>
                <div>
                    CORREO ELECTRÓNICO:
                    <a href="mailto:<?php echo $data['email']; ?>"><?php echo $data['email']; ?></a>
                </div>
                <br>
                <div>CUENTAS BANCARIAS</div>
                <div>
                    NICPHARMACIE S. DE R.L. DE C.V. <BR>
                    BANCO: SANTANDER PREMIUM<BR>
                    CUENTA: 60-58447424-6<BR>
                    CLABE INTERBANCARIA: 014180605844742466<BR>
                </div>
        </div>
        <div id="project">
            <div><span>ID COTIZACIÓN: </span><?php echo  $data['id_quote_client']; ?></div>
            <div><span>INSTITUCIÓN: </span><?php echo  $data['business']; ?></div>
            <div><span>CLIENTE: </span><?php echo  $data['name_client']; ?></div>
            <div><span>NÚMERO TELEFÓNICO: </span><?php echo  $data['phone_client']; ?></div>
            <div>
                <span>CORREO ELECTRÓNICO:</span>
                <a href="mailto:<?php echo  $data['email_client']; ?>"><?php echo  $data['email_client']; ?></a>
            </div>
            <div>
                <span>FECHA DE EMISIÓN:</span> <?php echo date('d/m/Y', strtotime($data['date'])); ?>
            </div>
            <div>
                <span>VIGENCIA DE COTIZACION:</span> <?php echo date('d/m/Y', strtotime($data['validity'])); ?>
            </div>
        </div>
    <?php break;
            endforeach; ?>
    </header>
    <table>
        <thead>
            <tr>
                <th class="service">IMAGEN</th>
                <th class="desc">PRODUCTO</th>
                <th>MARCA</th>
                <th>CANTIDAD</th>
                <th>PRECIO UNITARIO SIN IVA</th>
                <th>PRECIO UNITARIO CON IVA</th>
                <th>PRECIO TOTAL SIN IVA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quote_products as $data) : ?>
                <tr style="vertical-align: middle;">
                    <td class="service">
                        <center><img src="<?php echo RUTA . $data['image']; ?>" width="70" height="50"></center>
                    </td>
                    <td class="service">
                        <center><?php echo $data['product']; ?></center>
                    </td>
                    <td class="service">
                        <center><?php echo $data['brand']; ?></center>
                    </td>
                    <td class="service">
                        <center><?php echo $data['amount']; ?></center>
                    </td>
                    <td class="service">
                        <center>$ <?php echo number_format($data['unit_price'], 2); ?> MXN</center>
                    </td>
                    <td class="service">
                        <center>$ <?php echo number_format(($data['unit_price'] * $data['iva'] + $data['unit_price']), 2); ?> MXN</center>
                    </td>
                    <td class="service">
                        <center>$ <?php echo number_format(($data['unit_price'] * $data['amount']), 2); ?> MXN</center>
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class="service">
                        <div>DESCRIPCIÓN:</div><BR>
                        <div class="notice">
                            <?php echo nl2br($data['description']); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td colspan="5">SUBTOTAL</td>
                <td class="total">$ <?php echo number_format($subtotal_price['total_price'], 2); ?> MXN</td>
            </tr>
            <tr>
                <td colspan="5"> IVA &nbsp; &nbsp; &nbsp; &nbsp;</td>
                <td class="total">$ <?php echo number_format(($subtotal_price['total_price'] * $subtotal_price['iva']), 2); ?> MXN</td>
            </tr>
            <tr>
                <td colspan="5" class="grand total">TOTAL&nbsp; &nbsp;</td>
                <td class="grand total">$ <?php echo number_format(($subtotal_price['total_price'] * $subtotal_price['iva']) + $subtotal_price['total_price'], 2); ?> MXN</td>
            </tr>

        </tbody>
    </table><br>
    <center>
        <h1>TERMINOS Y CONDICIONES</h1>
    </center>
    <table>
        <tr>
            <th>
                <center>
                    <h2>VIGENCIA DE COTIZACIÓN</h2>
                    <h3>" 3 DÍAS NATURALES"</h3>
                </center>
            </th>
            <th>
                <center>
                    <h2>ENVIO</h2>
                    <h3>"A CARGO DEL CLIENTE"</h3>
                </center>
            </th>
            <th>
                <center>
                    <h2>TIEMPO DE ENTREGA</h2>
                    <h3>"INMEDIATA(SEGUN EXISTENCIAS)"</h3>
                </center>
            </th>

            <th>
                <center>
                    <h2>CONDICIONES DE ENTREGA</h2>
                    <h3>"Los tiempos de entrega se cuentan </h3>
                    <h3>partir del depósito de compra,</h3>
                    <H3> Quedando acorde con el consultor."</H3>
                </center>
            </th>
        </tr>
        <tr>
            <td>
                <center>
                    <h2>CAPACITACIONES</h2>
                    <h3>"No incluye capacitación"</h3>
                </center>
            </td>

            <td>
                <center>
                    <h2>CONDICIONES DE PAGO</h2>
                    <h3>"100% de contado o quedando acorde con el consultor."</h3>
                </center>
            </td>

            <td>
                <center>
                    <h2>FORMA DE PAGO</h2>
                    <h3>"DEPOSITO O TRANSFERENCIA A LA CUENTA, PAGO EN OXXO, EFECTIVO </h3>
                    <H3>(PREGUNTAR AL CONSULTOR).”</H3>
                </center>
            </td>

            <td>
                <center>
                    <h2>DEVOLUCIONES</h2>
                    <h3>"(con la documentación necesaria y acorde a las políticas de la empresa) </h3>
                    <H3>Si la devolución es por causa del cliente tendrá un 35% de penalización de la compra, </H3>
                    <H3>sin embargo si es por causa de MEDICAL PLANET, no tendrá penalización.</H3>
                </center>
            </td>

        </tr>
    </table>
    <center>
        <footer>Copyright © 2021, Medical Planet.</footer>
    </center>
</body>