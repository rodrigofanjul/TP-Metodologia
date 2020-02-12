<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-dark-transparent text-white rounded shadow p-3">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <h2 class="col-sm-12 col-md-6 text-light pb-2 mb-2">Lista de entradas</h2>
        <?php if(!empty($entradaList)) { ?>
        <table id="sortable" class="table table-striped table-responsive-md text-white align-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th># Compra</th>
                    <th>Pelicula</th>
                    <th>Funcion</th>                    
                    <th>QR</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entradaList as $entrada) { ?>
                <tr>
                    <td class="align-middle"><?php echo $entrada->getId(); ?></td>
                    <td class="align-middle"><?php echo $entrada->getIdCompra(); ?></td>
                    <?php 
                        $idFuncion = $entrada->getIdFuncion();
                        $funcion->setId($idFuncion);
                        $funcion = $this->funcionDAO->getFuncion($funcion);
                        $idPelicula = $funcion->getIdPelicula();
                        $pelicula->setId($idPelicula);
                        $pelicula = $this->peliculaDAO->getPelicula($pelicula);
                    ?>
                    <td class="align-middle"><img src="<?php echo $pelicula->getPoster(); ?>"  height="35" width="35" class="rounded-circle z-depth-0 mr-2" alt="pelicula image"><b><?php echo $pelicula->getTitulo(); ?></b></a></td>
                    <td class="align-middle"><?php echo $funcion->getFechaHora(); ?></td>                    
                    <td class="align-middle"><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><img src="https://chart.googleapis.com/chart?chs=60x60&cht=qr&chl=<?php echo $entrada->getQr(); ?>" class="rounded-circle z-depth-0" alt="qr"></a></td>
                    <td class="align-middle"><a href="#modal<?php echo $entrada->getId();?>" class="view" title="" data-toggle="modal" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
        <div class="container-fluid">
            <div class="alert alert-danger mt-3" role="alert">
                <div class="row">
                <div class="col col-lg-2 text-center mb-2">
                    <svg height="60" viewBox="0 0 512.00037 512" width="60" xmlns="http://www.w3.org/2000/svg">
                    <g fill-rule="evenodd">
                        <path d="m491.363281 439.761719-110.308593-110.304688c55.042968-79.363281 47.214843-189.136719-23.492188-259.84375-79.515625-79.519531-208.4375-79.519531-287.953125 0-79.515625 79.515625-79.515625 208.433594 0 287.953125 70.710937 70.707032 180.480469 78.535156 259.84375 23.488282l110.304687 110.308593c14.191407 14.1875 37.414063 14.1875 51.601563 0 14.191406-14.191406 14.191406-37.414062.003906-51.601562zm0 0" fill="#ffdda0" />
                        <path d="m317.09375 110.082031c-57.167969-57.167969-149.851562-57.167969-207.015625 0-57.167969 57.164063-57.167969 149.847657 0 207.015625 57.164063 57.164063 149.847656 57.164063 207.015625 0 57.164062-57.167968 57.164062-149.851562 0-207.015625zm0 0" fill="#ff8f8e" />
                        <path d="m248.953125 61.273438c-5.367187-1.238282-10.722656 2.101562-11.964844 7.46875-1.242187 5.367187 2.105469 10.726562 7.472657 11.96875 24.8125 5.734374 47.492187 18.332031 65.582031 36.421874 53.183593 53.183594 53.183593 139.726563 0 192.910157-53.183594 53.1875-139.726563 53.1875-192.910157 0-53.1875-53.183594-53.1875-139.726563 0-192.910157 15.269532-15.269531 33.339844-26.40625 53.710938-33.109374 5.230469-1.71875 8.078125-7.355469 6.359375-12.589844-1.722656-5.234375-7.363281-8.082032-12.59375-6.359375-23.367187 7.683593-44.085937 20.453125-61.582031 37.953125-60.964844 60.964844-60.964844 160.160156 0 221.125 30.480468 30.480468 70.519531 45.722656 110.5625 45.722656 40.039062-.003906 80.078125-15.242188 110.5625-45.722656 60.960937-60.964844 60.960937-160.160156 0-221.125-20.738282-20.734375-46.738282-35.175782-75.199219-41.753906zm0 0" />
                        <path d="m498.414062 432.707031-104.53125-104.53125c53.601563-84.054687 41.863282-194.484375-29.265624-265.617187-40.339844-40.339844-93.976563-62.558594-151.027344-62.558594-57.054688 0-110.691406 22.21875-151.03125 62.558594-40.34375 40.339844-62.558594 93.976562-62.558594 151.03125 0 57.050781 22.214844 110.6875 62.558594 151.027344 40.339844 40.339843 93.972656 62.554687 151.023437 62.554687 40.945313 0 80.386719-11.484375 114.59375-33.289063l104.53125 104.53125c8.746094 8.75 20.414063 13.566407 32.855469 13.566407 12.4375 0 24.105469-4.816407 32.855469-13.566407 18.109375-18.117187 18.109375-47.589843-.003907-65.707031zm-14.105468 51.601563c-4.980469 4.976562-11.636719 7.71875-18.746094 7.71875-7.113281 0-13.769531-2.742188-18.75-7.71875l-110.304688-110.304688c-1.929687-1.933594-4.484374-2.921875-7.054687-2.921875-1.976563 0-3.960937.582031-5.683594 1.777344-32.410156 22.480469-70.515625 34.363281-110.1875 34.363281-51.722656 0-100.347656-20.140625-136.917969-56.710937-75.5-75.5-75.5-198.347657 0-273.847657 36.574219-36.574218 85.199219-56.714843 136.925782-56.714843 51.722656 0 100.347656 20.140625 136.921875 56.714843 66.28125 66.285157 75.683593 170.207032 22.347656 247.105469-2.75 3.964844-2.269531 9.324219 1.144531 12.738281l110.304688 110.304688c10.335937 10.335938 10.335937 27.15625 0 37.496094zm0 0" />
                        <path d="m273.804688 153.371094c-3.894532-3.894532-10.207032-3.894532-14.105469 0l-46.109375 46.109375-46.113282-46.109375c-3.894531-3.894532-10.210937-3.894532-14.105468 0-3.894532 3.894531-3.894532 10.210937 0 14.105468l46.109375 46.113282-46.109375 46.109375c-3.894532 3.894531-3.894532 10.210937 0 14.105469 1.945312 1.949218 4.5 2.921874 7.050781 2.921874 2.554687 0 5.105469-.972656 7.054687-2.921874l46.109376-46.109376 46.109374 46.109376c1.949219 1.949218 4.503907 2.921874 7.054688 2.921874 2.554688 0 5.105469-.972656 7.054688-2.921874 3.894531-3.894532 3.894531-10.210938 0-14.105469l-46.113282-46.109375 46.113282-46.113282c3.894531-3.894531 3.894531-10.210937 0-14.105468zm0 0" />
                        <path d="m206.976562 77.328125c5.492188 0 9.972657-4.480469 9.972657-9.976563 0-5.492187-4.480469-9.972656-9.972657-9.972656-5.496093 0-9.976562 4.480469-9.976562 9.972656 0 5.496094 4.480469 9.976563 9.976562 9.976563zm0 0" />
                    </g>
                    </svg>
                </div>
                <div class="col col-auto">
                    <h4 class="alert-heading">No existen entradas vendidas.</h4>
                    <ul>
                    <li>
                        Cuando un usuario realice la compra de una entrada aparacera aquí.
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#sortable').DataTable( {
        "columnDefs": [
            { "orderable": false, "targets": [4,5]}
        ]
        } );
    } );
</script>

<!-- Modal que muestra entrada -->
<?php 
foreach($entradaList as $entrada) 
{
    $idFuncion = $entrada->getIdFuncion();
    $funcion->setId($idFuncion);
    $funcion = $this->funcionDAO->getFuncion($funcion);
    $idPelicula = $funcion->getIdPelicula();
    $pelicula->setId($idPelicula);
    $pelicula = $this->peliculaDAO->getPelicula($pelicula);
    require(VIEWS_PATH."entrada/entrada.php");
}
?>