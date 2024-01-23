<!DOCTYPE html>
<html lang="en">


<?php
  require_once "header.php";
?>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php
    require_once "nav.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    require_once "menu.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Proveedores <button class="btn btn-success" id="btnagregar"
                                        onclick="mostrarFormulario(true)"><i class="fa fa-plus-circle"></i>
                                        Agregar</button>
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tablalistado"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Nombre</th>
                                        <th>Documentos</th>
                                        <th>Número</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Nombre</th>
                                        <th>Documentos</th>
                                        <th>Número</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="card-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                              <div class="row">
                                
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="hidden" name="idpersona" id="idpersona">
                                    <input type="hidden" name="tipo_persona" id="tipo_persona" value="Proveedor">
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                      placeholder="escriba el nombre" required>
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>tipo documento</label>
                                        <select name="tipo_documento" class="form-control" id="tipo_documento">
                                            <option value="RUC">ruc</option>
                                            <option value="pasaporte">pasaporte</option>
                                            <option value="dni">dni</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>numero documento</label>
                                        <input type="text" class="form-control" name="num_documento" id="num_documento" 
                                            placeholder="escribir nombre" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>direccion</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion"
                                            placeholder="escribir descripcion" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>telefono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                             placeholder="escribir descripcion" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="escribir descripcion" required>
                                    </div>
                                </div>


                            </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnguardar">
                                  <i class="fa fa-save"></i> Guardar</button>

                                <button class="btn btn-danger" onclick="cancelarFormulario()" type="button">
                                  <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                              </div>
                            </form>
                            </div>

                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php
    require_once "footer.php";
  ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script type="text/javascript" src="../vistas/codigosjs/proveedor.js"></script>
</body>
</html>
