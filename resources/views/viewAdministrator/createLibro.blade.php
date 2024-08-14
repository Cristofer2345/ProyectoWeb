@extends('ViewAdministrator.homeAdministrator')
@section('createLibro')
    <div class="container">
        <h1>Lista de Libros</h1>
        <button type="button" class="btn btn-primary" id="si" data-bs-toggle="modal" data-bs-target="#addLibro"
            style="background-color: #03a6a6; color: white; border: none;">
            Añadir un Libro
        </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Fecha de Publicación</th>
                    <th>Idioma</th>
                    <th>Paginas</th>
                    <th>Categoria</th>
                    <th>Autores</th>
                    <th> acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($libros as $libro)
                    <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->titulo }}</td>
                        <td>{{ $libro->descripcion }}</td>
                        <td>{{ $libro->fechaPublicacion }}</td>
                        <td>{{ $libro->idioma }}</td>
                        <td>{{ $libro->paginas }}</td>
                        <td>{{ $libro->categoria->nombre }}</td>
                        <td>
                            <div class="d-flex flex-wrap">
                                @foreach ($libro->autores as $autor)
                                    <div class="author-badge bg-primary text-white rounded-pill p-2 m-1">
                                        {{ $autor->nombre }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary"
                                onclick="mostrarDatosEditar('{{ $libro->id }}', '{{ $libro->titulo }}', '{{ $libro->descripcion }}', '{{ $libro->fechaPublicacion }}','{{ $libro->idioma }}', '{{ $libro->paginas }}','{{ $libro->categoria->id }}','{{ $libro->autores }}')"
                                data-bs-toggle="modal" data-bs-target="#editLibro"
                                style="background-color: #03a6a6; color: white; border: none;">Editar</button>
                            <button class="btn btn-eliminar" data-id="{{ $libro->id }}"
                                style="background-color: #ff0000; color: white; border: none;">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="addLibro" tabindex="-1" aria-labelledby="addLibroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLibroModalLabel">Agregar Nuevo Libro</h5>
                    <img src="/img/Logo4.png" alt="" style="width: 100px; height: auto;">

                </div>
                <div class="modal-body">
                    <form id="addLibroSubmit">
                        <div class="mb-3">
                            <label for="addTitulo" class="form-label">Titulo del Libro </label>
                            <input type="text" class="form-control" id="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="addDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="Descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="addFechaPublicacion" class="form-label">Fecha de Publicación</label>
                            <input type="date" class="form-control" id="FechaPublicacion" required>
                        </div>
                        <div class="mb-3">
                            <label for="addIdioma" class="form-label">Idioma</label>
                            <input type="text" class="form-control" id="Idioma" required>
                        </div>

                        <div class="mb-3">
                            <label for="addPagina" class="form-label">Páginas</label>
                            <input type="text" class="form-control" id="Pagina" required>
                        </div>

                        <div class="mb-3">
                            <label for="addCategoria" class="form-label">Categoria</label>
                            <select name="opciones" id="Cate" class="form-select" required>
                                <option selected>Selecciona una Categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addAutores" class="form-label">Autores</label>
                            <select name="autores[]" id="autores" class="form-select js-example-basic-multiple" multiple="multiple" required>
                            </select>
                        </div>
                        <button type="button" id="libroSubmit" class="btn btn-primary"
                            style="background-color:  #acd90b; color: black; border: none; ">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="background-color:  #acd90b; color: black; border: none; ">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de editar  -->
    <div class="modal fade" id="editLibro" tabindex="-1" aria-labelledby="editLibroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLibroModalLabel">Editar Libro</h5>
                    <img src="/img/Logo4.png" alt="" style="width: 100px; height: auto;">

                </div>
                <div class="modal-body">
                    <form id="editLibroSubmit" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="editTitulo" class="form-label">Titulo del Libro </label>
                            <input type="text" class="form-control" id="editLibros" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editDescripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="addFechaPublicacion" class="form-label">Fecha de Publicación</label>
                            <input type="date" class="form-control" id="editFechaPublicacion" required>
                        </div>
                        <div class="mb-3">
                            <label for="editIdioma" class="form-label">Idioma</label>
                            <input type="text" class="form-control" id="IdiomaEdit" required>
                        </div>

                        <div class="mb-3">
                            <label for="editPagina" class="form-label">Páginas</label>
                            <input type="text" class="form-control" id="PaginaEdit" required>
                        </div>

                        <div class="mb-3">
                            <label for="editCategoria" class="form-label">Categoria</label>
                            <select name="opciones" id="CateEdit" class="form-select" required>
                                <option selected>Selecciona una Categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="miVariableOculta" id="miVariableOculta" value="">
                        <div class="mb-3">
                            <label for="addAutores" class="form-label">Autores</label>
                            <select name="autores[]" id="editautores" class="form-select" multiple="multiple" required>
                                @foreach ($author as $autor)
                                    <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" id="LibroSubmit" class="btn btn-primary"
                            style="background-color:  #acd90b; color: black; border: none; ">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="background-color:  #acd90b; color: black; border: none; ">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Script JavaScript para manejar el formulario de agregar enfermedad -->
    <script>
        function closeModalAndReload() {
            const modal = document.getElementById('addLibro');
            const modalBootstrap = bootstrap.Modal.getInstance(modal);
            modalBootstrap.hide();

            // Recarga la página actual
            location.reload();
        }
        document.getElementById('libroSubmit').addEventListener('click', async function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('titulo', document.getElementById('titulo').value);
            formData.append('descripcion', document.getElementById('Descripcion').value);
            formData.append('fechaPublicacion', document.getElementById('FechaPublicacion').value);
            formData.append('idioma', document.getElementById('Idioma').value);
            formData.append('paginas', document.getElementById('Pagina').value);
            let categoria = document.getElementById('Cate').value;
            formData.append('categoria_id', categoria);
            // Obtén los autores seleccionados y añádelos al FormData
            const autoresSeleccionados = $('#autores').val();
            if (autoresSeleccionados) {
                autoresSeleccionados.forEach(autor => {
                    formData.append('autores[]', autor);
                });
            }

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
                        const response = await axios.post('/libros/Author/create', formData,
                            config);

                        Swal.fire('¡Registro insertado!', '', 'success');
                        closeModalAndReload();
                    } catch (error) {
                        Swal.fire('Error al guardar el libro', error.response.data.message,
                            'error');
                    }
                } else {
                    console.log('Cancelado');
                }
            });
        });

        function recargarPagina() {
            const modal = document.getElementById('editLibro');
            const modalBootstrap = bootstrap.Modal.getInstance(modal);
            modalBootstrap.hide();

            // Recarga la página actual
            location.reload();
        }

        function mostrarDatosEditar(id, titulo, descripcion, fechaPublicacion, idioma, paginas, categoriaId, autores) {
            document.getElementById('editLibros').value = titulo;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editFechaPublicacion').value = fechaPublicacion;
            document.getElementById('IdiomaEdit').value = idioma;
            document.getElementById('PaginaEdit').value = paginas;
            document.getElementById('CateEdit').value = categoriaId;
            document.getElementById('miVariableOculta').value = id;

            var myModal = new bootstrap.Modal(document.getElementById('editLibro'));
            myModal.show();

        }
        //Funcionalidad de editar 
        document.getElementById('editLibroSubmit').addEventListener('submit', async function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('titulo', document.getElementById('editLibros').value);
            formData.append('descripcion', document.getElementById('editDescripcion').value);
            formData.append('fechaPublicacion', document.getElementById('editFechaPublicacion').value);
            formData.append('idioma', document.getElementById('IdiomaEdit').value);
            formData.append('paginas', document.getElementById('PaginaEdit').value);
            formData.append('categoria_id', document.getElementById('CateEdit').value);
            const autoresSeleccionados = $('#editautores').val();
            if (autoresSeleccionados) {
                autoresSeleccionados.forEach(autor => {
                    formData.append('autores[]', autor);
                });
            }
            let id = document.getElementById('miVariableOculta').value;

            Swal.fire({
                title: '¿Quieres actualizar el registro?',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const url = `/Libro/edit/${id}`;
                    try {
                        const response = await axios.post(url, formData, {
                           
                            headers: {
                                
                                'Content-Type': 'multipart/form-data',
                                
                            }
                        });
                        console.log(response.data);
                        Swal.fire('¡Registro Actualizado!', '', 'success');
                        recargarPagina();
                    } catch (error) {
                        Swal.fire('Error al actualizar el registro', error.response?.data
                            ?.message || 'Error desconocido',
                            'error');
                    }
                }
            });
        });

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
                            const response = await axios.delete(`/libros/delete/${id}`);
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
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $('.js-example-basic-multiple').select2({
            placeholder: "Seleccione un Paciente",
            allowClear: true,
            dropdownParent: $('#addLibro'),
            ajax: {
                url:'/libro/buscar/search/busqueda/Author',
                dataType: 'json',
                type: 'POST',
                delay: 250, 
                data: function(params) {
                    return {
                        nombre: params.term 
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(author) {
                            return {
                                id: author.id,
                                text: author.nombre
                            };
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
