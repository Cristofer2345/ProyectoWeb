@extends('ViewAdministrator.homeAdministrator')
@section('createAuthor')
<div class="container">
    <h1>Lista de Autores</h1>
    <button type="button" class="btn btn-primary" id="si" data-bs-toggle="modal"
    data-bs-target="#addAuthor" style="background-color: #03a6a6; color: white; border: none;">
    Añadir Author
</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Biografía</th>
                <th>Nacionalidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->nombre }}</td>
                        <td>{{ $author->biografia }}</td>
                        <td>{{ $author->nacionalidad }}</td>
                        <td>
                            <button type="button" class="btn btn-primary"
                                onclick="mostrarDatosEditar('{{ $author->id }}', '{{ $author->nombre}}', '{{ $author->biografia }}', '{{ $author->nacionalidad  }}')"
                                data-bs-toggle="modal" data-bs-target="#editAuthor"
                                style="background-color: #03a6a6; color: white; border: none;">Editar</button>
                            <button class="btn btn-eliminar" data-id="{{ $author->id }}"
                                style="background-color: #ff0000; color: white; border: none;">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="addAuthor" tabindex="-1" aria-labelledby="addAuthorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAuthorModalLabel">Agregar Nuevo Autor</h5>
                        <img src="/img/Logo4.png" alt="" style="width: 100px; height: auto;">

                    </div>
                    <div class="modal-body">
                        <form id="addAuthorSubmit">
                            <div class="mb-3">
                                <label for="authorName" class="form-label">Nombre del Autor </label>
                                <input type="text" class="form-control" id="NameAuthor" required>
                            </div>
                            <div class="mb-3">
                                <label for="addBiografia" class="form-label">Biografia</label>
                                <textarea class="form-control" id="addBiografia" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="addNacionalidad" class="form-label">Nacionalidad</label>
                                <textarea class="form-control" id="addNacionalidad" rows="3" required></textarea>
                            </div>
                            <button type="button" id="AuthorSubmit" class="btn btn-primary"
                                style="background-color:  #acd90b; color: black; border: none; ">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                style="background-color:  #acd90b; color: black; border: none; ">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal de editar  -->    
    <div class="modal fade" id="editAuthor" tabindex="-1" aria-labelledby="editAuthorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAuthorModalLabel">Editar Author</h5>
                <img src="/img/Logo4.png" alt="" style="width: 100px; height: auto;">

            </div>
            <div class="modal-body">
                <form id="editAuthorSubmit">
                    <div class="mb-3">
                        <label for="NameAuthor" class="form-label">Nombre del Autor </label>
                        <input type="text" class="form-control" id="editAuthorName" required>
                    </div>
                    <div class="mb-3">
                        <label for="addBiografia" class="form-label">Biografia</label>
                        <textarea class="form-control" id="editBiografia" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="miVariableOculta" id="miVariableOculta" value="">
                    <div class="mb-3">
                        <label for="editNacionalidad" class="form-label">Nacionalidad</label>
                        <textarea class="form-control" id="editNacionalidad" rows="3" required></textarea>
                    </div>
                    <button type="submit" id="AuthorSubmit" class="btn btn-primary"
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
                const modal = document.getElementById('addAuthor');
                const modalBootstrap = bootstrap.Modal.getInstance(modal);
                modalBootstrap.hide();

                // Recarga la página actual
                location.reload();
            }
            document.getElementById('AuthorSubmit').addEventListener('click', async function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append('nombre', document.getElementById('NameAuthor').value);
                formData.append('biografia', document.getElementById('addBiografia').value);
                formData.append('nacionalidad', document.getElementById('addNacionalidad').value);

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
                            const response = await axios.post('/Authors/create', formData, config);

                            Swal.fire('¡Registro insertado!', '', 'success');
                            closeModalAndReload();
                        } catch (error) {
                            Swal.fire('Error al guardar el autor', error.response.data.message,
                                'error');
                        }
                    } else {
                        console.log('Cancelado');
                    }
                });
            });

            function recargarPagina() {
                const modal = document.getElementById('editAuthor');
                const modalBootstrap = bootstrap.Modal.getInstance(modal);
                modalBootstrap.hide();

                // Recarga la página actual
                location.reload();
            }
               
           
  //Funcionalidad de editar 
            document.getElementById('editAuthorSubmit').addEventListener('submit', async function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append('nombre', document.getElementById('editAuthorName').value);
                formData.append('biografia', document.getElementById('editBiografia').value);
                formData.append('nacionalidad', document.getElementById('editNacionalidad').value);
               
                let id = document.getElementById('miVariableOculta').value;
                console.log(id);

                Swal.fire({
                    title: '¿Quieres actualizar el registro?',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const url = `/Authors/edit/${id}`;
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
                biografia,nacionalidad) {
                   
                document.getElementById('editAuthorName').value = nombre;
                document.getElementById('editBiografia').value = biografia;
                document.getElementById('editNacionalidad').value = nacionalidad;
                document.getElementById('miVariableOculta').value = id;
                var myModal = new bootstrap.Modal(document.getElementById('editAuthor'));
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
                                const response = await axios.delete(`/Authors/delete/${id}`);
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