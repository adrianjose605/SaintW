<div class="marca"></div>
<div style="position: relative;" ng-controller="Facturas" layout="column" flex id="content">

    <div class="container " style="width:95%" >
        <h1>Listado de Facturas</h1>

             <div  ng-show="contador != 0" tasty-table bind-resource-callback="getResourceV" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">
                            <td>{{ row.Descrip}}</td> 
                            <td>{{ row.TipoFac}}</td>
                            <td>{{ row.CodClie}}</td>
                            <td>{{ row.NroCtrol}}</td>
                            <td>{{ row.Monto}}</td>                                                           
                            <td>{{ row.MtoTax}}</td>                               
                            <td>{{ row.FechaE}}</td>                               
                                                  
                                
                            
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-orange btn-xs" href=""  ng-click="getEmpresas(row.Opciones)" data-toggle="modal" data-target="#modificar_empresa"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination style="width:100%"></div>
            </div>

    </div>


</div>


<script src="<?php echo base_url(); ?>public/js/Administrador/Facturas.js"></script>










