@extends('ViewAdministrator.homeAdministrator')
@section('createCategory')
<div class="container">
    <h1>Lista de Categorias</h1>
    <button type="button" class="btn btn-primary" id="si" data-bs-toggle="modal"
    data-bs-target="#addCategory" style="background-color: #03a6a6; color: white; border: none;">
    Añadir Categoria
</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion}}</td>
                        <td>
                            <button type="button" class="btn btn-primary"
                                onclick="mostrarDatosEditar('{{ $categoria->id }}', '{{ $categoria->nombre}}', '{{ $categoria->descripcion }}')"
                                data-bs-toggle="modal" data-bs-target="#editCategory"
                                style="background-color: #03a6a6; color: white; border: none;">Editar</button>
                            <button class="btn btn-eliminar" data-id="{{ $categoria->id }}"
                                style="background-color: #ff0000; color: white; border: none;">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Agregar Nueva Categoria</h5>
                        <img src="/img/Logo4.png" alt="" style="width: 100px; height: auto;">

                    </div>
                    <div class="modal-body">
                        <form id="addCategorySubmit">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Nombre de la categoria </label>
                                <input type="text" class="form-control" id="NameCategoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="addDescription" class="form-label">Descripción</label>
                                <textarea class="form-control" id="addDescription" rows="3" required></textarea>
                            </div>
            
                            <button type="button" id="CategorySubmit" class="btn btn-primary"
                                style="background-color:  #acd90b; color: black; border: none; ">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                style="background-color:  #acd90b; color: black; border: none; ">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal de editar  -->    
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Editar Categoria</h5>
                <img src="/img/Logo4.png" alt="" style="width: 100px; height: auto;">

            </div>
            <div class="modal-body">
                <form id="editCategorySubmit">
                    <div class="mb-3">
                        <label for="NameCategoriaEdit" class="form-label">Nombre de la Categoria </label>
                        <input type="text" class="form-control" id="editCategoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editDescripcion" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="miVariableOculta" id="miVariableOculta" value="">
                    <button type="submit" id="CategorySubmit" class="btn btn-primary"
                        style="background-color:  #acd90b; color: black; border: none; ">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="background-color:  #acd90b; color: black; border: none; ">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
       
         <script>
       
            function closeModalAndReload() {
                const modal = document.getElementById('addCategory');
                const modalBootstrap = bootstrap.Modal.getInstance(modal);
                modalBootstrap.hide();

                // Recarga la página actual
                location.reload();
            }
            document.getElementById('CategorySubmit').addEventListener('click', async function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append('nombre', document.getElementById('NameCategoria').value);
                formData.append('descripcion', document.getElementById('addDescription').value);

                Swal.fire({
                    title: '¿Quieres guardar estos datos?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const config = {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            };
                            const response = await axios.post('/categorias/create', formData, config);

                            Swal.fire('¡Registro insertado!', '', 'success');
                            closeModalAndReload();
                        } catch (error) {
                            Swal.fire('Error al guardar la categoria', error.response.data.message,
                                'error');
                        }
                    } else {
                        console.log('Cancelado');
                    }
                });
            });

            function recargarPagina() {
                const modal = document.getElementById('editCategory');
                const modalBootstrap = bootstrap.Modal.getInstance(modal);
                modalBootstrap.hide();

                // Recarga la página actual
                location.reload();
            }
               
           
  //Funcionalidad de editar 
            document.getElementById('editCategorySubmit').addEventListener('submit', async function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append('nombre', document.getElementById('editCategoryName').value);
                formData.append('descripcion', document.getElementById('editDescripcion').value);

               
                let id = document.getElementById('miVariableOculta').value;
                console.log(id);

                Swal.fire({
                    title: '¿Quieres actualizar el registro?',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const url = `/categorias/edit/${id}`;
                        
                        try {
                            const response = await axios.post(url, {
                                ...Object.fromEntries(formData),
                                _method: 'patch'
                            }, {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                }
                            });
                            console.log(response.data);
                            Swal.fire('¡Registro Actualizado!', '', 'success');
                            recargarPagina();
                        } catch (error) {
                            Swal.fire('Error al actualizar el registro', error.response.data.message,
                                'error');
                        }
                    }
                });

            });
            function mostrarDatosEditar(id, nombre,
                descripcion) {
                   
                document.getElementById('editCategoryName').value = nombre;
                document.getElementById('editDescripcion').value = descripcion;
                document.getElementById('miVariableOculta').value = id;
                var myModal = new bootstrap.Modal(document.getElementById('editCategory'));
                myModal.show();
            }
            document.querySelectorAll('.btn-eliminar').forEach(button => {
                button.addEventListener('click', async function() {
                    const id = this.dataset.id;

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'No podrás revertir esto',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            try {
                                const response = await axios.delete(`/categorias/delete/${id}`);
                                Swal.fire('¡Eliminado!', response.data.message, 'success');
                                location.reload();
                            } catch (error) {
                                Swal.fire('Error al eliminar', error.response.data.message,
                                    'error');
                            }
                        }
                    });
                });
            });
        
  </script>
       
@endsection